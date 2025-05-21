<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login(AuthRequest $request, AuthService $service)
    {
        try {
            $user = $service->login($request->validated());

            return response()->json([
                'token' => $user->token,
                'name' => $user->name,
                'email' => $user->email,
                'type' => $user->type,
                'id' => $user->id,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
