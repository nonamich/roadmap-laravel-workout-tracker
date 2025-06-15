<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends BaseController
{
    public function create(): Response
    {
        return Inertia::render('auth/RegisterPage');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create($request->all([
            'name',
            'email',
            'password',
        ]));
        $remember = $request->has('remember');

        Auth::login($user, $remember);

        event(new Registered($user));

        return redirect()->route('homepage.show');
    }
}
