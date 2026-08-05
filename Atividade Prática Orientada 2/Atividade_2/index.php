<?php

declare(strict_types=1);

require_once "Turma.php";


$turma = new Turma("1º Ano A");


$aluno1 = new Aluno(
    "Ana",
    8.5
);


$aluno2 = new Aluno(
    "Carlos",
    6
);


$aluno3 = new Aluno(
    "Maria",
    4.5
);



$turma->adicionarAluno($aluno1);
$turma->adicionarAluno($aluno2);
$turma->adicionarAluno($aluno3);



?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gerenciador de Turma</title>

<link rel="stylesheet" href="style.css">

</head>


<body>


<main class="container">


<h1>
Gerenciador de Turma
</h1>


<h2>

Turma:

<?php echo $turma->getNome(); ?>

</h2>



<section class="resultado">


<h3>
Lista de alunos
</h3>


<?php foreach ($turma->listarAlunos() as $aluno): ?>


<p>

<strong>
Nome:
</strong>

<?php echo $aluno->getNome(); ?>


<br>


<strong>
Nota:
</strong>

<?php echo $aluno->getNota(); ?>


<br>


<strong>
Situação:
</strong>

<?php echo $aluno->calcularSituacao(); ?>

</p>


<hr>


<?php endforeach; ?>


<h3>

Média da turma:

<?php echo number_format(
    $turma->calcularMedia(),
    2
); ?>


</h3>


</section>


</main>


</body>

</html>