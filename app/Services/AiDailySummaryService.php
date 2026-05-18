<?php

namespace App\Services;

use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiDailySummaryService
{
    public function generate($userId): array
    {
        $apiKey = config('services.gemini.api_key');
        $model = config('services.gemini.model');

        if (!$apiKey) {
            throw new Exception('API key Gemini belum disetting.');
        }

        $tasks = Task::with('subject')
            ->where('user_id', $userId)
            ->where('status', '!=', 'selesai')
            ->orderByDesc('priority_score')
            ->orderBy('deadline', 'asc')
            ->take(10)
            ->get();

        if ($tasks->isEmpty()) {
            throw new Exception('Belum ada tugas aktif untuk dibuatkan ringkasan harian.');
        }

        $prompt = $this->buildPrompt($tasks);

        $response = Http::timeout(60)
            ->retry(2, 1000)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt,
                            ],
                        ],
                    ],
                ],
                'generationConfig' => [
                    'temperature' => 0.3,
                    'responseMimeType' => 'application/json',
                ],
            ]);

        if ($response->failed()) {
            Log::error('Gemini Daily Summary Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new Exception('Gagal membuat ringkasan harian dari AI.');
        }

        $text = $response->json('candidates.0.content.parts.0.text');

        if (!$text) {
            Log::error('Gemini Daily Summary Empty Response', [
                'response' => $response->json(),
            ]);

            throw new Exception('AI tidak mengembalikan response yang valid.');
        }

        $result = json_decode($text, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Gemini Daily Summary Invalid JSON', [
                'raw_response' => $text,
            ]);

            throw new Exception('Format JSON dari AI tidak valid.');
        }

        return $this->normalizeResult($result);
    }

    private function buildPrompt($tasks): string
    {
        $taskText = $tasks->map(function ($task, $index) {
            $number = $index + 1;
            $subject = $task->subject?->name ?? 'Tidak diketahui';

            return "
Tugas {$number}:
- Judul: {$task->title}
- Mata kuliah: {$subject}
- Deskripsi: {$task->description}
- Deadline: {$task->deadline}
- Kesulitan: {$task->difficulty}
- Estimasi: {$task->estimated_duration} jam
- Bobot nilai: {$task->task_weight}
- Status: {$task->status}
- Skor prioritas: {$task->priority_score}
- Level prioritas: {$task->priority_level}
";
        })->implode("\n");

        return <<<PROMPT
Kamu adalah asisten manajemen tugas akademik mahasiswa.

Buat ringkasan harian berdasarkan daftar tugas aktif berikut:

{$taskText}

Tugas kamu:
- Menentukan fokus utama hari ini.
- Memberikan alasan tugas mana yang harus dikerjakan lebih dulu.
- Membuat rencana pengerjaan singkat.
- Memberikan tips manajemen waktu.

Berikan output JSON valid saja.
Jangan gunakan markdown.
Jangan gunakan tanda ```json.
Jangan menambahkan teks di luar JSON.

Format JSON wajib:
{
  "overview": "ringkasan singkat kondisi tugas hari ini",
  "focus_tasks": [
    "tugas prioritas 1 beserta alasan singkat",
    "tugas prioritas 2 beserta alasan singkat",
    "tugas prioritas 3 beserta alasan singkat"
  ],
  "suggested_plan": [
    "rencana pengerjaan pertama",
    "rencana pengerjaan kedua",
    "rencana pengerjaan ketiga"
  ],
  "time_management_tips": "tips manajemen waktu singkat"
}

Aturan:
- Gunakan bahasa Indonesia.
- Jawaban harus praktis.
- Jangan mengerjakan isi tugas mahasiswa.
- Fokus pada prioritas, jadwal, dan strategi pengerjaan.
- Maksimal 3 focus_tasks.
- Maksimal 4 suggested_plan.
PROMPT;
    }

    private function normalizeResult(array $result): array
    {
        return [
            'overview' => $result['overview'] ?? 'Belum ada ringkasan.',
            'focus_tasks' => $result['focus_tasks'] ?? [],
            'suggested_plan' => $result['suggested_plan'] ?? [],
            'time_management_tips' => $result['time_management_tips'] ?? 'Fokus pada tugas dengan deadline terdekat dan skor prioritas tertinggi.',
        ];
    }
}