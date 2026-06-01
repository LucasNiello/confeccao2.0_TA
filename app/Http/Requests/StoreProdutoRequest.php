<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoria_id'  => ['required', 'exists:categorias,id'],
            'fornecedor_id' => ['nullable', 'exists:fornecedores,id'],
            'nome'          => ['required', 'string', 'max:255'],
            'descricao'     => ['nullable', 'string', 'max:1000'],
            'preco_custo'   => ['required', 'numeric', 'min:0'],
            'preco_venda'   => ['required', 'numeric', 'min:0'],
            'quantidade_minima' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'categoria_id.required'      => 'Selecione a categoria do produto.',
            'categoria_id.exists'         => 'A categoria selecionada não existe.',
            'fornecedor_id.exists'        => 'O fornecedor selecionado não existe.',
            'nome.required'              => 'O nome do produto é obrigatório.',
            'preco_custo.required'       => 'O preço de custo é obrigatório.',
            'preco_custo.numeric'        => 'O preço de custo deve ser um número.',
            'preco_custo.min'            => 'O preço de custo não pode ser negativo.',
            'preco_venda.required'       => 'O preço de venda é obrigatório.',
            'preco_venda.numeric'        => 'O preço de venda deve ser um número.',
            'preco_venda.min'            => 'O preço de venda não pode ser negativo.',
            'quantidade_minima.required' => 'A quantidade mínima em estoque é obrigatória.',
            'quantidade_minima.integer'  => 'A quantidade mínima deve ser um número inteiro.',
            'quantidade_minima.min'      => 'A quantidade mínima não pode ser negativa.',
        ];
    }
}
