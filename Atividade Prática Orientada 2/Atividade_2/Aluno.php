<?php

declare(strict_types=1);

class Aluno
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


    public function getNome(): string
    {
        return $this->nome;
    }


    public function getNota(): float
    {
        return $this->nota;
    }


    public function calcularSituacao(): string
    {
        if ($this->nota >= 7) {
            return "Aprovado";
        }

        if ($this->nota >= 5) {
            return "Recuperação";
        }

        return "Reprovado";
    }
}