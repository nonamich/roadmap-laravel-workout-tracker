<?php

namespace App\Http\Requests\Exercise;

use App\Models\Exercise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreExerciseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Exercise::class, 'name')
                    ->where('user_id', Auth::id())
            ],
            'category' => ['required', 'string'],
            'description' => ['string', 'nullable'],
        ];
    }
}
