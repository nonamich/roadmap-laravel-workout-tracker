<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Validation\Rules;

class RegisterRequest extends BaseAuthRequest
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
        $rules['password'] = is_array($rules['password']) ? $rules['password'] : [$rules['password']];

        $rules['name'] = ['required', 'string', 'max:255'];
        $rules['email'][] = new Rules\Unique(User::class);
        $rules['password'][] = Rules\Password::defaults();

        return $rules;
    }
}
