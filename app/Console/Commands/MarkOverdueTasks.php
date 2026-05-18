<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MarkOverdueTasks extends Command
{
    protected $signature = 'tasks:mark-overdue';

    protected $description = 'Menandai tugas yang melewati deadline sebagai terlambat';

    public function handle(): int
    {
        $updatedCount = 0;

        Task::where('deadline', '<', now())
            ->whereNotIn('status', ['selesai', 'terlambat'])
            ->chunkById(100, function ($tasks) use (&$updatedCount) {
                foreach ($tasks as $task) {
                    $oldStatus = $task->status;

                    $task->update([
                        'status' => 'terlambat',
                    ]);

                    TaskHistory::create([
                        'task_id' => $task->id,
                        'user_id' => $task->user_id,
                        'old_status' => $oldStatus,
                        'new_status' => 'terlambat',
                        'note' => 'Status otomatis diperbarui karena deadline sudah lewat.',
                    ]);

                    $updatedCount++;
                }
            });

        Log::info("Auto mark overdue selesai. Total tugas diperbarui: {$updatedCount}");

        $this->info("Total tugas yang ditandai terlambat: {$updatedCount}");

        return Command::SUCCESS;
    }
}