<?php

declare(strict_types=1);

require_once "Avaliavel.php";

class Aluno implements Avaliavel
{
    private string $nome;

    private float $nota;


    public function __construct(
        string $nome,
        float $nota
    ) {
        $this->nome = $nome;
        $this->nota = $nota;
    }


    public function avaliar(): string
    {
        if ($this->nota >= 7) {
            return "Aluno aprovado.";
        }

        if ($this->nota >= 5) {
            return "Aluno em recuperação.";
        }

        return "Aluno reprovado.";
    }


    public function getNome(): string
    {
        return $this->nome;
    }
}