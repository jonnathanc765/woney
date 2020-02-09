<?php

    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';

    $email = $_POST['email'];
    $name  = $_POST['name'];
    $message = $_POST['message'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->SMTPDebug = 2;

    $mail->Host = 'smtp.mailtrap.io';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = '6f515f07b3be9c';
    $mail->Password = '1dea3b29c155a6';

    $mail->setFrom('info@woney.com', 'Información Woney');
    $mail->addAddress($email, $name);

    $mail->Subject = 'Información desde Woney';

    // $mail->msgHTML(file_get_contents('message.html'), __DIR__);

    $mail->AltBody = $message;


    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';

    }
