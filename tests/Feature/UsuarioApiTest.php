<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsuarioApiTest extends TestCase
{
    use RefreshDatabase;

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'nomeUsuario' => 'Fulano',
            'cartaoSus' => '1234567890',
            'cpfUsuario' => '12345678901',
            'cepUsuario' => '01001-000',
            'fotoUsuario' => null,
            'generoUsuario' => 'M',
            'emailUsuario' => 'teste@example.com',
            'senhaUsuario' => 'secret123',
        ], $overrides);
    }

    public function test_criar_usuario()
    {
        $response = $this->postJson('/api/usuarios', $this->validData());
        $response->assertStatus(201)->assertJsonFragment(['email' => 'teste@example.com']);
        $this->assertNotEquals('secret123', Usuario::first()->senha);
    }

    public function test_validacao_de_campos_obrigatorios()
    {
        $response = $this->postJson('/api/usuarios', []);
        $response->assertStatus(422);
    }

    public function test_atualizar_usuario()
    {
        $usuario = Usuario::create([
            'nome' => 'Joao',
            'cartao_sus' => '111',
            'cpf' => '22222222222',
            'cep' => '12345-678',
            'foto' => null,
            'genero' => 'M',
            'email' => 'joao@example.com',
            'senha' => 'old',
        ]);

        $response = $this->putJson('/api/usuarios/'.$usuario->id, [
            'emailUsuario' => 'joao@example.com',
            'senhaUsuario' => 'novaSenha'
        ]);

        $response->assertOk();
        $usuario->refresh();
        $this->assertTrue(password_verify('novaSenha', $usuario->senha));
    }
}
