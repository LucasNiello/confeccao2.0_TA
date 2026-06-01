<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'     => ['required', 'string', 'max:255'],
            'cpf_cnpj' => ['required', 'string', 'max:20', 'unique:clientes,cpf_cnpj'],
            'email'    => ['required', 'email', 'max:255'],
            'telefone' => ['required', 'string', 'max:20'],
            'endereco' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required'     => 'O nome do cliente é obrigatório.',
            'cpf_cnpj.required' => 'O CPF ou CNPJ é obrigatório.',
            'cpf_cnpj.unique'   => 'Este CPF/CNPJ já está cadastrado.',
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'telefone.required' => 'O telefone é obrigatório.',
            'endereco.required' => 'O endereço é obrigatório.',
        ];
    }
}
