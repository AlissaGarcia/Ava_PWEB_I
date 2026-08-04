<?php

session_start();

if (
    !isset($_SESSION["usuario"]) ||
    !isset(
        $_SESSION["usuario_cadastrado"]
    )
) {

    header("Location: index.php");

    exit;
}

$dados =
    $_SESSION["usuario_cadastrado"];

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

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

    <main class="container">

        <h1>
            Área Restrita
        </h1>

        <p>
            Login realizado com sucesso.
        </p>

        <section class="dados">

            <h2>
                Dados do usuário
            </h2>

            <p>

                <strong>
                    Nome:
                </strong>

                <?php

                echo htmlspecialchars(
                    $dados["nome"]
                );

                ?>

            </p>

            <p>

                <strong>
                    E-mail:
                </strong>

                <?php

                echo htmlspecialchars(
                    $dados["email"]
                );

                ?>

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