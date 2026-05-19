<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class AiRecommendationService
{
    public function generate(Task $task): array
    {
        $apiKey = config('services.gemini.api_key');
        $model = config('services.gemini.model');

        if (!$apiKey) {
            throw new Exception('API key Gemini belum disetting.');
        }

        $prompt = $this->buildPrompt($task);

        $response = Http::timeout(30)->post(
            "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}",
            [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.4,
                    'responseMimeType' => 'application/json',
                ],
            ]
        );

        if ($response->failed()) {
            Log::error('Gemini API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new Exception('Gagal menghubungi layanan AI.');
        }

        $text = $response->json('candidates.0.content.parts.0.text');

        if (!$text) {
            throw new Exception('AI tidak mengembalikan respons yang valid.');
        }

        $result = json_decode($text, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Invalid AI JSON Response', [
                'response' => $text,
            ]);

            throw new Exception('Format respons AI tidak valid.');
        }

        return $result;
    }

    private function buildPrompt(Task $task): string
    {
        $subjectName = $task->subject?->name ?? 'Tidak diketahui';

        $now = now(config('app.timezone'));

        $deadline = $task->deadline->copy()->timezone(config('app.timezone'));

        if ($deadline->lt($now)) {
            $minutesRemaining = -1 * (int) $deadline->diffInMinutes($now);
        } else {
            $minutesRemaining = (int) $now->diffInMinutes($deadline);
        }

        $hoursRemaining = intdiv($minutesRemaining, 60);
        $daysRemaining = intdiv($minutesRemaining, 1440);

        if ($minutesRemaining < 0) {
            $deadlineStatus = 'sudah melewati deadline';
            $riskLevel = 'sangat tinggi';
        } elseif ($minutesRemaining <= 1440) {
            $deadlineStatus = 'deadline kurang dari 24 jam';
            $riskLevel = 'tinggi';
        } elseif ($minutesRemaining <= 4320) {
            $deadlineStatus = 'deadline sangat dekat';
            $riskLevel = 'tinggi';
        } elseif ($minutesRemaining <= 10080) {
            $deadlineStatus = 'deadline minggu ini';
            $riskLevel = 'sedang';
        } else {
            $deadlineStatus = 'deadline masih cukup jauh';
            $riskLevel = $task->priority_score >= 80 ? 'sedang' : 'rendah';
        }

        return <<<PROMPT
Kamu adalah asisten manajemen tugas mahasiswa.

Gunakan data berikut sebagai FAKTA WAJIB. Jangan menebak ulang, jangan menghitung ulang tanggal, dan jangan bertentangan dengan data sistem.

Waktu saat ini: {$now->format('d M Y H:i')}
Deadline tugas: {$deadline->format('d M Y H:i')}
Sisa menit menuju deadline: {$minutesRemaining}
Sisa jam menuju deadline: {$hoursRemaining}
Sisa hari menuju deadline: {$daysRemaining}
Status deadline dari sistem: {$deadlineStatus}
Tingkat risiko dari sistem: {$riskLevel}

Data tugas:
- Judul: {$task->title}
- Mata kuliah: {$task->subject->name}
- Deskripsi: {$task->description}
- Tingkat kesulitan: {$task->difficulty}
- Estimasi pengerjaan: {$task->estimated_duration} jam
- Bobot nilai: {$task->task_weight}
- Skor prioritas sistem: {$task->priority_score}
- Level prioritas sistem: {$task->priority_level}

Aturan penting:
- Jika status deadline adalah 'sudah melewati deadline', jangan pernah mengatakan deadline masih jauh.
- Jika deadline sudah lewat, jelaskan bahwa tugas perlu segera diselesaikan.
- Tingkat risiko harus mengikuti tingkat risiko dari sistem.
- Jangan mengubah fakta tanggal, deadline, skor, dan status deadline.
- Jawaban harus dalam bahasa Indonesia.

Format JSON wajib:
{
  "risk_level": "rendah/sedang/tinggi/sangat tinggi",
  "priority_reason": "alasan singkat kenapa tugas ini memiliki prioritas tersebut",
  "suggested_steps": [
    "langkah 1",
    "langkah 2",
    "langkah 3"
  ],
  "suggested_schedule": [
    "jadwal 1",
    "jadwal 2",
    "jadwal 3"
  ],
  "time_management_tips": "tips singkat manajemen waktu"
}
PROMPT;
    }
}
