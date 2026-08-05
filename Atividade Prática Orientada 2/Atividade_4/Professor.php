<?php

declare(strict_types=1);

require_once "Pessoa.php";
require_once "Identificacao.php";

class Professor extends Pessoa
{
    use Identificacao;

    private string $disciplina;

    public function __construct(
        string $nome,
        string $disciplina
    ) {
        parent::__construct($nome);

        $this->disciplina = $disciplina;
    }

    public function apresentar(): string
    {
        return
            "Sou professor de " .
            $this->disciplina . ".";
    }
}