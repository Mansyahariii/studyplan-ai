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

        return <<<PROMPT
Kamu adalah asisten manajemen tugas akademik mahasiswa.

Analisis tugas berikut:

Nama tugas: {$task->title}
Mata kuliah: {$subjectName}
Deskripsi tugas: {$task->description}
Deadline: {$task->deadline}
Tingkat kesulitan: {$task->difficulty}
Estimasi waktu pengerjaan: {$task->estimated_duration} jam
Bobot nilai: {$task->task_weight}
Status tugas: {$task->status}
Skor prioritas sistem: {$task->priority_score}
Level prioritas sistem: {$task->priority_level}

Buat rekomendasi dalam format JSON valid saja, tanpa markdown, tanpa penjelasan tambahan.

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

Gunakan bahasa Indonesia yang jelas, praktis, dan cocok untuk mahasiswa.
Jangan menyuruh mahasiswa menyontek.
Jangan mengerjakan isi tugasnya secara penuh.
Fokus hanya pada strategi pengerjaan, prioritas, dan manajemen waktu.
PROMPT;
    }
}