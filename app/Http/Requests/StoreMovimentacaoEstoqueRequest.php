<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovimentacaoEstoqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'produto_id' => ['required', 'exists:produtos,id'],
            'tipo'       => ['required', 'in:entrada,saida'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'motivo'     => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'produto_id.required' => 'Selecione o produto.',
            'produto_id.exists'   => 'O produto selecionado não existe.',
            'tipo.required'       => 'O tipo de movimentação é obrigatório.',
            'tipo.in'             => 'O tipo deve ser entrada ou saída.',
            'quantidade.required' => 'A quantidade é obrigatória.',
            'quantidade.integer'  => 'A quantidade deve ser um número inteiro.',
            'quantidade.min'      => 'A quantidade deve ser pelo menos 1.',
            'motivo.required'     => 'O motivo da movimentação é obrigatório.',
        ];
    }
}
