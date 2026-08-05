<?php

declare(strict_types=1);

require_once "Aluno.php";

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim(
        $_POST["nome"] ?? ""
    );

    $notaInformada = str_replace(
        ",",
        ".",
        $_POST["nota"] ?? ""
    );

    if (
        $nome === "" ||
        !is_numeric($notaInformada)
    ) {

        $resultado =
            "Preencha os dados corretamente.";

    } else {

        $nota = (float) $notaInformada;

        if (
            $nota < 0 ||
            $nota > 10
        ) {

            $resultado =
                "A nota deve estar entre 0 e 10.";

        } else {

            $aluno = new Aluno(
                $nome,
                $nota
            );

            $resultado =
                "Aluno: " .
                $aluno->getNome() .
                "<br>" .
                "Nota: " .
                $aluno->getNota() .
                "<br>" .
                "Situação: " .
                $aluno->calcularSituacao();
        }
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

    <title>
        Classificação Acadêmica
    </title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

<main class="container">

    <h1>
        Classificação Acadêmica
    </h1>

    <p>
        Informe os dados do aluno.
    </p>

    <form method="POST">

        <label for="nome">
            Nome
        </label>

        <input
            type="text"
            id="nome"
            name="nome"
            placeholder="Digite o nome"
            required
        >

        <label for="nota">
            Nota
        </label>

        <input
            type="number"
            id="nota"
            name="nota"
            min="0"
            max="10"
            step="0.1"
            placeholder="Exemplo: 8.5"
            required
        >

        <button type="submit">
            Calcular situação
        </button>

    </form>

    <?php if ($resultado !== ""): ?>

        <section class="resultado">

            <?php echo $resultado; ?>

        </section>

    <?php endif; ?>

</main>

</body>

</html>