<?php

/* Configurações de Faker-USP */

return [

    'vinculos' => [

        'servidor' => explode(",", env("FAKER_SERVIDOR" , "")),
        'docente' => explode(",", env("FAKER_DOCENTE" , "")),
        'estagiariorh' => explode(",", env("FAKER_ESTAGIARIORH" , "")),
        'alunogr' => explode(",", env("FAKER_ALUNOGR" , "")),
        'alunopos' => explode(",", env("FAKER_ALUNOPOS" , "")),
    ],


    'codUnidade' => env("FAKER_COD_UNIDADE" , 0),
    'siglaUnidade' => env("FAKER_SIGLA_UNIDADE" , 'USP'),
    'nomeUnidade' => env("FAKER_NOME_UNIDADE" , 'USP'),

];