<?php

declare(strict_types=1);

require_once "Aluno.php";


class Turma
{
    private string $nome;

    private array $alunos = [];


    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }


    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }


    public function listarAlunos(): array
    {
        return $this->alunos;
    }


    public function calcularMedia(): float
    {
        if (count($this->alunos) === 0) {
            return 0;
        }


        $soma = 0;


        foreach ($this->alunos as $aluno) {

            $soma += $aluno->getNota();

        }


        return $soma / count($this->alunos);
    }


    public function getNome(): string
    {
        return $this->nome;
    }
}