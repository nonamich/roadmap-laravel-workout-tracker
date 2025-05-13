<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController
{
    public function create(): Response
    {
        return Inertia::render('Auth/RegisterPage');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create($request->all([
            'name',
            'email',
            'password',
        ]));
        $remember = $request->has('remember');

        Auth::login($user, $remember);

        event(new Registered($user));

        return redirect()->route('homepage');
    }
}
