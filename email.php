<?php
// Arquivo  responsável pelo envio de e-mail do link esqueci minha senha
header('Content-type: application/json; charset=utf-8');
// Requesição de classes dependentes


require_once './settings/SMTP.php'; // Obtêm informações das configurações de e-mail
Smtp::getSmtpInfo();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Requisição de plugins dependentes para funcionalidade da  classe PHPMailer, que possibilita o envio de e-mail

require_once './plugins/PHPMailer/src/Exception.php';
require_once './plugins/PHPMailer/src/PHPMailer.php';
require_once './plugins/PHPMailer/src/SMTP.php';
// Obtêm informações do front-end
$name = (string) filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
$telefone = (string) filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT);
$email = (string) filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$subject = (string) filter_input(INPUT_POST, 'subject', FILTER_DEFAULT);
$message = (string) filter_input(INPUT_POST, 'message', FILTER_DEFAULT);

$json = array();

try {
  $mail = new PHPMailer(true); // Passing `true` enables exceptions
  //Configurações do servidor
  $mail->SMTPDebug = SMTP_DEBUG;      // Ativar saída do debug detalhada
  $mail->isSMTP();                    // Definir o usuário remetente  do serviço SMTP
  $mail->Host = SMTP_SERVER;          // Especificar servidor SMTP
  $mail->SMTPAuth = SMTP_AUTH;        // Habilita a autenticação pelo usuário e senha
  $mail->Username = SMTP_USERNAME;    // Usuário SMTP
  $mail->Password = SMTP_PASSWORD;    // Senha do usuário SMTP
  $mail->SMTPSecure = SMTP_SECURE;    // Tipo certificado de segurança TLS ou SSL
  $mail->Port = SMTP_PORT;            // Porta de conexão do servidor SMTP
  //Recipients
  $mail->setFrom(SMTP_USERNAME);
  $mail->addAddress(SMTP_USERNAME_CONTACT);     // Add a destinátario             
  //Logo
  //$mail->addAttachment('../../../assets/imgs/logo.png', 'logo.png'); 
  //Corpo  do e-mail
  $mail->CharSet = 'UTF-8';
  $mail->isHTML(true);   // Definir formato de email para HTML
  $mail->Subject = $subject;
  $mail->Body = $message;
  $mail->AltBody = 'Não é possível ler esse tipo de e-mail';
  $mail->send();

  $menssage = array(
    'send' => true,
    'text' => "Email enviado com sucesso",
  );
  $json['menssage'] = $menssage;
} catch (Exception $ex) {
  $menssage = array(
    'send' => false,
    'text' => "Erro: {$ex->errorMessage()}"
  );
  $json['menssage'] = $menssage;
}

json_encode($json, JSON_PRETTY_PRINT);
header('Location: index.php ');

exit;
