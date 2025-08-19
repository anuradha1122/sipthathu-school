<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        return [
            'nic' => ['required', 'regex:/^([0-9]{9}[VvXx]|[0-9]{12})$/'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate()
    {
        // First check if email exists
        if (!Auth::getProvider()->retrieveByCredentials($this->only('nic'))) {
            throw ValidationException::withMessages([
                'nic' => 'This NIC is not registered in our system.'
            ]);
        }else{

            if (!Auth::attempt(
                $this->only('nic', 'password') + ['active' => 1],
                $this->boolean('remember')
            )) {
                throw ValidationException::withMessages([
                    //'nic' => 'Invalid NIC or account is inactive.',
                    'password' => 'The password you entered is incorrect.'
                ]);
            }
        }
    }
}