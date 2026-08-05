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
    "Matemática"
);


$pessoas = [
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
        Classe Abstrata e Trait
    </title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

<main class="container">

    <h1>
        Sistema de Pessoas
    </h1>

    <?php foreach ($pessoas as $pessoa): ?>

        <article class="card">

            <h2>

                <?php
                echo $pessoa->getNome();
                ?>

            </h2>

            <p>

                <?php
                echo $pessoa->exibirIdentificacao();
                ?>

            </p>

            <p>

                <?php
                echo $pessoa->apresentar();
                ?>

            </p>

        </article>

    <?php endforeach; ?>

</main>

</body>

</html>