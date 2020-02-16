<?php
    require 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;

    $name  = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $message = $_POST['message'];

    $mail = new PHPMailer;

    echo "Estamos enviando, un momento por favor";


    $destination = "jonnathan.c.765@gmail.com";

    $mail             = new PHPMailer();
    $mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = "woney.money";
    $mail->Port       = 465;
    $mail->Username   = "soporte@woney.money";
    $mail->Password   = "Woney123$";
    $mail->SMTPSecure = 'ssl';
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


    if (!$mail->send()) {
        echo 'Ha ocurrido un error ' . $mail->ErrorInfo;
    } else {
        echo 'El mensaje se ha enviado con éxito!';

    }
