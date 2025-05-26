<?php

namespace App\Http\Controllers;

use App\Http\Requests\BioimpedanceCreateRequest;
use App\Http\Resources\BioimpedanceResource;
use App\Services\BioimpedanceService;
use Illuminate\Http\Request;

class BioimpedanceController extends Controller
{
    public function store(BioimpedanceCreateRequest $request, BioimpedanceService $bioimpedanceService)
    {
        try {
            $bioimpedance = $bioimpedanceService->create($request->user_id, $request->validated());
            
            return (new BioimpedanceResource($bioimpedance))->response()->setStatusCode(201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating bioimpedance',
            ], 500);
        }
    }

    public function list(Request $request, BioimpedanceService $bioimpedanceService)
    {
        try {
            $bioimpedances = $bioimpedanceService->getLatestByUser($request->user_id);
            
            return BioimpedanceResource::collection($bioimpedances);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching bioimpedances',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
