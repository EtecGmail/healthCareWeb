<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nome'); // nome do usuário
            $table->string('cartao_sus')->unique(); // cartão do SUS
            $table->string('cpf')->unique(); // CPF único
            $table->string('cep'); // CEP do usuário
            $table->string('foto')->nullable(); // URL ou base64 da foto
            $table->string('genero'); // gênero
            $table->string('email')->unique(); // e-mail único
            $table->string('senha'); // senha (armazenada como string simples - recomenda-se hash)
            $table->timestamps(); // created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
