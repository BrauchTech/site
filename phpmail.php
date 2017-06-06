<?php
//Classes necessárias
require 'phpmailer/class.phpmailer.php';
require 'phpmailer/class.smtp.php';

//Recebendo os dados via Post e gravando na variáveis
//Formatando corpo do e-mail para que o e-mail da pessoa seja enviado junto ao corpo.
$nome = $_POST['nome'];
$email = $_POST['email'];
$msg_bruta = '<b>Enviado por:</b>'.$email.'<br /><b>Mensagem:</b>'.$_POST['mensagem'];
$mensagem = $msg_bruta;
//$mensagem = $_POST['mensagem'];

//Instanciando a classe PHPMailer
$mail = new PHPMailer(true);

//Definimos a forma que enviaremos o email
$mail->isSMTP();

//Setamos o endereço SMTP
$mail->Host = 'mx1.weblink.com.br';

//Habilitando a autenticação SMTP
$mail->SMTPAuth = true;

//Usuário SMTP
$mail->Username = 'contato@nawadesign.com.br';

//Senha SMTP
$mail->Password = 'Naw@2016co';

//Habilitando encriptação tls pode ser 'ssl'
$mail->SMTPSecure = 'tls';

//Porta de conexão tcp
$mail->Port = 587;

//Definindo o email remetente
//$mail->From = $email;
$mail->From = 'contato@nawadesign.com.br';

//Definindo o nome do remetente
$mail->FromName = $nome;

//Definindo o destinatário do email
$mail->addAddress('contato@nawadesign.com.br');

//Definindo que o email será enviado como Html
$mail->isHTML(true);

//Definindo o chaset da mensagem
$mail->CharSet = 'utf-8';

//Assunto da mensagem
$mail->Subject = "Contato Website";

//Mensagem do email

$mail->Body = $mensagem;

//Mensagem em texto plano caso o cliente de email não possua suporte para html
$mail->AltBody = $mensagem;

//Enviando e testando se a mensagem foi enviada
if (!$mail->send()) { // se o email não for enviado
	echo 'Mensagem não pode ser enviada'; // mensagem caso o email não seja enviado
	echo 'Erro de Email: ' . $mail->ErrorInfo; // informação de erro
} else {
	echo "<script> alert('Mensagem enviada com sucesso');</script>"; // mensagem se o email for enviado
	echo "<script> window.location='index.php#contato';</script>"; // redirecionamento
}
