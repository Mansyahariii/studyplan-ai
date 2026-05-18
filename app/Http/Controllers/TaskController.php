<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subject;
use App\Models\TaskHistory;
use App\Services\PriorityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        $query = Task::with(['subject', 'aiRecommendation'])
            ->where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority_level')) {
            $query->where('priority_level', $request->priority_level);
        }

        switch ($request->get('sort', 'priority_desc')) {
            case 'deadline_asc':
                $query->orderBy('deadline', 'asc');
                break;

            case 'deadline_desc':
                $query->orderBy('deadline', 'desc');
                break;

            case 'priority_asc':
                $query->orderBy('priority_score', 'asc');
                break;

            case 'latest':
                $query->latest();
                break;

            case 'oldest':
                $query->oldest();
                break;

            case 'priority_desc':
            default:
                $query->orderByDesc('priority_score')
                    ->orderBy('deadline', 'asc');
                break;
        }

        $tasks = $query->paginate(8)->withQueryString();

        return view('tasks.index', compact('tasks', 'subjects'));
    }

    public function create()
    {
        $subjects = Subject::where('user_id', Auth::id())->get();

        return view('tasks.create', compact('subjects'));
    }

    public function store(Request $request, PriorityService $priorityService)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'difficulty' => 'required|in:rendah,sedang,tinggi',
            'estimated_duration' => 'required|integer|min:1',
            'task_weight' => 'required|in:kecil,sedang,besar',
            'status' => 'required|in:belum_dikerjakan,sedang_dikerjakan,selesai,terlambat',
        ]);

        $subject = Subject::where('id', $validated['subject_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $priority = $priorityService->calculate($validated);

        Task::create([
            ...$validated,
            'user_id' => Auth::id(),
            'priority_score' => $priority['priority_score'],
            'priority_level' => $priority['priority_level'],
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show(Task $task)
    {
        abort_if((int) $task->user_id !== (int) Auth::id(), 403);

        $task->load([
            'subject',
            'aiRecommendation',
            'histories.user',
        ]);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_if((int) $task->user_id !== (int) Auth::id(), 403);

        $subjects = Subject::where('user_id', Auth::id())->get();

        return view('tasks.edit', compact('task', 'subjects'));
    }

    public function update(Request $request, Task $task, PriorityService $priorityService)
    {
        abort_if((int) $task->user_id !== (int) Auth::id(), 403);

        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'difficulty' => 'required|in:rendah,sedang,tinggi',
            'estimated_duration' => 'required|integer|min:1',
            'task_weight' => 'required|in:kecil,sedang,besar',
            'status' => 'required|in:belum_dikerjakan,sedang_dikerjakan,selesai,terlambat',
        ]);

        $subject = Subject::where('id', $validated['subject_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $oldStatus = $task->status;

        $priority = $priorityService->calculate($validated);

        $task->update([
            'subject_id' => $validated['subject_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'deadline' => $validated['deadline'],
            'difficulty' => $validated['difficulty'],
            'estimated_duration' => $validated['estimated_duration'],
            'task_weight' => $validated['task_weight'],
            'status' => $validated['status'],
            'priority_score' => $priority['priority_score'],
            'priority_level' => $priority['priority_level'],
        ]);

        if ($oldStatus !== $validated['status']) {
            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'note' => 'Status tugas diperbarui.',
            ]);
        }

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        abort_if((int) $task->user_id !== (int) Auth::id(), 403);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }

    public function quickUpdateStatus(Request $request, Task $task)
    {
        abort_if((int) $task->user_id !== (int) Auth::id(), 403);

        $validated = $request->validate([
            'status' => 'required|in:belum_dikerjakan,sedang_dikerjakan,selesai,terlambat',
        ]);

        $oldStatus = $task->status;

        $task->update([
            'status' => $validated['status'],
        ]);

        if ($oldStatus !== $validated['status']) {
            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'note' => 'Status tugas diperbarui melalui quick update.',
            ]);
        }

        return back()->with('success', 'Status tugas berhasil diperbarui.');
    }
}
