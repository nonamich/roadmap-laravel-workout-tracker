<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->setPasswordDefaultRules();
        $this->configureModel();
    }

    private function configureModel(): void
    {
        if ($this->app->isProduction()) {
            return;
        }

        Model::preventLazyLoading();
        Model::preventSilentlyDiscardingAttributes();
    }

    private function setPasswordDefaultRules(): void
    {
        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols();
        });
    }
}
