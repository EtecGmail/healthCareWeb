# prjHealthCareWeb

Este repositório contém uma aplicação Laravel que utiliza Node.js para compilação de assets. As dependências de PHP (vendor) e JavaScript (node_modules), assim como arquivos de ambiente (.env), não são versionados.

Abaixo está um guia rápido para quem acabou de clonar o projeto e precisa configurar o ambiente local.

## Pré-requisitos

| Ferramenta                  | Versão sugerida | Comando para verificar |
| --------------------------- | ---------------- | ---------------------- |
| PHP                         | ≥ 8.2         | `php -v`               |
| Composer                    | ≥ 2.7         | `composer -V`          |
| Node.js + npm ou pnpm       | ≥ 20 LTS      | `node -v` / `npm -v`   |
| MySQL/MariaDB               | 10.x / 8.x       | `mysql -V`             |

## Passo a passo após clonar

```cmd
:: 1. Clone o repositório
git clone https://github.com/ViniMac3do/prjHealthCareWeb
cd prjHealthCareWeb

:: 2. Copie o arquivo de ambiente de exemplo
copy .env.example .env   :: se não houver .env.example, crie um novo .env

:: 3. Gere a chave da aplicação
php artisan key:generate

:: 4. Instale as dependências PHP
composer install         :: usa composer.json para recriar vendor/

:: 5. Instale as dependências JavaScript
npm install              :: recria node_modules/

:: 6. Compile os assets (modo desenvolvimento)
npm run dev              :: ou  npm run build  para produção

:: 7. Ajuste as credenciais do banco no .env
notepad .env             :: DB_DATABASE, DB_USERNAME, DB_PASSWORD

:: 8. Rode as migrations (e seeds, se existirem)
php artisan migrate --seed

:: 9. Crie o link de storage para uploads públicos
php artisan storage:link

:: 10. Suba o servidor local
php artisan serve        :: http://127.0.0.1:8000
```

Após esses passos o projeto estará rodando mesmo sem `vendor`, `node_modules` ou `.env` versionados. Os comandos `composer install` e `npm install` baixarão todas as dependências, e o arquivo `.env` será criado localmente a partir do exemplo.

## O que colocar no repositório

- `.env.example` com valores genéricos e chaves vazias;
- `README.md` com o passo a passo de instalação;
- arquivos em `database/seeders/` para popular o banco com dados de teste (opcional).

## Problemas comuns

| Sintoma | Causa | Solução |
| --- | --- | --- |
| `Class not found...` | Pasta `vendor/` ausente | Rode `composer install` |
| `Cannot find module...` | Pasta `node_modules/` ausente | Rode `npm install` |
| `APP_KEY missing` | Esqueceu de gerar a chave | Rode `php artisan key:generate` |
| Erro 500 ao acessar rota | Config do `.env` incorreta ou migrations n\xC3\xA3o rodaram | Revise o `.env` e rode `php artisan migrate` |
| Arquivos estáticos 404 | Faltou `npm run dev/build` ou `storage:link` | Rode os comandos correspondentes |

Seguindo esse fluxo qualquer colaborador consegue levantar o projeto do zero sem precisar versionar diretórios grandes ou segredos.
