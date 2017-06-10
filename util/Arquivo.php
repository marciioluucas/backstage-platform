<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/06/2017
 * Time: 12:25
 */

namespace backstage\util;


class Arquivo
{
    public static function ler($enderecoArquivo)
    {
        $ponteiro = fopen($enderecoArquivo,
            "r");
        $arquivoString = "";
        while (!feof($ponteiro)) {
            $linha = fgets($ponteiro,
                4096);
            $arquivoString .= $linha;

            fclose($ponteiro);
        }
        return $arquivoString;
    }

    public static function substituirOcorrencias(array $oQueSubstituir, array $peloQueSubstituir, $stringASeProcurar){
        return str_replace($oQueSubstituir, $peloQueSubstituir, $stringASeProcurar);
    }
}