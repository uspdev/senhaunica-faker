<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Utils\OAuthUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Faker\Factory;

class UsuarioUSPController extends Controller
{
    private function vinculos($nusp)
    {
        $nomes = [
            ["tipo" => "SERVIDOR", "nome" => "Servidor"],
            ["tipo" => "ESTAGIARIORH", "nome" => "Estagiário"],
            ["tipo" => "ALUNOPOS", "nome" => "Aluno de Pós-graduação"],
            ["tipo" => "ALUNOGR", "nome" => "Aluno de Graduação"]
        ];

        $skel = [
            "tipoVinculo" => "OUTROS",
            "codigoSetor" => 0,
            "nomeAbreviadoSetor" => null,
            "nomeSetor" => null,
            "codigoUnidade" => config("faker.codigoUnidade"),
            "siglaUnidade" => config("faker.siglaUnidade"),
            "nomeUnidade" => config("faker.nomeUnidade"),
            "nomeVinculo" => "Outro",
            "nomeAbreviadoFuncao" => null, 
            "tipoFuncao" => null
        ];

        $vinculos = [];

        foreach (config("faker.vinculos") as $vinc => $valor) {
            foreach ($valor as $chave => $nrousp) {
                if ($nrousp == $nusp) {
                    $vinculo = $skel;
                    $vinculo["tipoVinculo"] = strtoupper($vinc);
                    //$vinculo["nomeVinculo"] = $nomes[$i]["nome"];  
                    $vinculos[] = $vinculo;                       
                }
            }
        }

        if (empty($vinculos)) {                 

            $cod = intval($nusp/10000);
            for ($i = 0; $i < count($nomes); $i++) {
                if ($cod%2 != 0) {
                    $vinculo = $skel;
                    $vinculo["tipoVinculo"] = $nomes[$i]["tipo"];
                    $vinculo["nomeVinculo"] = $nomes[$i]["nome"]; 
                    if ($i == 1) {
                        $vinculo["tipoFuncao"] = "Docente"; 
                    }
                    $vinculos[] = $vinculo;
                }
                $cod = $cod >> 1;
            }

            # default
            if ($vinculos == []) {
                $vinculos[] = $skel;
            }
        }
        

        return $vinculos;
    }

    private function generateUser($nusp)
    {
        $faker = Factory::create();
        $email = explode('@',$faker->email)[0].$nusp."@usp.br";
        $telefone = '(3xx14)'.$faker->numberBetween($min = 1000, $max = 9999).'-'.$faker->numberBetween($min = 1000, $max = 9999);

        $user = [
            "loginUsuario" => $nusp,
            "nomeUsuario" => $faker->firstName . ' '. $faker->lastName,
            "tipoUsuario" => "I",
            "emailPrincipalUsuario" => $email,
            "emailAlternativoUsuario" => "u".$nusp."@computacao.br",
            "emailUspUsuario" => $email,
            "numeroTelefoneFormatado" => $telefone,
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
