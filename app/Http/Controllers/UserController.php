<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
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

    /**
     * Update an existing user
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            
            $user->update($data);
            
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a user
     */
    public function destroy(User $user)
    {
        try {
            // Delete related records first to avoid foreign key constraint violations
            $user->bioimpedances()->delete();
            $user->exerciseMaximums()->delete();
            $user->tokens()->delete(); // Delete personal access tokens
            
            // Now delete the user
            $user->delete();
            
            return response()->json([
                'message' => 'User and all related data deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 