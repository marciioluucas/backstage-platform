<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 31/05/2017
 * Time: 13:26
 */

namespace backstage\util;
use \Firebase\JWT\JWT;

class JWTWrapper
{
    const CHAVE = 'pamonha321';

    public static function encode(array $opcoes) {
        $tempoAtual = time();
        $expiracao = $tempoAtual + $opcoes['expiracao'];

        $parametrosDoToken = [
            'iat'  => $tempoAtual, // Quando fez o token
            'iss'  => $opcoes['dominio'], // Dominio do token
            'exp'  => $expiracao,  // Tempo de expiração do token
            'nbf'  => $tempoAtual - 1, //Verifica se o token não foi feito antes do tempo atual
            'data' => $opcoes['dados'], // Dados do token e.g. dados do usuairo
        ];
        return JWT::encode($parametrosDoToken, self::CHAVE);


    }

    public static function decode($jwt)
    {
        return JWT::decode($jwt, self::CHAVE, ['HS256']);
    }

}