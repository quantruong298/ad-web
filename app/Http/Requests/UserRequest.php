<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (isset(request()->id)) {
            return [
                'full_name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string'],
            ];
        } else {
            return [
                'full_name' => ['required', 'string', 'max:255'],
                'email_add' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'phone_add' => ['required', 'string'],
            ];
        }

    }
}
