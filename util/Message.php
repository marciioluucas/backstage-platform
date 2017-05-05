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
     * Message constructor.
     * @param $message
     * @param $tipo
     * @param array $extra
     */
    public function __construct($message,$tipo,$extra = [])
    {
        return json_encode(
            [
                "message" => $message,
                "tipo" => $tipo,
                "extra" => $extra
            ]
        );
    }
}