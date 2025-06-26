<?php

namespace App\Services;

use App\Data\Shared\CreateUserData;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserService
{
    public function create(CreateUserData $data): User
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
