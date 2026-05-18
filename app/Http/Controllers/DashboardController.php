<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\AiDailySummary;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalTasks = Task::where('user_id', $userId)->count();

        $completedTasks = Task::where('user_id', $userId)
            ->where('status', 'selesai')
            ->count();

        $pendingTasks = Task::where('user_id', $userId)
            ->whereIn('status', ['belum_dikerjakan', 'sedang_dikerjakan'])
            ->count();

        $urgentTasks = Task::with(['subject', 'aiRecommendation'])
            ->where('user_id', $userId)
            ->whereIn('priority_level', ['tinggi', 'sangat_tinggi'])
            ->where('status', '!=', 'selesai')
            ->orderByDesc('priority_score')
            ->take(5)
            ->get();

        // Insight tambahan
        $todayTasks = Task::where('user_id', $userId)
            ->whereDate('deadline', Carbon::today())
            ->where('status', '!=', 'selesai')
            ->count();

        $weekTasks = Task::where('user_id', $userId)
            ->whereBetween('deadline', [
                Carbon::now()->startOfDay(),
                Carbon::now()->addDays(7)->endOfDay(),
            ])
            ->where('status', '!=', 'selesai')
            ->count();

        $veryHighPriorityTasks = Task::where('user_id', $userId)
            ->where('priority_level', 'sangat_tinggi')
            ->where('status', '!=', 'selesai')
            ->count();

        $overdueTasks = Task::where('user_id', $userId)
            ->where('deadline', '<', Carbon::now())
            ->where('status', '!=', 'selesai')
            ->count();

        $dailySummary = AiDailySummary::where('user_id', $userId)
            ->whereDate('summary_date', Carbon::today())
            ->latest()
            ->first();

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'urgentTasks',
            'todayTasks',
            'weekTasks',
            'veryHighPriorityTasks',
            'overdueTasks',
            'dailySummary'
        ));
    }
}
