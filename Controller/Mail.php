<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../View\Users\PHPMailer\src\Exception.php';
require '../../View\Users\PHPMailer\src\PHPMailer.php';
require '../../View\Users\PHPMailer\src\SMTP.php';
function sendEmail($UserEmail,$userName,$subject,$message){
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'e21691140@gmail.com';                     
    $mail->Password   = 'jxtlfcbuayjqslcg';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    
    $mail->isHTML(true);
    $mail->setFrom('e21691140@gmail.com', 'EasyBuy');
    $mail->addAddress($UserEmail, $userName);
    $mail->Subject = $subject;
    $mail->Body    = $message; 
    $mail->send();}
?> 