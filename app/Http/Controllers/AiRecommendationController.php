<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\AiRecommendation;
use App\Services\AiRecommendationService;
use Illuminate\Support\Facades\Auth;
use Exception;

class AiRecommendationController extends Controller
{
    public function generate(Task $task, AiRecommendationService $aiService)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $task->load('subject');

        $existingRecommendation = $task->aiRecommendation;

        if ($existingRecommendation && $existingRecommendation->updated_at->gt(now()->subMinutes(3))) {
            return redirect()
                ->route('tasks.show', $task)
                ->with('error', 'Tunggu sekitar 3 menit sebelum generate ulang rekomendasi AI.');
        }

        try {
            $result = $aiService->generate($task);

            AiRecommendation::updateOrCreate(
                [
                    'task_id' => $task->id,
                ],
                [
                    'risk_level' => $result['risk_level'] ?? null,
                    'priority_reason' => $result['priority_reason'] ?? null,
                    'suggested_steps' => $result['suggested_steps'] ?? [],
                    'suggested_schedule' => $result['suggested_schedule'] ?? [],
                    'time_management_tips' => $result['time_management_tips'] ?? null,
                ]
            );

            return redirect()
                ->route('tasks.show', $task)
                ->with('success', 'Rekomendasi AI berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()
                ->route('tasks.show', $task)
                ->with('error', $e->getMessage());
        }
    }
}
