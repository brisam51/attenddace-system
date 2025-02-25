<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('id');
        return [
            "first_name" => 'required|string|max:255',
            "last_name" => 'required|string|max:255',
            "national_id" => [
                'required',
                 'min:10',
                // 'numeric',
                Rule::unique('users', 'national_id')->ignore($userId),
            ],
            "card_id" => [
                'required',
                // 'numeric',
                 'min:8',
                Rule::unique('users', 'card_id')->ignore($userId)
            ],
//|in:avtive,inactive
           "work_status" => 'nullable',

            "email" => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
//|in:supperadmin,admin,user
            "role" => 'nullable',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048 |dimensions:min_width=100,min_height=100',
            "password" => 'nullable|string|min:8',

        ];
    }

    //Meesage function
    public function messages()
    {
        return [
            'first_name.required' => 'please insert first name',
            'first_name.string' => ' first name must be string',
            'first_name.max' => 'Max first name 255 charctures',

            'last_name.required' => 'please insert last name',
            'last_name.string' => ' last name must be string',
            'last_name.max' => 'Max last name 255 charctures',

            'national_id.required' => 'please  insert national ID',
            'national_id.digets' => ' national ID must be have atleast 10 digits between [1-9]',
            'national_id.numeric' => ' national ID must be only numeric',
            'national_id.unique' => ' This natioanl ID aleardy tacken',

            'card_id.required' => 'please  insert national ID',
            'card_id.digets' => 'national ID must be have atleast 8 digits between [1-9]',
            'card_id.numeric' => 'national ID must be only numeric',
            'card_id.unique' => ' This national ID already tacken',




            'email.required' => 'please insert validated email',
            'email.required' => 'please insert  email',
            'email.email' => 'please insert validated email (Example@gmail.com)',
            'email.unique' => 'This email aleady taken',

            'role.required' => 'please select role from drop dowan list',
            'role.in' => 'role must be sppaer danin ,admin or user',

            'image.image'=>'image must be image file',
            'image.mims'=>'imagefile must have this formats of images(jpeg,png,jpg,gif,svg)',
            'image.max'=>'image size must be less than 2048kb',
            'image.dimensions'=>'aleast image deminsions must be hight:100px , width:100px',

            'password.string'=>'password must be only string charecture',
            'password.min'=>'password must be atleast 8 charture',




        ];
    }
}
