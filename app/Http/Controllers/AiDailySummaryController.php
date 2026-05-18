<?php

namespace App\Http\Controllers;

use App\Models\AiDailySummary;
use App\Services\AiDailySummaryService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class AiDailySummaryController extends Controller
{
    public function generate(AiDailySummaryService $aiService)
    {
        try {
            $existingSummary = AiDailySummary::where('user_id', Auth::id())
                ->whereDate('summary_date', Carbon::today())
                ->latest()
                ->first();

            if ($existingSummary && $existingSummary->updated_at->gt(now()->subMinutes(10))) {
                return redirect()
                    ->route('dashboard')
                    ->with('error', 'Tunggu sekitar 10 menit sebelum generate ulang ringkasan harian.');
            }

            $result = $aiService->generate(Auth::id());

            AiDailySummary::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'summary_date' => Carbon::today()->toDateString(),
                ],
                [
                    'overview' => $result['overview'],
                    'focus_tasks' => $result['focus_tasks'],
                    'suggested_plan' => $result['suggested_plan'],
                    'time_management_tips' => $result['time_management_tips'],
                ]
            );

            return redirect()
                ->route('dashboard')
                ->with('success', 'Ringkasan harian AI berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()
                ->route('dashboard')
                ->with('error', $e->getMessage());
        }
    }
}
