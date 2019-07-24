<?php
require './libphp-phpmailer/class.phpmailer.php';
require './libphp-phpmailer/class.smtp.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'dsportaluk@gmail.com';                 // SMTP username
$mail->Password = 'dsportal@123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('dsportaluk@gmail.com', 'Mailer');
$mail->addAddress('keert170101031@iitg.ac.in');     // Add a recipient

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = "Dear Keerti "  . "<br> " . " Congratulations, you have been selected for the M.Tech course in Data Science Course at IIT Guwahati. Your username and password are as follows:\r\n " . "keerti" . "1" . "\r\n" . "123456789" ;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
