<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserTypeEnum;

class InjectUserIdInRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $userId = $request->route('user_id');

        if ($user->type == UserTypeEnum::PATIENT->value && $userId !== $user->id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        $request->merge([
            'user_id' => $userId,
        ]);

        return $next($request);
    }
}
