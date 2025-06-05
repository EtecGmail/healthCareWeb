<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomeUsuario' => 'required|string',
            'cartaoSus' => 'required|string|unique:usuarios,cartao_sus',
            'cpfUsuario' => 'required|digits:11|unique:usuarios,cpf',
            'cepUsuario' => 'required|string',
            'fotoUsuario' => 'nullable|string',
            'generoUsuario' => 'required|string',
            'emailUsuario' => 'required|email|unique:usuarios,email',
            'senhaUsuario' => 'required|string|min:6',
        ];
    }
}
