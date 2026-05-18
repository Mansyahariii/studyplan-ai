<?php

namespace App\Models;

use App\Models\AiRecommendation;
use App\Models\TaskHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'title',
        'description',
        'deadline',
        'difficulty',
        'estimated_duration',
        'task_weight',
        'status',
        'priority_score',
        'priority_level',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function aiRecommendation()
    {
        return $this->hasOne(AiRecommendation::class);
    }

    public function histories()
    {
        return $this->hasMany(TaskHistory::class);
    }
}
