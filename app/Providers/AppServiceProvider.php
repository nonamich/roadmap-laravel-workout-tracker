<?php

namespace App\Providers;

use Illuminate\Validation\Rules\Password;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->setPasswordDefaultRules();
    }

    private function setPasswordDefaultRules() {
        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols();
        });
    }
}
