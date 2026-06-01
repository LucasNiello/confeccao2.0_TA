<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFuncionarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $funcionarioId = $this->route('funcionario')?->id;

        return [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('funcionario')?->usuario_id)],
            'cargo_id'      => ['required', 'exists:cargos,id'],
            'cpf'           => ['required', 'string', 'size:14', Rule::unique('funcionarios', 'cpf')->ignore($funcionarioId)],
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
            'cargo_id.required'      => 'Selecione o cargo do funcionário.',
            'cargo_id.exists'        => 'O cargo selecionado não existe.',
            'cpf.required'           => 'O CPF é obrigatório.',
            'cpf.size'               => 'O CPF deve ter 14 caracteres (incluindo pontos e traço).',
            'cpf.unique'             => 'Este CPF já está cadastrado.',
            'telefone.required'      => 'O telefone é obrigatório.',
            'data_admissao.required' => 'A data de admissão é obrigatória.',
            'status.required'        => 'O status é obrigatório.',
        ];
    }
}
