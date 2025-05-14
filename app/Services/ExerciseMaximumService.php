<?php

namespace App\Services;

use App\Models\ExerciseMaximum;
use App\Models\Exercise;

class ExerciseMaximumService
{
    public function create(int $user_id, array $data)
    {
        Exercise::findOrFail($data['exercise_id']);

        $data['one_rep_max'] = 0.033 * $data['max_reps'] * $data['workload'] + $data['workload'];
        
        return ExerciseMaximum::create([
            'user_id' => $user_id,
            ...$data,
        ]);
    }

    public function getByExercise(int $user_id, int $exercise_id)
    {        
        return ExerciseMaximum::query()
            ->where('user_id', $user_id)
            ->where('exercise_id', $exercise_id)
            ->orderBy('date', 'DESC')
            ->get();
    }
} 