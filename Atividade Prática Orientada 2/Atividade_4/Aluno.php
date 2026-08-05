<?php

declare(strict_types=1);

require_once "Pessoa.php";
require_once "Identificacao.php";

class Aluno extends Pessoa
{
    use Identificacao;

    private float $nota;

    public function __construct(
        string $nome,
        float $nota
    ) {
        parent::__construct($nome);

        $this->nota = $nota;
    }

    public function apresentar(): string
    {
        return
            "Sou aluno e minha nota é " .
            $this->nota . ".";
    }
}