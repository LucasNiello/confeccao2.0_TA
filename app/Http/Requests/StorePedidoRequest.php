<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id'              => ['required', 'exists:clientes,id'],
            'observacoes'             => ['nullable', 'string', 'max:1000'],
            'itens'                   => ['required', 'array', 'min:1'],
            'itens.*.produto_id'      => ['required', 'exists:produtos,id'],
            'itens.*.quantidade'      => ['required', 'integer', 'min:1'],
            'itens.*.preco_unitario'  => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_id.required'             => 'Selecione o cliente do pedido.',
            'cliente_id.exists'               => 'O cliente selecionado não existe.',
            'itens.required'                  => 'Adicione pelo menos um item ao pedido.',
            'itens.min'                       => 'O pedido deve ter pelo menos um item.',
            'itens.*.produto_id.required'     => 'Selecione o produto do item.',
            'itens.*.produto_id.exists'       => 'Um dos produtos selecionados não existe.',
            'itens.*.quantidade.required'     => 'Informe a quantidade do item.',
            'itens.*.quantidade.min'          => 'A quantidade deve ser pelo menos 1.',
            'itens.*.preco_unitario.required' => 'Informe o preço unitário do item.',
            'itens.*.preco_unitario.min'      => 'O preço unitário não pode ser negativo.',
        ];
    }
}
