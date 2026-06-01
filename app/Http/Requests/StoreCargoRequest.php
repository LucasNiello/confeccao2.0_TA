<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCargoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'         => ['required', 'string', 'max:100'],
            'descricao'    => ['nullable', 'string', 'max:500'],
            'salario_base' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required'         => 'O nome do cargo é obrigatório.',
            'nome.max'              => 'O nome não pode ter mais de 100 caracteres.',
            'salario_base.required' => 'O salário base é obrigatório.',
            'salario_base.numeric'  => 'O salário base deve ser um número.',
            'salario_base.min'      => 'O salário base não pode ser negativo.',
        ];
    }
}
