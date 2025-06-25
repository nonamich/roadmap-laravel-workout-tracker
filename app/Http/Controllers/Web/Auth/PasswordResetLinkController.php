<?php

namespace App\Http\Controllers\Web\Auth;

use App\Data\Web\Auth\PasswordResetStoreData;
use App\Http\Controllers\BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetLinkController extends BaseController
{
    public function create(Request $request): Response
    {
        return Inertia::render('auth/ForgotPasswordPage', [
            'status' => $request->session()->get('status'),
        ]);
    }

    public function store(PasswordResetStoreData $data): RedirectResponse
    {
        Password::sendResetLink(
            $data->toArray()
        );

        return back()->with('status', __('auth.reset'));
    }
}
