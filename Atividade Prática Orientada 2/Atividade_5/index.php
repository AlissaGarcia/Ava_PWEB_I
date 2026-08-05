<?php

declare(strict_types=1);

require_once "Aluno.php";
require_once "GeradorRelatorio.php";


$aluno = new Aluno(
    "Alissa Garcia",
    8.5
);


$relatorio = new GeradorRelatorio(
    $aluno
);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Relatório Acadêmico
    </title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

<main class="container">

    <h1>
        Sistema Acadêmico
    </h1>

    <section class="relatorio">

        <?php

        echo $relatorio->gerar();

        ?>

    </section>

</main>

</body>

</html>