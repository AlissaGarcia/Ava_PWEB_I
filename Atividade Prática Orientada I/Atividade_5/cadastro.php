<?php

session_start();

$nome = "";
$email = "";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome =
        trim($_POST["nome"] ?? "");

    $email =
        trim($_POST["email"] ?? "");

    $senha =
        trim($_POST["senha"] ?? "");

    if (
        empty($nome) ||
        empty($email) ||
        empty($senha)
    ) {

        $mensagem =
            "Preencha todos os campos.";

    } elseif (
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $mensagem =
            "Digite um e-mail válido.";

    } elseif (
        strlen($senha) < 6
    ) {

        $mensagem =
            "A senha deve possuir pelo menos 6 caracteres.";

    } else {

        $_SESSION["usuario_cadastrado"] = [

            "nome" => $nome,

            "email" => $email,

            "senha" => $senha

        ];

        header("Location: index.php");

        exit;
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cadastro</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

    <main class="container">

        <h1>Cadastro</h1>

        <p>
            Crie sua conta.
        </p>

        <form method="POST">

            <label for="nome">
                Nome
            </label>

            <input
                type="text"
                id="nome"
                name="nome"
                value="<?php
                    echo htmlspecialchars(
                        $nome
                    );
                ?>"
                required
            >

            <label for="email">
                E-mail
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?php
                    echo htmlspecialchars(
                        $email
                    );
                ?>"
                required
            >

            <label for="senha">
                Senha
            </label>

            <input
                type="password"
                id="senha"
                name="senha"
                minlength="6"
                required
            >

            <button type="submit">
                Cadastrar
            </button>

        </form>

        <?php if ($mensagem !== ""): ?>

            <div class="erro">

                <?php
                    echo $mensagem;
                ?>

            </div>

        <?php endif; ?>

        <p class="link">

            Já possui uma conta?

            <a href="index.php">
                Fazer login
            </a>

        </p>

    </main>

</body>

</html>