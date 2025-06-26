<?php

namespace App\Http\Controllers\Web\Auth;

use App\Data\Web\Auth\LoginStoreData;
use App\Http\Controllers\BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends BaseController
{
    public function create(): Response
    {
        return Inertia::render('auth/LoginPage');
    }

    public function store(LoginStoreData $data): RedirectResponse
    {
        $credentials = [
            'email' => $data->email,
            'password' => $data->password,
        ];

        if (Auth::attempt($credentials, $data->remember)) {
            request()->session()->regenerate();

            return redirect()->intended();
        }

        throw ValidationException::withMessages([
            'email' => 'These credentials do not match our records.',
            'password' => 'These credentials do not match our records.',
        ]);
    }

    public function destroy(): RedirectResponse
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('homepage.show');
    }
}
