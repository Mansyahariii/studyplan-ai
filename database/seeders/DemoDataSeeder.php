<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\User;
use App\Services\PriorityService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'mahasiswa@gmail.com'],
            [
                'name' => 'Mahasiswa',
                'password' => Hash::make('password'),
            ]
        );

        $subjectsData = [
            [
                'name' => 'Jaringan Syaraf Tiruan',
                'description' => 'Mata kuliah yang membahas konsep neural network, perceptron, backpropagation, dan penerapan kecerdasan buatan.',
            ],
            [
                'name' => 'Manajemen Proyek',
                'description' => 'Mata kuliah yang membahas perencanaan, pengorganisasian, pelaksanaan, dan pengendalian proyek.',
            ],
            [
                'name' => 'Technopreneurship',
                'description' => 'Mata kuliah yang membahas pengembangan ide bisnis berbasis teknologi dan model bisnis digital.',
            ],
            [
                'name' => 'Sistem Pendukung Keputusan',
                'description' => 'Mata kuliah yang membahas metode pengambilan keputusan seperti SAW, AHP, WP, dan TOPSIS.',
            ],
            [
                'name' => 'Testing & Implementasi Sistem Informasi',
                'description' => 'Mata kuliah yang membahas pengujian perangkat lunak, test case, black box testing, white box testing, dan implementasi sistem.',
            ],
            [
                'name' => 'Aplikasi Mobile Lanjutan',
                'description' => 'Mata kuliah yang membahas pengembangan aplikasi mobile tingkat lanjut, integrasi API, state management, dan deployment.',
            ],
        ];

        $subjects = [];

        foreach ($subjectsData as $subjectData) {
            $subject = Subject::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'name' => $subjectData['name'],
                ],
                [
                    'description' => $subjectData['description'],
                ]
            );

            $subjects[$subjectData['name']] = $subject;
        }

        $priorityService = app(PriorityService::class);

        $tasksData = [
            [
                'subject' => 'Jaringan Syaraf Tiruan',
                'title' => 'Perhitungan Perceptron Sederhana',
                'description' => 'Mengerjakan soal perhitungan perceptron sederhana, termasuk menentukan input, bobot, threshold, output, dan proses aktivasi.',
                'deadline' => Carbon::now()->addDay()->setTime(23, 59),
                'difficulty' => 'tinggi',
                'estimated_duration' => 5,
                'task_weight' => 'besar',
                'status' => 'belum_dikerjakan',
            ],
            [
                'subject' => 'Manajemen Proyek',
                'title' => 'Membuat Work Breakdown Structure',
                'description' => 'Membuat WBS untuk proyek pengembangan sistem informasi, termasuk pembagian pekerjaan, estimasi durasi, dan penanggung jawab.',
                'deadline' => Carbon::now()->addDays(3)->setTime(20, 0),
                'difficulty' => 'tinggi',
                'estimated_duration' => 4,
                'task_weight' => 'sedang',
                'status' => 'sedang_dikerjakan',
            ],
            [
                'subject' => 'Technopreneurship',
                'title' => 'Analisis Business Model Canvas',
                'description' => 'Membuat analisis BMC untuk ide bisnis digital, meliputi value proposition, customer segment, revenue stream, dan key activities.',
                'deadline' => Carbon::now()->addDays(7)->setTime(23, 59),
                'difficulty' => 'sedang',
                'estimated_duration' => 3,
                'task_weight' => 'sedang',
                'status' => 'belum_dikerjakan',
            ],
            [
                'subject' => 'Sistem Pendukung Keputusan',
                'title' => 'Perhitungan Metode AHP',
                'description' => 'Mengerjakan studi kasus metode AHP dengan menentukan kriteria, alternatif, matriks perbandingan, bobot, dan hasil prioritas.',
                'deadline' => Carbon::now()->addDays(2)->setTime(21, 0),
                'difficulty' => 'tinggi',
                'estimated_duration' => 6,
                'task_weight' => 'besar',
                'status' => 'belum_dikerjakan',
            ],
            [
                'subject' => 'Testing & Implementasi Sistem Informasi',
                'title' => 'Laporan Black Box Testing',
                'description' => 'Membuat laporan pengujian black box testing lengkap dengan skenario pengujian, tabel test case, hasil aktual, dan kesimpulan.',
                'deadline' => Carbon::now()->addHours(18),
                'difficulty' => 'tinggi',
                'estimated_duration' => 6,
                'task_weight' => 'besar',
                'status' => 'belum_dikerjakan',
            ],
            [
                'subject' => 'Aplikasi Mobile Lanjutan',
                'title' => 'Implementasi Login dengan API',
                'description' => 'Membuat fitur login aplikasi mobile yang terhubung dengan backend API, termasuk validasi input dan penyimpanan token.',
                'deadline' => Carbon::now()->addDays(5)->setTime(22, 0),
                'difficulty' => 'sedang',
                'estimated_duration' => 4,
                'task_weight' => 'besar',
                'status' => 'sedang_dikerjakan',
            ],
            [
                'subject' => 'Technopreneurship',
                'title' => 'Resume Materi Design Thinking',
                'description' => 'Membuat ringkasan singkat mengenai tahapan design thinking mulai dari empathize, define, ideate, prototype, hingga test.',
                'deadline' => Carbon::now()->addDays(14)->setTime(23, 59),
                'difficulty' => 'rendah',
                'estimated_duration' => 2,
                'task_weight' => 'kecil',
                'status' => 'belum_dikerjakan',
            ],
            [
                'subject' => 'Testing & Implementasi Sistem Informasi',
                'title' => 'Studi Kasus White Box Testing',
                'description' => 'Menganalisis alur logika program sederhana menggunakan metode white box testing dan membuat jalur pengujian.',
                'deadline' => Carbon::now()->subDay()->setTime(23, 59),
                'difficulty' => 'sedang',
                'estimated_duration' => 3,
                'task_weight' => 'sedang',
                'status' => 'belum_dikerjakan',
            ],
        ];

        foreach ($tasksData as $taskData) {
            $subject = $subjects[$taskData['subject']];

            $dataForPriority = [
                'deadline' => $taskData['deadline'],
                'difficulty' => $taskData['difficulty'],
                'estimated_duration' => $taskData['estimated_duration'],
                'task_weight' => $taskData['task_weight'],
            ];

            $priority = $priorityService->calculate($dataForPriority);

            $task = Task::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'title' => $taskData['title'],
                ],
                [
                    'subject_id' => $subject->id,
                    'description' => $taskData['description'],
                    'deadline' => $taskData['deadline'],
                    'difficulty' => $taskData['difficulty'],
                    'estimated_duration' => $taskData['estimated_duration'],
                    'task_weight' => $taskData['task_weight'],
                    'status' => $taskData['status'],
                    'priority_score' => $priority['priority_score'],
                    'priority_level' => $priority['priority_level'],
                ]
            );

            if ($taskData['status'] === 'sedang_dikerjakan') {
                TaskHistory::updateOrCreate(
                    [
                        'task_id' => $task->id,
                        'user_id' => $user->id,
                        'new_status' => 'sedang_dikerjakan',
                    ],
                    [
                        'old_status' => 'belum_dikerjakan',
                        'note' => 'Status awal demo diperbarui menjadi sedang dikerjakan.',
                    ]
                );
            }
        }
    }
}