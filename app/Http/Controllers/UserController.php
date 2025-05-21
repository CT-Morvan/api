<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * List all users
     */
    public function index()
    {
        try {
            $users = User::all();
            
            return UserResource::collection($users);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a new user
     */
    public function store(UserCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            
            $user = User::create($data);
            
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 