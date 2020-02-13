<?php

    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';

    $name  = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $message = $_POST['message'];

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->setLanguage('es');
    $mail->Host = 'woney.money';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = 'info@woney.money';
    $mail->Password = 'IOn[Y)b$fUiC';

    $mail->setFrom('jonnathan.c.765@gmail.com', 'Información Woney');
    $mail->addAddress($email, $name);

    $mail->Subject = 'Información desde Woney';

    $body = "Nombre:  $name <br> 
                Teléfono: $phone <br>
                Correo: $email <br>
                País: $country <br><br>
                Mensaje: <br>
                $message
        ";

    echo $body;

    $mail->AltBody = $body;
    $mail->Body = $body;


    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';

    }
