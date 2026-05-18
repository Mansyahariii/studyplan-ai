<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiDailySummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'summary_date',
        'overview',
        'focus_tasks',
        'suggested_plan',
        'time_management_tips',
    ];

    protected $casts = [
        'summary_date' => 'date',
        'focus_tasks' => 'array',
        'suggested_plan' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}