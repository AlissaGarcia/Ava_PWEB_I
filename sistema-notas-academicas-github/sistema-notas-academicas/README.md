# Sistema de Notas Acadêmicas

Sistema web desenvolvido para a disciplina de **Programação Web I – IFCE Campus Boa Viagem**.

A aplicação permite que usuários autenticados registrem anotações pessoais relacionadas a projetos acadêmicos, garantindo controle de acesso, autoria, auditoria das operações e proteção do conteúdo das notas por meio de criptografia.

## Tecnologias

- PHP
- Laravel
- Laravel Breeze
- Blade
- Tailwind CSS
- SQLite
- Composer
- Node.js
- NPM

## Funcionalidades

- Cadastro de usuários
- Login e logout
- Dashboard autenticado
- CRUD completo de notas
- Controle de autoria
- Policy de autorização
- Criptografia do conteúdo com `Crypt::encryptString()`
- Descriptografia com `Crypt::decryptString()`
- Soft Delete
- Registro de `created_at`, `updated_at` e `deleted_at`

## Segurança

O conteúdo das notas é criptografado antes de ser armazenado:

```php
Crypt::encryptString($conteudo);
```

Na exibição:

```php
Crypt::decryptString($conteudo);
```

As senhas são armazenadas com hash seguro pelo Laravel.

A `NotePolicy` garante que cada usuário só possa visualizar, editar e excluir suas próprias notas.

## Instalação

Clone o projeto:

```bash
git clone URL_DO_REPOSITORIO
cd nome-do-projeto
```

Instale as dependências:

```bash
composer install
npm install
```

Configure o ambiente:

```bash
copy .env.example .env
php artisan key:generate
```

No `.env`, configure:

```env
DB_CONNECTION=sqlite
```

Crie o banco SQLite:

```text
database/database.sqlite
```

Execute:

```bash
php artisan migrate
npm run build
php artisan serve
```

Acesse:

```text
http://127.0.0.1:8000
```

## Prints do Sistema

### Tela de Login

**Cole a imagem aqui.**

`[ COLE A IMAGEM AQUI ]`

### Tela de Cadastro

**Cole a imagem aqui.**

`[ COLE A IMAGEM AQUI ]`

### Dashboard

**Cole a imagem aqui.**

`[ COLE A IMAGEM AQUI ]`

### Listagem de Notas

**Cole a imagem aqui.**

`[ COLE A IMAGEM AQUI ]`

### Cadastro de Nota

**Cole a imagem aqui.**

`[ COLE A IMAGEM AQUI ]`

### Visualização da Nota

**Cole a imagem aqui.**

`[ COLE A IMAGEM AQUI ]`

### Edição da Nota

**Cole a imagem aqui.**

`[ COLE A IMAGEM AQUI ]`

### Banco de Dados com Conteúdo Criptografado

**Cole a imagem mostrando o conteúdo criptografado no banco.**

`[ COLE A IMAGEM AQUI ]`

### Soft Delete

**Cole a imagem mostrando o campo `deleted_at`.**

`[ COLE A IMAGEM AQUI ]`

## Testes

- [ ] Cadastro funcionando
- [ ] Login funcionando
- [ ] Logout funcionando
- [ ] Criar nota
- [ ] Listar notas
- [ ] Visualizar nota
- [ ] Editar nota
- [ ] Excluir nota
- [ ] Criptografia funcionando
- [ ] Controle de acesso funcionando
- [ ] Soft Delete funcionando
- [ ] Datas de criação e atualização funcionando

## Autor

**Aluno:** Alissa Garcia Moreira

**Instituição:** Instituto Federal de Educação, Ciência e Tecnologia do Ceará – IFCE

**Campus:** Boa Viagem

**Disciplina:** Programação Web I

**Professor:** ______________________________

**Semestre:** ______________________________

## Repositório

`[ COLE O LINK DO REPOSITÓRIO AQUI ]`
