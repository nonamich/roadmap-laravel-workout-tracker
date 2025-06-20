<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Subgroup;

#[Subgroup('Auth')]
class AuthController extends BaseController
{
    public function __construct(private readonly JwtService $jwtService) {}

    #[Response(
        content: [
            'token' => 'abc',
        ],
        status: 200
    )]
    #[Response(
        content: [
            'message' => 'Invalid credentials',
        ],
        status: 422
    )]
    #[Response(
        content: [
            'message' => 'User not found',
        ],
        status: 401
    )]
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only([
            'email',
            'password',
        ]);

        $isAuth = auth()->attempt($credentials);

        if (! $isAuth) {
            return response()->json(['message' => 'Invalid credentials'], 422);
        }

        $user = auth()->user();

        if (! $user) {
            return response()->json(['message' => 'User not found'], 401);
        }

        $token = $this->jwtService->encode($user);

        return response()->json(['token' => $token]);
    }

    #[ResponseFromApiResource(JsonResource::class, User::class)]
    public function register(RegisterRequest $request): JsonResource
    {
        $user = User::create($request->only([
            'name',
            'email',
            'password',
        ]));

        event(new Registered($user));

        return new JsonResource($user);
    }

    #[Authenticated]
    #[ResponseFromApiResource(JsonResource::class, User::class)]
    public function me(): JsonResource
    {
        return new JsonResource(auth()->user());
    }

    #[Authenticated]
    public function logout(): void
    {
        auth()->guard('api')->logout();
    }
}
