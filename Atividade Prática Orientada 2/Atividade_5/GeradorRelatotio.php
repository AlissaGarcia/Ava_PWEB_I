<?php

declare(strict_types=1);

require_once "Aluno.php";


class GeradorRelatorio
{
    private Aluno $aluno;


    public function __construct(
        Aluno $aluno
    ) {
        $this->aluno = $aluno;
    }


    public function gerar(): string
    {
        return
            "<h2>Relatório Acadêmico</h2>" .

            "<p>" .

            "<strong>Nome:</strong> " .

            htmlspecialchars(
                $this->aluno->getNome()
            ) .

            "</p>" .

            "<p>" .

            "<strong>Nota:</strong> " .

            $this->aluno->getNota() .

            "</p>" .

            "<p>" .

            "<strong>Situação:</strong> " .

            $this->aluno->getSituacao() .

            "</p>";
    }
}