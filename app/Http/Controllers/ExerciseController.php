<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Resources\ListExercisesResource;

class ExerciseController extends Controller
{
    public function list(Request $request)
    {
        $exercises = Exercise::all();

        return ListExercisesResource::collection($exercises);
    }
}
