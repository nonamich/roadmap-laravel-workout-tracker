<?php

namespace App\Providers;

use App\Guards\JwtGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Auth::extend('jwt', fn () => new JwtGuard);
    }
}
