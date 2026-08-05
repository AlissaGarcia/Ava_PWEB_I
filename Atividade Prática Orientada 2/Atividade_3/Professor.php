<?php

declare(strict_types=1);

require_once "Avaliavel.php";

class Professor implements Avaliavel
{
    private string $nome;

    private float $avaliacao;


    public function __construct(
        string $nome,
        float $avaliacao
    ) {
        $this->nome = $nome;
        $this->avaliacao = $avaliacao;
    }


    public function avaliar(): string
    {
        if ($this->avaliacao >= 7) {
            return "Professor com avaliação satisfatória.";
        }

        return "Professor precisa melhorar sua avaliação.";
    }


    public function getNome(): string
    {
        return $this->nome;
    }
}