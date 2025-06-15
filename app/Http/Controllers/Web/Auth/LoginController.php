<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->all([
            'email',
            'password',
        ]);
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        throw ValidationException::withMessages([
            'email' => 'These credentials do not match our records.',
            'password' => 'These credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('homepage.show');
    }
}
