<?php

declare(strict_types=1);

abstract class Pessoa
{
    protected string $nome;

    public function __construct(
        string $nome
    ) {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    abstract public function apresentar(): string;
}