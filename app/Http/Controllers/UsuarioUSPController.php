<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Utils\OAuthUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsuarioUSPController extends Controller
{
    private function vinculos($nusp)
    {
        $nomes = [
            ["tipo" => "SERVIDOR", "nome" => "Servidor"],
            ["tipo" => "SERVIDOR", "nome" => "Servidor"],
            ["tipo" => "ESTAGIARIORH", "nome" => "Estagiário"],
            ["tipo" => "ALUNOGR", "nome" => "Aluno de Graduação"],
            ["tipo" => "ALUNOPOS", "nome" => "Aluno de Pós-graduação"]
        ];

        $vinculo = [
            "tipoVinculo" => "OUTROS",
            "codigoSetor" => 0,
            "nomeAbreviadoSetor" => null,
            "nomeSetor" => null,
            "codigoUnidade" => $nusp%1000,
            "siglaUnidade" => "USP",
            "nomeUnidade" => "USP",
            "nomeVinculo" => "Outro",
            "nomeAbreviadoFuncao" => null
        ];

        $vinculos = [];
        $cod = intval($nusp/10000);
        for ($i = 0; $i < count($nomes); $i++) {
            if ($cod%2 == 0) {
                $vinculo["tipoVinculo"] = $nomes[$i]["tipo"];
                $vinculo["nomeVinculo"] = $nomes[$i]["nome"];
                $vinculos[] = $vinculo;
            }
            $cod = $cod >> 1;
        }

        # default
        if ($vinculos == []) {
            $vinculos[] = $vinculo;
        }

        return $vinculos;
    }

    private function generateUser($nusp)
    {
        $email = "u".$nusp."@usp.br";
        $user = [
            "loginUsuario" => $nusp,
            "nomeUsuario" => "User ".$nusp%10000,
            "tipoUsuario" => "I",
            "emailPrincipalUsuario" => $email,
            "emailAlternativoUsuario" => "u".$nusp."@computacao.br",
            "emailUspUsuario" => $email,
            "numeroTelefoneFormatado" => "(3xx14)1592-6535",
            "wsuserid" => Str::random(),
            "vinculo" => $this->vinculos($nusp)
        ];
        return $user;
    }

    public function createUser(Request $request)
    {
        $oauth_string = $request->header('Authorization');
        $oauth = OAuthUtils::parseAuthorization($oauth_string);
        $user = $this->generateUser($oauth['oauth_token']);
        return response()->json($user);
    }   
}
