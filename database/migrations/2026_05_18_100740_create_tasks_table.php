<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('deadline');
            $table->enum('difficulty', ['rendah','sedang', 'tinggi']);
            $table->integer('estimated_duration');
            $table->enum('task_weight', ['kecil','sedang', 'besar']);
            $table->enum('status', [
                'belum_dikerjakan',
                'sedang_dikerjakan',
                'selesai',
                'terlambat'
                ])->default('belum_dikerjakan');
            $table->integer('priority_score')->default(0);
            $table->enum('priority_level', [
                'rendah',
                'sedang',
                'tinggi',
                'sangat_tinggi'
                ])->default('rendah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
