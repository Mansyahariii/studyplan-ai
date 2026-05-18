<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'risk_level',
        'priority_reason',
        'suggested_steps',
        'suggested_schedule',
        'time_management_tips',
    ];

    protected $casts = [
        'suggested_steps'=> 'array',
        'suggested_schedule'=> 'array',
    ];

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
