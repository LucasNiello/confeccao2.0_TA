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
            'telefone'      => ['required', 'string', 'regex:/^\(\d{2}\) \d{4,5}-\d{4}$/'],
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
            'cpf.size'               => 'O CPF deve estar no formato 000.000.000-00.',
            'cpf.unique'             => 'Este CPF já está cadastrado.',
            'telefone.required'      => 'O telefone é obrigatório.',
            'telefone.regex'         => 'Informe o telefone no formato (99) 99999-9999 (celular) ou (99) 9999-9999 (fixo).',
            'data_admissao.required' => 'A data de admissão é obrigatória.',
            'status.required'        => 'O status é obrigatório.',
        ];
    }
}
