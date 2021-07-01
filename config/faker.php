<?php

/* Configurações de Faker-USP */

return [

    'vinculos' => [
        [
            'tipo' => 'SERVIDOR',
            "nome" => "Servidor",
            'logins' => explode(",", env("FAKER_SERVIDOR", "")),
        ],
        [
            'tipo' => 'SERVIDOR',
            "nome" => "Servidor",
            'logins' => explode(",", env("FAKER_DOCENTE", "")),
            'tipoFuncao' => 'Docente',            
        ],
        [
            'tipo' => 'ESTAGIARIORH',
            "nome" => "Estagiário",
            'logins' => explode(",", env("FAKER_ESTAGIARIORH", "")),
        ],
        [
            'tipo' => 'ALUNOGR',
            "nome" => "Aluno de Graduação",
            'logins' => explode(",", env("FAKER_ALUNOGR", "")),
        ],
        [
            'tipo' => 'ALUNOPOS',
            "nome" => "Aluno de Pós-graduação",
            'logins' => explode(",", env("FAKER_ALUNOPOS", "")),
        ],
    ],

    'codUnidade' => env("FAKER_CODIGO_UNIDADE", 0),
    'siglaUnidade' => env("FAKER_SIGLA_UNIDADE", 'USP'),
    'nomeUnidade' => env("FAKER_NOME_UNIDADE", 'USP'),

];
