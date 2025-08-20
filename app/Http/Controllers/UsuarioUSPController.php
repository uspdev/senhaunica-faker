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
            'tipoVinculo' => 'OUTROS',
            'codigoSetor' => 0,
            'nomeAbreviadoSetor' => null,
            'nomeSetor' => null,
            'codigoUnidade' => config('faker.codigoUnidade'),
            'siglaUnidade' => config('faker.siglaUnidade'),
            'nomeUnidade' => config('faker.nomeUnidade'),
            'nomeVinculo' => 'Outro',
            'nomeAbreviadoFuncao' => null,
            'tipoFuncao' => null,
        ];

        $vinculos = [];

        # primeiro vamos verificar se $nusp está no env
        foreach (config('faker.vinculos') as $vinc) {
            if (in_array($nusp, $vinc['logins'])) {
                $vinculo = array_merge($skel, $this->obterSetor($vinc));
                $vinculo['tipoVinculo'] = $vinc['tipoVinculo'];
                $vinculo['nomeVinculo'] = $vinc['nomeVinculo'];
                $vinculo['tipoFuncao'] = $this->obterTipoFuncao($vinc);
                $vinculos[] = $vinculo;
            }
        }

        # se nao estiver no env, vamos aplicar a regra geral
        if ($vinculos == []) {
            $cod = intval($nusp / 10000);
            foreach (config('faker.vinculos') as $vinc) {
                if ($cod % 2 !== 0) {
                    $vinculo = array_merge($skel, $this->obterSetor($vinc));
                    $vinculo['tipoVinculo'] = $vinc['tipoVinculo'];
                    $vinculo['nomeVinculo'] = $vinc['nomeVinculo'];
                    $vinculo['tipoFuncao'] = $this->obterTipoFuncao($vinc);
                    $vinculos[] = $vinculo;
                }
                $cod >>= 1;
            }
        }

        # default
        if ($vinculos == []) {
            $vinculos[] = $skel;
        }

        return $vinculos;
    }

    /**
     * Obtém o tipo de função associado a um vínculo.
     *
     * Caso seja servidor não docente, retorna  um tipo de função randomizado do config.
     * Para os demais casos, retorna o valor já definido em `$vinculo['tipoFuncao']`.
     *
     * @param array $vinculo Dados do vínculo
     * @return string|null
     */
    private function obterTipoFuncao($vinculo)
    {
        $tipoFuncaoServidor = config('faker.tipoFuncaoServidor');
        if ($vinculo['tipoVinculo'] == 'SERVIDOR' && empty($vinculo['tipoFuncao'])) {
            // servidor não docente
            $tipoFuncao  = $tipoFuncaoServidor[array_rand($tipoFuncaoServidor)];
        } else {
            $tipoFuncao = $vinculo['tipoFuncao'];
        }
        return $tipoFuncao;
    }

    /**
     * Obtém informações de setor de acordo com o tipo de vínculo.
     *
     * Para vínculos do tipo "ESTAGIARIORH" ou "SERVIDOR", gera um setor
     * fictício com código, nome abreviado e nome completo usando o Faker.
     * Para os demais tipos de vínculo, retorna um array vazio.
     *
     * @param array $vinculo Array com informações do vínculo, incluindo a chave 'tipoVinculo'.
     * @return array
     */
    private function obterSetor($vinculo)
    {
        $faker = \Faker\Factory::create();
        $ret = [];
        switch ($vinculo['tipoVinculo']) {
            case 'ESTAGIARIORH':
            case 'SERVIDOR':
                $ret['codigoSetor'] = array_rand(config('faker.codigosSetor'));
                $ret['nomeAbreviadoSetor'] = strtoupper($faker->lexify('???'));
                $ret['nomeSetor'] = ucwords(substr($faker->words(2, true), 0, 30));
                break;
            case 'ALUNOGR':
            case 'ALUNOPOS':
            case 'TERCEIRIZADO':
            case 'OUTROS':
            default:
        }
        return $ret;
    }

    private function generateUser($nusp)
    {
        $faker = Factory::create(config('app.faker_locale'));
        $email = explode('@', $faker->email)[0] . $nusp . '@usp.br';
        $telefone = '(3xx14)' . $faker->numberBetween($min = 1000, $max = 9999) . '-' . $faker->numberBetween($min = 1000, $max = 9999);

        $user = [
            'loginUsuario' => $nusp,
            'nomeUsuario' => $faker->firstName . ' ' . $faker->lastName,
            'tipoUsuario' => 'I',
            'emailPrincipalUsuario' => $email,
            'emailAlternativoUsuario' => 'u' . $nusp . '@computacao.br',
            'emailUspUsuario' => $email,
            'numeroTelefoneFormatado' => $telefone,
            'wsuserid' => Str::random(),
            'vinculo' => $this->vinculos($nusp)
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
