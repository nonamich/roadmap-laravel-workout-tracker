<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function __construct(private readonly JwtService $jwtService) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only([
            'email',
            'password',
        ]);

        $isAuth = Auth::attempt($credentials);

        if (! $isAuth) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        if (! $user) {
            return response()->json(['message' => 'User not found'], 401);
        }

        $token = $this->jwtService->encode($user);

        return response()->json(['token' => $token]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->only([
            'name',
            'email',
            'password',
        ]));

        event(new Registered($user));

        return response()->json($user, 201);
    }

    public function me(): JsonResponse
    {
        return response()->json(request()->user());
    }

    public function logout(): JsonResponse
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
