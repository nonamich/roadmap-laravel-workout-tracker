<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Auth\LoginResponseData;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Subgroup;

#[Subgroup('Auth')]
class AuthController extends BaseController
{
    public function __construct(private readonly JwtService $jwtService) {}

    #[Authenticated]
    #[ResponseFromApiResource(JsonResource::class, LoginResponseData::class)]
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
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

        return new JsonResource($user);
    }

    #[Authenticated]
    public function logout(): void
    {
        Auth::guard('api')->logout();
    }
}
