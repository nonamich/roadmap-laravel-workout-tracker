<?php

namespace App\Services;

use App\Data\Shared\CreateUserAction;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserService
{
    public function create(CreateUserAction $data): User
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);

        event(new Registered($user));

        return $user;
    }
}
