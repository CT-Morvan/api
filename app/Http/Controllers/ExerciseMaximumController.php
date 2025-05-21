<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseMaximumCreateRequest;
use App\Http\Requests\ExerciseMaximumBatchCreateRequest;
use App\Http\Resources\ExerciseMaximumResource;
use App\Http\Resources\ExerciseMaximumListResource;
use App\Models\Exercise;
use App\Services\ExerciseMaximumService;
use Illuminate\Http\Request;

class ExerciseMaximumController extends Controller
{
    public function store(ExerciseMaximumCreateRequest $request, ExerciseMaximumService $exerciseMaximumService)
    {
        try {
            $exerciseMaximum = $exerciseMaximumService->create($request->user_id, $request->exercise_id, $request->validated());
            
            return response()->json([
                'message' => 'Exercise maximum created successfully',
                'data' => $exerciseMaximum
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating exercise maximum',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function batchStore(ExerciseMaximumBatchCreateRequest $request, ExerciseMaximumService $exerciseMaximumService)
    {
        try {
            $results = [];
            $userId = $request->user_id;
            
            foreach ($request->maximums as $maximum) {
                $exerciseId = $maximum['exercise_id'];
                unset($maximum['exercise_id']);
                
                $result = $exerciseMaximumService->create($userId, $exerciseId, $maximum);
                $results[] = $result;
            }
            
            return response()->json([
                'message' => 'Exercise maximums created successfully',
                'data' => $results
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating exercise maximums',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Request $request, int $user_id, int $exercise_id, ExerciseMaximumService $exerciseMaximumService)
    {
        try {
            $exercise = Exercise::findOrFail($exercise_id);
            $data = $exerciseMaximumService->getByExercise($user_id, $exercise_id);
            
            return ExerciseMaximumResource::collection($data)->additional([
                'exercise_name' => $exercise->name,
                'exercise_id' => $exercise_id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching exercise maximum history',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function list(Request $request, ExerciseMaximumService $exerciseMaximumService)
    {
        try {
            $exercises = $exerciseMaximumService->getAllExercisesWithMaximums($request->user_id);
            
            return ExerciseMaximumListResource::collection($exercises);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching exercises with maximums',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 