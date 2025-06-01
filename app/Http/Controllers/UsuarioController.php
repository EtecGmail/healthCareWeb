<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    private function checkDuplicates(Request $request)
    {
        if (Usuario::where('email', $request->input('emailUsuario'))->exists()) {
            return response()->json(['erro' => 'E-mail já está cadastrado.'], 400);
        }

        if (Usuario::where('cpf', $request->input('cpfUsuario'))->exists()) {
            return response()->json(['erro' => 'CPF já está cadastrado.'], 400);
        }

        if (Usuario::where('cartao_sus', $request->input('cartaoSus'))->exists()) {
            return response()->json(['erro' => 'Cartão SUS já está cadastrado.'], 400);
        }

        return null;
    }


    public function store(Request $request)
    {
        //This function consists of executing verification for duplicated variables
        $check = $this->checkDuplicates($request);
        if($check){
            return $check;
        }

        // Cria um novo usuário com base nos dados recebidos da requisição
        $usuario = Usuario::create([
            'nome' => $request->input('nomeUsuario'),
            'cartao_sus' => $request->input('cartaoSus'),
            'cpf' => $request->input('cpfUsuario'),
            'cep' => $request->input('cepUsuario'),
            'foto' => $request->input('fotoUsuario'),
            'genero' => $request->input('generoUsuario'),
            'email' => $request->input('emailUsuario'),
            'senha' => $request->input('senhaUsuario'), // Ideal: usar bcrypt($request->input('senhaUsuario'))
        ]);

        // Retorna o usuário criado em formato JSON com status 201 (Criado)
        return response()->json($usuario, 201);
    }

    // Listar todos os usuários cadastrados
    public function index()
    {
        // Busca todos os registros da tabela 'usuarios'
        $usuarios = Usuario::all();

        // Retorna todos os usuários em JSON
        return response()->json($usuarios);
    }

    // Buscar um único usuário pelo ID
    public function show($id)
    {
        // Procura o usuário com base no ID
        $usuario = Usuario::find($id);

        // Se não encontrar, retorna erro 404 com mensagem
        if (!$usuario) {
            return response()->json(['mensagem' => 'Usuário não encontrado (id)'], 404);
        }

        // Retorna os dados do usuário encontrado
        return response()->json($usuario);
    }

    public function buscarPorEmail($email){

        if (!$email) {
            return response()->json(['error' => 'Parâmetro email é obrigatório '], 400);
        }

        $usuario = Usuario::where('email', $email)->first();

        if (!$usuario) {
            return response()->json(['error' => 'Usuário não encontrado (email)'], 404);
        }

        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        //This function consists of executing verification for duplicated variables
        $check = $this->checkDuplicates($request);
        if($check){
            return $check;
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['mensagem' => 'Usuário não encontrado para atualização'], 404);
        }

            $usuario->nome = $request->input('nomeUsuario', $usuario->nome);
            $usuario->cartao_sus = $request->input('cartaoSus', $usuario->cartao_sus);
            $usuario->cpf = $request->input('cpfUsuario', $usuario->cpf);
            $usuario->cep = $request->input('cepUsuario', $usuario->cep);
            $usuario->foto = $request->input('fotoUsuario', $usuario->foto);
            $usuario->genero = $request->input('generoUsuario', $usuario->genero);
            $usuario->email = $request->input('emailUsuario', $usuario->email);
            $usuario->senha = $request->input('senhaUsuario', $usuario->senha); 

            $usuario->save(); //save in the database

        
            return response()->json($usuario);
    }

    public function delete($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['mensagem' => 'Usuário não encontrado.'], 404);
        }

        $usuario->delete();

        return response()->json(['mensagem' => "Usuário ({$usuario->nome}) deletado com sucesso."], 200);

    }


}
