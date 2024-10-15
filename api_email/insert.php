<?php


$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;    //simple mail transfer protocal

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try{
	$mail->isSMTP();
	$mail->Host='smtp.gmail.com';
	$mail->SMTPAuth=true;

	$mail->Username='mganesanvlogs@gmail.com';
	$mail->Password='qcumbuzhjrdwmpvz';
	$mail->SMTPSecure= PHPMailer::ENCRYPTION_SMTPS;

	$mail->Port= 465;
	$mail->setFrom('from@Example.com','Ganesan');
	$mail->addAddress('mganesan1999@gmail.com');     // send mail id

	$message="email".$email."/n"."subject".$subject."/n"."message".$message;

	$mail->isHTML(true);
	$mail->Subject='Hi I am Ganesan';
	$mail->Body=$message;
	$mail->AltBody='this is the not html claints';

	$mail->send();
	echo'Message Sent Successfull!!';
}catch(Exception $e){
	echo "message could Not be sent.Mailer Error: {$Mail->ErrorInfo}";
}
header('location:index.php');
?>