<?php

session_start();

$mensagem = "";

if (isset($_SESSION["usuario"])) {
    header("Location: area-restrita.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $senha = trim($_POST["senha"] ?? "");

    if (
        isset($_SESSION["usuario_cadastrado"]) &&
        $email === $_SESSION["usuario_cadastrado"]["email"] &&
        $senha === $_SESSION["usuario_cadastrado"]["senha"]
    ) {

        $_SESSION["usuario"] =
            $_SESSION["usuario_cadastrado"]["nome"];

        header("Location: area-restrita.php");
        exit;

    } else {

        $mensagem =
            "E-mail ou senha inválidos.";
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

    <title>Login</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

    <main class="container">

        <h1>Login</h1>

        <p>
            Entre para acessar o sistema.
        </p>

        <form method="POST">

            <label for="email">
                E-mail
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Digite seu e-mail"
                required
            >

            <label for="senha">
                Senha
            </label>

            <input
                type="password"
                id="senha"
                name="senha"
                placeholder="Digite sua senha"
                required
            >

            <button type="submit">
                Entrar
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

            Ainda não possui cadastro?

            <a href="cadastro.php">
                Cadastre-se
            </a>

        </p>

    </main>

</body>

</html>