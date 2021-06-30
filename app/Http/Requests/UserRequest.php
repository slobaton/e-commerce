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
        $rules = [
            'name'=> 'required|string|min:7',
            'email' => 'required|string|unique:users,email',
            'password'=> 'required|string|confirmed',
            'password_confirmation' => 'required'
        ];

        if ($this->getMethod() === 'PATCH') {
            $rules['email'] = "{$rules['email']},{$this->user->id}";
            $rules['password'] = 'nullable|sometimes|string|confirmed';
            $rules['password_confirmation'] = "nullable|sometimes";
        }

        return $rules;
    }
}
