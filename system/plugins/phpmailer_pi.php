<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function send_email($host, $port, $protocol, $use_auth, $username, $password, $recipient, $sender, $sender_name, $subject, $message)
{
    require_once("phpmailer/class.phpmailer.php");

    $mail 				= new PHPMailer();
    $body 				= $message;
    $mail->IsSMTP();
    $mail->FromName 	= $sender_name;
    $mail->From 		= $sender;
    $mail->Subject 		= $subject;
    $mail->AltBody 		= strip_tags($message);
    $mail->MsgHTML($body);
    $mail->AddAddress($recipient);
	$mail->Host 		= $host;
	$mail->Mailer   	= $protocol;
	$mail->Password 	= $password;
	$mail->Username 	= $username;
	$mail->SMTPAuth  	= $use_auth;
	$mail->Port  		= $port;

    return $mail->Send();
}
?> 