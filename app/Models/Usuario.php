<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // nome da tabela
    protected $fillable = [
        'nome',
        'cartao_sus',
        'cpf',
        'cep',
        'foto',
        'genero',
        'email',
        'senha'
    ]; // campos permitidos para inserção em massa
}
