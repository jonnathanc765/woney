<?php

    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';

    $name  = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $message = $_POST['message'];

    $mail = new PHPMailer;

    echo "Estamos enviando, un momento por favor";



    $mail             = new PHPMailer();
    $mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = "woney.money";
    $mail->Port       = 465;
    $mail->Username   = "soporte@woney.money";
    $mail->Password   = "Woney123$";
    $mail->SMTPSecure = 'ssl';
    $mail->SetFrom('soporte@woney.money', 'Soporte de Woney');
    $mail->AddReplyTo("soporte@woney.money","Woney Support");
    $mail->Subject    = "Información desde Woney Web";

    $body = "Nombre:  $name <br> 
                Teléfono: $phone <br>
                Correo: $email <br>
                País: $country <br><br>
                Mensaje: <br>
                $message
        ";

    $mail->AltBody    = $body;
    $mail->MsgHTML($body);
    $address = $email;
    $mail->AddAddress($email);

    // $mail->isSMTP();
    // $mail->SMTPDebug = 2;
    // $mail->setLanguage('es');
    // $mail->Host = 'smtp.zoho.com';
    // $mail->Port = 465;
    // $mail->SMTPAuth = true;
    // $mail->Username = 'soporte@woney.money';
    // $mail->Password = 'Woney123$';
    // // $mail->Password = 'IOn[Y)b$fUiC';
    // echo $mail->Username;
    // $mail->setFrom('soporte@woney.money', 'Información Woney');
    // $mail->addAddress($email, $name);

    // $mail->Subject = 'Informacion desde Woney';
    // $mail->AltBody = $body;
    // $mail->Body = $body;


    if (!$mail->send()) {
        echo 'Ha ocurrido un error ' . $mail->ErrorInfo;
    } else {
        echo 'El mensaje se ha enviado con éxito!';

    }
