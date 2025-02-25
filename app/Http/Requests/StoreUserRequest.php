<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => 'required|string|max:255',
            "last_name" => 'required|string|max:255',
            "national_id" => 'required|digits:10|numeric|unique:users,national_id',
            "card_id" => 'required|digits:8|numeric|unique:users,card_id',
            "birth_date" => 'required',
            "work_status" => 'required',
            "email" => 'required|email|unique:users,email',
            "role" => 'required',
             "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "password" => 'required|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            "first_name.required" => 'Please insert your first name.',
            "first_name.string" => 'The first name must be a string.',
            "first_name.max" => 'The first name may not be longer than 255 characters.',
            "last_name.required" => 'Please insert your last name.',
            "last_name.string" => 'The last name must be a string.',
            "last_name.max" => 'The last name may not be longer than 255 characters.',
            "national_id.required" => 'Please insert your national ID.',
            "national_id.digits" => 'The national ID must be exactly 10 digits long.',
            "national_id.unique" => 'This national ID is already taken.',
            "card_id.required" => 'Please insert your card ID.',
            "card_id.digits" => 'The card ID must be exactly 8 digits long.',
            "card_id.unique" => 'This card ID is already taken.',
            "birth_date.required" => 'Please insert your birth date.',
            "birth_date.date" => 'The birth date must be a valid date.',
            "work_status.required" => 'Please insert your work status.',
            "email.required" => 'Please insert your email address.',
            "email.email" => 'Please insert a valid email address.',
            "email.unique" => 'This email address is already taken.',
            "role.required" => 'Please select a role.',
            "role.in" => 'The selected role is invalid.',
            "image.required" => 'Please upload an image.',
            "image.image" => 'The uploaded file must be an image.',
            "image.mimes" => 'The image must be a file of type: jpeg, png, jpg.',
            "image.max" => 'The image may not be larger than 2048 kilobytes.',
            "password.required" => 'Please insert a password.',
            "password.min" => 'The password must be at least 8 characters long.',
            "password.confirmed" => 'The password confirmation does not match.',
        ];
    }
}
