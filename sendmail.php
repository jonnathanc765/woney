<?php
    require 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;

    $name  = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $message = $_POST['message'];

    $mail = new PHPMailer;

    echo "Estamos enviando, un momento por favor <br>";


    $destination = "soporte@woney.money";

    $mail             = new PHPMailer();
    $mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 587;
    $mail->Username   = "shopify765@gmail.com";
    $mail->Password   = "5552017j";
    $mail->SMTPSecure = 'tls';
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->SetFrom($destination, 'Soporte de Woney');
    $mail->AddReplyTo($destination,"Woney Support");
    $mail->Subject    = "Información desde Woney Web";
    $mail->AddAddress($destination);

    $body = "Nombre:  $name <br> 
                Teléfono: $phone <br>
                Correo: $email <br>
                País: $country <br><br>
                Mensaje: <br>
                $message
        ";
    $mail->AltBody    = $body;
    $mail->MsgHTML($body);

    echo "Ahi vamos <br>";

    if (!$mail->send()) {
        echo 'Ha ocurrido un error <br>' . $mail->ErrorInfo;
    } else {
        echo 'El mensaje se ha enviado con éxito! <br>';

    }
