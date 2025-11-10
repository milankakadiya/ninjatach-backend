<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow only authenticated users to create clients
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'contact_no' => ['nullable', 'string', 'max:20'],
            'birthday'   => ['nullable', 'date'],
            'interests'  => ['nullable', 'array'],
        ];
    }

    /**
     * Custom validation error messages.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'email.required'      => 'Email address is required.',
            'email.email'         => 'Please provide a valid email address.',
            'email.unique'        => 'This email is already registered.',
            'contact_no.max'      => 'Contact number may not exceed 20 characters.',
            'birthday.date'       => 'Please enter a valid date.',
            'interests.array'     => 'Interests must be sent as an array.',
        ];
    }

    /**
     * Always return a JSON response for validation errors.
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'message' => 'Validation error.',
            'errors'  => $validator->errors(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
