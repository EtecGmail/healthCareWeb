# prjHealthCareWeb

Aplicação Laravel que expõe uma API REST para cadastro e gerenciamento de usuários.
Este guia explica como preparar o ambiente, rodar o projeto localmente e testar
os endpoints utilizando o Postman.

## Pré-requisitos

| Ferramenta             | Versão sugerida | Como verificar |
| ---------------------- | --------------- | -------------- |
| PHP                    | \>= 8.2         | `php -v`       |
| Composer               | \>= 2.7         | `composer -V`  |
| Node.js + npm ou pnpm  | \>= 20 LTS      | `node -v`      |
| MySQL/MariaDB          | 10.x / 8.x      | `mysql -V`     |

## Instalação

```bash
# 1. Clone o repositório
git clone https://github.com/ViniMac3do/prjHealthCareWeb
cd prjHealthCareWeb

# 2. Copie o arquivo de exemplo e gere a chave da aplicação
cp .env.example .env
php artisan key:generate

# 3. Instale as dependências
composer install
npm install
npm run dev       # ou npm run build para produção

# 4. Configure o banco no .env e execute as migrations
# (ajuste DB_DATABASE, DB_USERNAME, DB_PASSWORD)
php artisan migrate --seed

# 5. Crie o link de storage e inicie o servidor
php artisan storage:link
php artisan serve   # http://127.0.0.1:8000
```

## Testando no Postman

1. Importe a coleção `docs/HealthCareAPI.postman_collection.json` no Postman.
2. Defina a variável `base_url` como `http://127.0.0.1:8000` (ou a URL onde a aplicação está rodando).
3. Execute as requisições disponíveis na coleção para interagir com a API.

## Documentação da API

### Usuários

| Método | Endpoint                         | Descrição                    |
| ------ | -------------------------------- | ---------------------------- |
| GET    | `/api/usuarios`                  | Lista todos os usuários      |
| GET    | `/api/usuarios/{id}`             | Busca usuário pelo ID        |
| GET    | `/api/usuarios/email/{email}`    | Busca usuário pelo e-mail    |
| POST   | `/api/usuarios`                  | Cadastra um novo usuário     |
| PUT    | `/api/usuarios/{id}`             | Atualiza dados de um usuário |
| DELETE | `/api/usuarios/{id}`             | Remove um usuário            |

#### Exemplo de corpo para POST/PUT

```json
{
  "nomeUsuario": "Fulano da Silva",
  "cartaoSus": "1234567890",
  "cpfUsuario": "12345678901",
  "cepUsuario": "01001-000",
  "fotoUsuario": "base64-ou-url",
  "generoUsuario": "M",
  "emailUsuario": "fulano@email.com",
  "senhaUsuario": "senha123"
}
```

As respostas são retornadas em JSON contendo os dados do usuário ou mensagens de erro quando aplicável.

## Problemas comuns

| Sintoma                       | Causa                                     | Solução                          |
| ----------------------------- | ----------------------------------------- | -------------------------------- |
| `Class not found...`          | Pasta `vendor/` ausente                   | Rode `composer install`          |
| `Cannot find module...`       | Pasta `node_modules/` ausente             | Rode `npm install`               |
| `APP_KEY missing`             | Chave da aplicação não gerada             | Rode `php artisan key:generate`  |
| Erro 500 ao acessar rota      | `.env` incorreto ou migrations não rodaram| Revise o `.env` e rode `php artisan migrate` |
| Arquivos estáticos 404        | Faltou `npm run dev/build` ou `storage:link` | Execute os comandos correspondentes |

Seguindo estas orientações qualquer colaborador conseguirá levantar e testar o projeto do zero.
