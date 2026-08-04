<?php

session_start();

// Se o usuário já estiver logado
if (isset($_SESSION["usuario"])) {
    header("Location: area-restrita.php");
    exit;
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = trim($_POST["usuario"] ?? "");
    $senha = trim($_POST["senha"] ?? "");

    // Dados de acesso definidos para a atividade
    $usuarioCorreto = "alissa";
    $senhaCorreta = "123456";

    if ($usuario === $usuarioCorreto && $senha === $senhaCorreta) {

        $_SESSION["usuario"] = $usuario;

        header("Location: area-restrita.php");
        exit;

    } else {

        $mensagem = "Usuário ou senha inválidos.";
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

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <main class="container">

        <h1>Área de Login</h1>

        <p>
            Informe seus dados para acessar o sistema.
        </p>

        <form method="POST">

            <label for="usuario">
                Usuário
            </label>

            <input
                type="text"
                id="usuario"
                name="usuario"
                placeholder="Digite seu usuário"
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

                <?php echo $mensagem; ?>

            </div>

        <?php endif; ?>

        <div class="credenciais">

            <strong>Dados para teste:</strong>

            <p>
                Usuário: alissa
            </p>

            <p>
                Senha: 123456
            </p>

        </div>

    </main>

</body>

</html>