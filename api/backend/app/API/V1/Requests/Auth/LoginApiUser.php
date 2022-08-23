<?php

namespace App\API\V1\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginApiUser extends FormRequest
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

    public function rules()
    {
        return [
            'login' => ['required', 'string','min:1', 'max:120'],
            'password' => ['required', 'string','min:1', 'max:120'],
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'login' => 'Login',
            'password' => 'Password'
        ];
    }

}
