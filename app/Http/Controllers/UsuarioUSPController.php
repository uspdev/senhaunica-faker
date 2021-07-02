<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Utils\OAuthUtils;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsuarioUSPController extends Controller
{
    private function vinculos($nusp)
    {
        $skel = [
            "tipoVinculo" => "OUTROS",
            "codigoSetor" => 0,
            "nomeAbreviadoSetor" => null,
            "nomeSetor" => null,
            "codigoUnidade" => config("faker.codigoUnidade") ?? $nusp%1000,
            "siglaUnidade" => config("faker.siglaUnidade"),
            "nomeUnidade" => config("faker.nomeUnidade"),
            "nomeVinculo" => "Outro",
            "nomeAbreviadoFuncao" => null,
            "tipoFuncao" => null,
        ];

        $vinculos = [];

        # primeiro vamos verificar se $nusp está no env
        foreach (config("faker.vinculos") as $vinc) {
            foreach ($vinc['logins'] as $chave => $nrousp) {
                if ($nrousp == $nusp) {
                    $vinculo = $skel;
                    $vinculo["tipoVinculo"] = $vinc["tipo"];
                    $vinculo["nomeVinculo"] = $vinc["nome"];
                    $vinculo["tipoFuncao"] = $vinc["tipoFuncao"] ?? null;
                    $vinculos[] = $vinculo;
                }
            }
        }

        if ($vinculos == []) {
            # se nao estiver no env, vamos aplicar a regra geral
            $cod = intval($nusp / 10000);
            $nomes = config("faker.vinculos");
            for ($i = 0; $i < count($nomes); $i++) {
                if ($cod % 2 != 0) {
                    $vinculo = $skel;
                    $vinculo["tipoVinculo"] = $nomes[$i]["tipo"];
                    $vinculo["nomeVinculo"] = $nomes[$i]["nome"];
                    $vinculo["tipoFuncao"] = $nomes[$i]["tipoFuncao"] ?? null;
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
        $faker = Factory::create(config('app.faker_locale'));
        $email = explode('@', $faker->email)[0] . $nusp . "@usp.br";
        $telefone = '(3xx14)' . $faker->numberBetween($min = 1000, $max = 9999) . '-' . $faker->numberBetween($min = 1000, $max = 9999);

        $user = [
            "loginUsuario" => $nusp,
            "nomeUsuario" => $faker->firstName . ' ' . $faker->lastName,
            "tipoUsuario" => "I",
            "emailPrincipalUsuario" => $email,
            "emailAlternativoUsuario" => "u" . $nusp . "@computacao.br",
            "emailUspUsuario" => $email,
            "numeroTelefoneFormatado" => $telefone,
            "wsuserid" => Str::random(),
            "vinculo" => $this->vinculos($nusp)
        ];
        return $user;
    }

    public function createUser(Request $request)
    {
        // para testes
        // return response()->json($this->generateUser($request->codpes));

        $oauth_string = $request->header('Authorization');
        $oauth = OAuthUtils::parseAuthorization($oauth_string);
        $user = $this->generateUser($oauth['oauth_token']);
        return response()->json($user);
    }
}
