<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/phpEmail/PHPMailer/src/Exception.php';
require 'assets/phpEmail/PHPMailer/src/PHPMailer.php';
require 'assets/phpEmail/PHPMailer/src/SMTP.php';


$name = htmlentities("roo");
$email = htmlentities("rolianiestacia@gmail.com");
$subject = htmlentities("TEST EMAIL PHP");
$message = htmlentities("TEST TEST 123");


$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'rolianiestacia@gmail.com';
$mail->Password = 'pcgvnrsdjxwuxzkt';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->isHTML(true);
$mail->setFrom($email, $name);
$mail->addAddress('www.rolianiestacia@gmail.com');
$mail->Subject = ($subject);
$mail->Body = $message;
$mail->send();

header("Location: ./index.html");

?>