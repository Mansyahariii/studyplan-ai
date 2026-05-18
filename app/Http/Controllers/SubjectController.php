<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Subject::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(Subject $subject)
    {
        abort_if($subject->user_id !== Auth::id(), 403);

        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        abort_if($subject->user_id !== Auth::id(), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject->update($request->only('name', 'description'));

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Subject $subject)
    {
        abort_if($subject->user_id !== Auth::id(), 403);

        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}