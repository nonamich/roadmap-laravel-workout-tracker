<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Auth\LoginStoreApiData;
use App\Data\Api\Auth\RegisterStoreApiData;
use App\Data\Shared\CreateUserData;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Services\JwtService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Group('Auth')]
class AuthController extends BaseController
{
    public function __construct(
        private readonly JwtService $jwtService,
        private readonly UserService $userService) {}

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
    public function login(LoginStoreApiData $data): JsonResponse
    {
        $credentials = [
            'email' => $data->email,
            'password' => $data->password,
        ];

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
    public function register(RegisterStoreApiData $data): JsonResource
    {
        $user = $this->userService->create(
            CreateUserData::from($data)
        );

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
