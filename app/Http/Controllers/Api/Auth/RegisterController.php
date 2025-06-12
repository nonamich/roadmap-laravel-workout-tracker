<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
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

        return response()->json(['user' => $user], 201);
    }
}
