<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'razao_social'  => ['required', 'string', 'max:255'],
            'cnpj'          => ['required', 'string', 'max:18', Rule::unique('fornecedores', 'cnpj')->ignore($this->route('fornecedor'))],
            'email'         => ['required', 'email', 'max:255'],
            'telefone'      => ['required', 'string', 'max:20'],
            'tipo_material' => ['required', 'in:tecidos,aviamentos,servicos,maquinario,outros'],
        ];
    }

    public function messages(): array
    {
        return [
            'razao_social.required'  => 'A razão social é obrigatória.',
            'cnpj.required'          => 'O CNPJ é obrigatório.',
            'cnpj.unique'            => 'Este CNPJ já está cadastrado.',
            'email.required'         => 'O e-mail é obrigatório.',
            'email.email'            => 'Informe um e-mail válido.',
            'telefone.required'      => 'O telefone é obrigatório.',
            'tipo_material.required' => 'O tipo de material é obrigatório.',
        ];
    }
}
