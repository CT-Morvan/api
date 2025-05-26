<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Resources\ListExercisesResource;
use App\Http\Requests\ExerciseCreateRequest;

class ExerciseController extends Controller
{
    public function list(Request $request)
    {
        $exercises = Exercise::all();

        return ListExercisesResource::collection($exercises);
    }

    public function store(ExerciseCreateRequest $request)
    {
        try {
            $exercise = Exercise::create($request->validated());
            
            return response()->json([
                'message' => 'Exercise created successfully',
                'data' => new ListExercisesResource($exercise)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating exercise',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Exercise $exercise)
    {
        try {
            // Delete all exercise maximums related to this exercise
            $exercise->exerciseMaximums()->delete();
            
            // Delete the exercise itself
            $exercise->delete();
            
            return response()->json([
                'message' => 'Exercise and all related data deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting exercise',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
