<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Validation\Rules\Exists;

class LoginRequest extends BaseAuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['email'] = is_array($rules['email']) ? $rules['email'] : [$rules['email']];

        $rules['email'][] = new Exists(User::class, 'email');

        return $rules;
    }
}
