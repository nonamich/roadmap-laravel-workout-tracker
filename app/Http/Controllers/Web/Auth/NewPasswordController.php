<?php

namespace App\Http\Controllers\Web\Auth;

use App\Data\Web\Auth\NewPasswordStoreData;
use App\Data\Web\FlashMessageWebData;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends BaseController
{
    public function create(Request $request): Response
    {
        return Inertia::render('auth/ResetPasswordPage', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    public function store(NewPasswordStoreData $data): RedirectResponse
    {
        $status = Password::reset(
            [
                'email' => $data->email,
                'password' => $data->password,
                'password_confirmation' => $data->passwordConfirmation,
                'token' => $data->token,
            ],
            function (User $user) use ($data) {
                $user
                    ->forceFill([
                        'password' => $data->password,
                        'remember_token' => Str::random(60),
                    ])
                    ->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PasswordReset) {
            return redirect('login')->with(
                'message',
                new FlashMessageWebData(
                    // @phpstan-ignore argument.type
                    title: __($status)
                )
            );
        }

        throw ValidationException::withMessages([
            // @phpstan-ignore argument.type
            'email' => [__($status)],
        ]);
    }
}
