<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseMaximum extends Model
{
    protected $fillable = [
        'date',
        'exercise_id',
        'max_reps',
        'workload',
        'one_rep_max',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
        'max_reps' => 'float',
        'workload' => 'float',
        'one_rep_max' => 'float',
    ];

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 