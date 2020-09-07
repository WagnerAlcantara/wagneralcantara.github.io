<?php

class Smtp
{

    public function __construct()
    {
    }
    /**Função que defini os parâmetros para o envia de e-mails  */
    static public function getSmtpInfo()
    {
        define('SMTP_DEBUG', '0');  // Mostra log de debug com o valor basta alterar o parâmetro 0 para 1
        define('SMTP_SERVER', 'SMTP.office365.com'); // Endereço do servidor SMTP
        define('SMTP_AUTH', 'true');  // Habilita autenticação via usuário e senha
        define('SMTP_USERNAME', 'wagner.alcantara@outlook.com.br');  // Usuário do servidor SMTP de e-mail
        define('SMTP_PASSWORD', 'wagner3755');  // Senha do servidor SMTP de e-mail 
        define('SMTP_SECURE', 'tls');   // Tipo de certificação de autenticação 
        define('SMTP_PORT', '587');     // Definir a porta do servidor SMTP
        define('SMTP_USERNAME_CONTACT', 'wagner.analise@gmail.com'); // Usuário e-mail para contato padrão vazio

    }
}
