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
    $mail->Host = 'smtp.zoho.com';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = 'soporte@woney.money';
    $mail->Password = 'Woney123$';
    // $mail->Password = 'IOn[Y)b$fUiC';
    echo $mail->Username;
    $mail->setFrom('soporte@woney.money', 'Información Woney');
    $mail->addAddress($email, $name);

    $mail->Subject = 'Informacion desde Woney';

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
