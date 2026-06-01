<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreFuncionarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'      => ['required', 'confirmed', Password::min(8)],
            'cargo_id'      => ['required', 'exists:cargos,id'],
            'cpf'           => ['required', 'string', 'size:14', 'unique:funcionarios,cpf'],
            'telefone'      => ['required', 'string', 'max:20'],
            'data_admissao' => ['required', 'date'],
            'status'        => ['required', 'in:ativo,inativo'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'O nome completo é obrigatório.',
            'email.required'         => 'O e-mail é obrigatório.',
            'email.email'            => 'Informe um e-mail válido.',
            'email.unique'           => 'Este e-mail já está cadastrado.',
            'password.required'      => 'A senha é obrigatória.',
            'password.confirmed'     => 'A confirmação de senha não confere.',
            'cargo_id.required'      => 'Selecione o cargo do funcionário.',
            'cargo_id.exists'        => 'O cargo selecionado não existe.',
            'cpf.required'           => 'O CPF é obrigatório.',
            'cpf.size'               => 'O CPF deve ter 14 caracteres (incluindo pontos e traço).',
            'cpf.unique'             => 'Este CPF já está cadastrado.',
            'telefone.required'      => 'O telefone é obrigatório.',
            'data_admissao.required' => 'A data de admissão é obrigatória.',
            'data_admissao.date'     => 'Informe uma data de admissão válida.',
            'status.required'        => 'O status é obrigatório.',
            'status.in'              => 'O status deve ser ativo ou inativo.',
        ];
    }
}
