<?php

namespace App\Http\Controllers\Web\Auth;

use App\Data\Shared\CreateUserAction;
use App\Data\Web\Auth\RegisterStoreData;
use App\Http\Controllers\BaseController;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends BaseController
{
    public function __construct(
        private readonly UserService $userService) {}

    public function create(): Response
    {
        return Inertia::render('auth/RegisterPage');
    }

    public function store(RegisterStoreData $data): RedirectResponse
    {
        $user = $this->userService->create(
            CreateUserAction::from($data)
        );

        Auth::login($user, $data->remember);

        return redirect()->route('homepage.show');
    }
}
