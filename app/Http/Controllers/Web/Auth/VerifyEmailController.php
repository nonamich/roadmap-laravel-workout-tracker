<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends BaseController
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $this->getUserOrThrow();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard.show', absolute: false).'?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(route('dashboard.show', absolute: false).'?verified=1');
    }
}
