<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 05/05/2017
 * Time: 10:53
 */

namespace backstage\util;


/**
 * Class Message
 * @package util
 */
class Message
{

    /**
     * @var
     */
    /**
     * @var
     */
    /**
     * @var
     */
    private $message, $tipo, $extra;

    /**
     * Message constructor.
     * @param $message
     * @param $tipo
     * @param $extra
     */
    public function __construct($message, $tipo, $extra = [])
    {
        $this->message = $message;
        $this->tipo = $tipo;
        $this->extra = $extra;
    }

    public function geraJsonMensagem()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=utf-8");
        return json_encode(
            [
                "message" => $this->message,
                "tipo" => $this->tipo,
                "extra" => $this->extra
            ]);
    }


}