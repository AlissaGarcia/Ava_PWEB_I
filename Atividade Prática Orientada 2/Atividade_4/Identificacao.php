<?php

declare(strict_types=1);

trait Identificacao
{
    public function exibirIdentificacao(): string
    {
        return "Nome: " . $this->nome;
    }
}