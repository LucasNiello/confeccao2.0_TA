<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id'  => ['required', 'exists:clientes,id'],
            'status'      => ['required', 'in:pendente,em_producao,concluido,cancelado'],
            'observacoes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_id.required' => 'Selecione o cliente do pedido.',
            'cliente_id.exists'   => 'O cliente selecionado não existe.',
            'status.required'     => 'O status do pedido é obrigatório.',
            'status.in'           => 'O status selecionado é inválido.',
        ];
    }
}
