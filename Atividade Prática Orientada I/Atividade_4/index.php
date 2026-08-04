<?php

$mensagem = "";
$nome = "";

// Apaga o cookie
if (isset($_GET["acao"]) && $_GET["acao"] === "sair") {

    setcookie(
        "nome_usuario",
        "",
        time() - 3600,
        "/"
    );

    header("Location: index.php");
    exit;
}

// Salva o nome no cookie
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"] ?? "");

    if (!empty($nome)) {

        setcookie(
            "nome_usuario",
            $nome,
            time() + (7 * 24 * 60 * 60),
            "/"
        );

        header("Location: index.php");
        exit;

    } else {

        $mensagem = "Digite seu nome.";
    }
}

// Verifica se o cookie existe
if (isset($_COOKIE["nome_usuario"])) {

    $nome = $_COOKIE["nome_usuario"];
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

    <title>Controle de Acesso com Cookies</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <main class="container">

        <?php if (isset($_COOKIE["nome_usuario"])): ?>

            <h1>
                Olá,
                <?php echo htmlspecialchars($nome); ?>!
            </h1>

            <p>
                Que bom ter você de volta.
            </p>

            <p>
                Seu nome foi encontrado no cookie.
            </p>

            <a
                href="index.php?acao=sair"
                class="botao"
            >
                Apagar dados
            </a>

        <?php else: ?>

            <h1>
                Bem-vindo!
            </h1>

            <p>
                Informe seu nome para continuar.
            </p>

            <form method="POST">

                <label for="nome">
                    Nome
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Digite seu nome"
                    required
                >

                <button type="submit">
                    Salvar nome
                </button>

            </form>

            <?php if ($mensagem !== ""): ?>

                <div class="erro">

                    <?php echo $mensagem; ?>

                </div>

            <?php endif; ?>

        <?php endif; ?>

    </main>

</body>

</html>