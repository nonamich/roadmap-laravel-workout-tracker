<?php

namespace App\Providers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        $this->enforceMorphMap();
    }

    private function configureModel(): void
    {
        if ($this->app->isProduction()) {
            return;
        }

        Model::preventLazyLoading();
        Model::preventSilentlyDiscardingAttributes();
    }

    private function enforceMorphMap(): void
    {
        Relation::enforceMorphMap([
            'schedule' => Schedule::class,
            'workout' => Workout::class,
            'user' => User::class,
        ]);
    }

    private function setPasswordDefaultRules(): void
    {
        Password::defaults(function () {
            $rule = Password::min(6);

            return $this->app->isProduction()
                ? $rule->mixedCase()
                    ->uncompromised()
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                : $rule;
        });
    }
}
