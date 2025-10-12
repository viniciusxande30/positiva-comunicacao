<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Caminho do autoload do PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $servico = $_POST['servico'];
    $mensagem = $_POST['mensagem'];

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host       = 'mail.positivacomunicacao.com.br'; // SMTP do seu provedor
        $mail->SMTPAuth   = true;
        $mail->Username   = 'comercial@positivacomunicacao.com.br'; // E-mail de envio
        $mail->Password   = '~)TNBR%ZV=[LV3)i';               // Senha do e-mail
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Remetente e destinatário
        $mail->setFrom('comercial@positivacomunicacao.com.br', 'Positiva MKT - Site');
        $mail->addAddress('comercial@positivacomunicacao.com.br');

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = "Nova mensagem de $nome - $servico";
        $mail->Body = "
            <h3>Mensagem do site Positiva MKT</h3>
            <p><strong>Nome:</strong> $nome</p>
            <p><strong>E-mail:</strong> $email</p>
            <p><strong>Assunto:</strong> $servico</p>
            <p><strong>Mensagem:</strong><br>$mensagem</p>
        ";

        $mail->send();
        echo "<script>alert('Mensagem enviada com sucesso!'); window.history.back();</script>";
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}
?>