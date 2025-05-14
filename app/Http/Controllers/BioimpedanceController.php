<?php

namespace App\Http\Controllers;

use App\Http\Requests\BioimpedanceCreateRequest;
use App\Services\BioimpedanceService;

class BioimpedanceController extends Controller
{
    public function store(BioimpedanceCreateRequest $request, BioimpedanceService $bioimpedanceService)
    {
        try {
            $bioimpedanceService->create($request->user_id, $request->validated());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating bioimpedance',
            ], 500);
        }
    }
}
