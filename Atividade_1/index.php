
<?php

// Função responsável por classificar a nota
function classificarAluno(float $nota): string
{
    if ($nota >= 7 && $nota <= 10) {
        return "Aprovado";
    } elseif ($nota >= 5 && $nota < 7) {
        return "Recuperação";
    } elseif ($nota >= 0 && $nota < 5) {
        return "Reprovado";
    }

    return "Nota inválida";
}

// Variáveis iniciais
$resultado = "";
$notaInformada = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $notaInformada = $_POST["nota"];

    // Converte a vírgula em ponto
    $notaInformada = str_replace(",", ".", $notaInformada);

    // Verifica se o valor é numérico
    if (is_numeric($notaInformada)) {

        $nota = (float) $notaInformada;

        // Estrutura de repetição
        $mensagem = "";

        for ($i = 1; $i <= 1; $i++) {
            $situacao = classificarAluno($nota);

            $mensagem = "A nota informada foi $nota. Situação: $situacao";
        }

        $resultado = $mensagem;

    } else {
        $resultado = "Digite uma nota válida.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Classificação Acadêmica</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main class="container">

        <h1>Classificação Acadêmica</h1>

        <p>
            Informe a nota do aluno para verificar sua situação.
        </p>

        <form method="POST">

            <label for="nota">
                Nota do aluno:
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
                Verificar situação
            </button>

        </form>

        <?php if ($resultado !== ""): ?>

            <div class="resultado">

                <h2>Resultado</h2>

                <p>
                    <?php echo $resultado; ?>
                </p>

            </div>

        <?php endif; ?>

    </main>

</body>

</html>