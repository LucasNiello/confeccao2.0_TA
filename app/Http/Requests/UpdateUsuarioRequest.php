<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('usuario'))],
            'perfil' => ['required', 'in:admin,funcionario'],
            'ativo'  => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'O nome é obrigatório.',
            'email.required'  => 'O e-mail é obrigatório.',
            'email.email'     => 'Informe um e-mail válido.',
            'email.unique'    => 'Este e-mail já está em uso.',
            'perfil.required' => 'O perfil é obrigatório.',
            'perfil.in'       => 'O perfil deve ser admin ou funcionario.',
        ];
    }
}
