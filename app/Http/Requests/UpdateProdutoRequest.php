<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoria_id'     => ['required', 'exists:categorias,id'],
            'fornecedor_id'    => ['nullable', 'exists:fornecedores,id'],
            'nome'             => ['required', 'string', 'max:255'],
            'descricao'        => ['nullable', 'string', 'max:1000'],
            'preco_custo'      => ['required', 'numeric', 'min:0'],
            'preco_venda'      => ['required', 'numeric', 'min:0'],
            'quantidade_minima'=> ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'categoria_id.required'      => 'Selecione a categoria do produto.',
            'nome.required'              => 'O nome do produto é obrigatório.',
            'preco_custo.required'       => 'O preço de custo é obrigatório.',
            'preco_venda.required'       => 'O preço de venda é obrigatório.',
            'quantidade_minima.required' => 'A quantidade mínima em estoque é obrigatória.',
        ];
    }
}
