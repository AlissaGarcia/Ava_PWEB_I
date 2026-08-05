<?php

declare(strict_types=1);

require_once "Aluno.php";
require_once "Professor.php";


$aluno = new Aluno(
    "Ana",
    8.5
);


$professor = new Professor(
    "Carlos",
    9.0
);


// Objetos de classes diferentes
$avaliaveis = [
    $aluno,
    $professor
];

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
        Interfaces e Polimorfismo
    </title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

<main class="container">

    <h1>
        Sistema de Avaliação
    </h1>

    <section class="resultado">

        <?php foreach ($avaliaveis as $avaliavel): ?>

            <article class="card">

                <h2>

                    <?php
                    echo $avaliavel->getNome();
                    ?>

                </h2>

                <p>

                    <?php
                    echo $avaliavel->avaliar();
                    ?>

                </p>

            </article>

        <?php endforeach; ?>

    </section>

</main>

</body>

</html>