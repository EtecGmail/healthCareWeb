<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'nomeUsuario' => 'sometimes|string',
            'cartaoSus' => 'sometimes|string|unique:usuarios,cartao_sus,'.$id,
            'cpfUsuario' => 'sometimes|digits:11|unique:usuarios,cpf,'.$id,
            'cepUsuario' => 'sometimes|string',
            'fotoUsuario' => 'nullable|string',
            'generoUsuario' => 'sometimes|string',
            'emailUsuario' => 'sometimes|email|unique:usuarios,email,'.$id,
            'senhaUsuario' => 'sometimes|string|min:6',
        ];
    }
}
