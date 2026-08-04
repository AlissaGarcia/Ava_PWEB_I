<?php

session_start();

// Verifica se existe uma sessão ativa
if (!isset($_SESSION["usuario"])) {

    header("Location: index.php");
    exit;
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

    <title>Área Restrita</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <main class="container">

        <h1>Área Restrita</h1>

        <p>
            Login realizado com sucesso.
        </p>

        <section class="resultado">

            <h2>
                Bem-vinda,
                <?php echo htmlspecialchars(
                    $_SESSION["usuario"]
                ); ?>!
            </h2>

            <p>
                Você possui acesso à área restrita.
            </p>

        </section>

        <a
            href="logout.php"
            class="botao"
        >
            Sair
        </a>

    </main>

</body>

</html>