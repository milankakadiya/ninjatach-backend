<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Authorization handled by policy in controller
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->client?->id),
            ],
            'contact_no' => ['nullable', 'string', 'max:20'],
            'birthday'   => ['nullable', 'date'],
            'interests'  => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'email.required'      => 'Email is required.',
            'email.email'         => 'Invalid email format.',
            'email.unique'        => 'Email already taken.',
            'birthday.date'       => 'Invalid date format.',
        ];
    }
}
