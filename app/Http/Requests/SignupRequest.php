<?php

namespace CodeDelivery\Http\Requests;

use CodeDelivery\Http\Requests\Request;

class SignupRequest extends Request
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
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];

    }

    public function messages()
    {
        return [
            'name' => 'Informe o seu nome',
            'email' => 'E-mail é requerido. Se você já se cadastrou tente recuperar sua senha.',
            'password' => 'Senha é requerida e deve ter no mínimo 8 caracteres.'
        ];
    }

}
