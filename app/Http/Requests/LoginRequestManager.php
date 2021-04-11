<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequestManager extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|exists:managers',
            'password' => 'required'
        ];
    }
}
