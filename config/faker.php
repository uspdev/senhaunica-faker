<?php

/* Configurações de Faker-USP */

return [

    'vinculos' => [
        [
            'tipoVinculo' => 'SERVIDOR',
            'nomeVinculo' => 'Servidor',
            'logins' => explode(',', env('FAKER_SERVIDOR', '')),
        ],
        [
            'tipoVinculo' => 'SERVIDOR',
            'nomeVinculo' => 'Servidor',
            'tipoFuncao' => 'Docente',
            'logins' => explode(',', env('FAKER_DOCENTE', '')),
        ],
        [
            'tipoVinculo' => 'ESTAGIARIORH',
            'codigoSetor' => 0,
            'nomeAbreviadoSetor' => null,
            'nomeSetor' => null,
            'tipoFuncao' => 'Não Informada',
            'nomeVinculo' => 'Estagiário',
            'logins' => explode(',', env('FAKER_ESTAGIARIORH', '')),
        ],
        [
            'tipoVinculo' => 'ALUNOGR',
            'codigoSetor' => 0,
            'nomeAbreviadoSetor' => null,
            'nomeSetor' => null,
            'tipoFuncao' => null,
            'nomeVinculo' => 'Aluno de Graduação',
            'logins' => explode(',', env('FAKER_ALUNOGR', '')),
        ],
        [
            'tipoVinculo' => 'ALUNOPOS',
            'codigoSetor' => 0,
            'nomeAbreviadoSetor' => null,
            'nomeSetor' => null,
            'tipoFuncao' => null,
            'nomeVinculo' => 'Aluno de Pós-graduação',
            'logins' => explode(',', env('FAKER_ALUNOPOS', '')),
        ],
    ],

    // alguns tipos de função para servidor
    'tipoFuncaoServidor' => [
        'Adacêmica',
        'Administrativa',
        'Biblioteca',
        'Informática',
        'Manutenção',
    ],

    'codigoUnidade' => env('FAKER_CODIGO_UNIDADE', 1),
    'siglaUnidade' => env('FAKER_SIGLA_UNIDADE', 'USP'),
    'nomeUnidade' => env('FAKER_NOME_UNIDADE', 'Universidade de São Paulo'),
    'codigosSetor' => explode(',', env('FAKER_CODIGOS_SETOR', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15')),
];
