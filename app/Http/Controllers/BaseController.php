<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    use AuthorizesRequests;

    protected function getUserOrThrow(): User
    {
        $user = request()->user();

        if (! $user) {
            abort(401);
        }

        return $user;
    }
}
