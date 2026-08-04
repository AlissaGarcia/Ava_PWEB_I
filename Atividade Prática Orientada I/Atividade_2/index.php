<?php

$nome = "";
$email = "";
$idade = "";
$mensagem = "";
$dadosEnviados = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $idade = trim($_POST["idade"] ?? "");

    if (empty($nome) || empty($email) || empty($idade)) {

        $mensagem = "Preencha todos os campos.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $mensagem = "Digite um endereço de e-mail válido.";

    } elseif (!is_numeric($idade) || $idade < 1) {

        $mensagem = "Digite uma idade válida.";

    } else {

        $dadosEnviados = true;
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

    <title>Cadastro de Usuário</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <main class="container">

        <h1>Cadastro de Usuário</h1>

        <p>
            Preencha os dados abaixo.
        </p>

        <form method="POST">

            <label for="nome">
                Nome
            </label>

            <input
                type="text"
                id="nome"
                name="nome"
                value="<?php echo htmlspecialchars($nome); ?>"
                placeholder="Digite seu nome"
            >

            <label for="email">
                E-mail
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
                placeholder="Digite seu e-mail"
            >

            <label for="idade">
                Idade
            </label>

            <input
                type="number"
                id="idade"
                name="idade"
                value="<?php echo htmlspecialchars($idade); ?>"
                placeholder="Digite sua idade"
            >

            <button type="submit">
                Cadastrar
            </button>

        </form>

        <?php if ($mensagem !== ""): ?>

            <div class="erro">

                <?php echo $mensagem; ?>

            </div>

        <?php endif; ?>

        <?php if ($dadosEnviados): ?>

            <section class="resultado">

                <h2>
                    Cadastro realizado
                </h2>

                <p>
                    <strong>Nome:</strong>

                    <?php echo htmlspecialchars($nome); ?>
                </p>

                <p>
                    <strong>E-mail:</strong>

                    <?php echo htmlspecialchars($email); ?>
                </p>

                <p>
                    <strong>Idade:</strong>

                    <?php echo htmlspecialchars($idade); ?>
                    anos
                </p>

            </section>

        <?php endif; ?>

    </main>

</body>

</html>