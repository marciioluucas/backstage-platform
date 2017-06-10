<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/06/2017
 * Time: 12:16
 */

namespace backstage\util;


use PHPMailer;

class Mail
{

    public static $usuarioRemetente;
    public static $senhaRemetente;
    public static $nomeRemetente;
    public static $destinatarios;
    public static $assunto;
    public static $conteudo;


    public static function enviar()
    {

        $mailer = new PHPMailer();
        $mailer->IsSMTP();
        $mailer->SMTPDebug = 1;
        $mailer->Port = 587; //Indica a porta de conexão para a saída de e-mails
        $mailer->Host = 'mx1.hostinger.com';//Endereço do Host do SMTP Locaweb
        $mailer->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
        $mailer->Username = self::$usuarioRemetente; //Login de autenticação do SMTP
        $mailer->Password = self::$senhaRemetente; //Senha de autenticação do SMTP
        $mailer->FromName = self::$nomeRemetente; //Nome que será exibido para o destinatário
        $mailer->From = self::$usuarioRemetente; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP
        for ($i = 0; $i < count(self::$destinatarios); $i++) {
            $mailer->AddAddress(self::$destinatarios[$i]['endereco'], self::$destinatarios[$i]['nome']); //Destinatários
        }
        $mailer->isHTML(true);
        $mailer->Subject = self::$assunto;
        $mailer->Body = Arquivo::ler(self::$conteudo);
        if (!$mailer->Send()) {
            return $mailer->ErrorInfo;
        }
        return true;
    }
}