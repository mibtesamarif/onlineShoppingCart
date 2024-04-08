<?php
include('query.php');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
if(isset($_POST['sendEmail'])){
$mail = new PHPMailer(true);

try {
    //Server settings
                                                            //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'saimzaidi110786@gmail.com';                     //SMTP username
    $mail->Password   = 'kznyxxhygiwrzezx';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('saimzaidi110786@gmail.com',);
    $mail->addAddress($_POST['userEmail']);     //Add a recipient
   
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'thank you for shopping';
    $mail->Body    = 'hello this is our ecom store';
   
    $mail->send();
    $invoiceId = $_POST['invoiceId'];
    $userEmail = $_POST['userEmail'];
    $query = $pdo->prepare("update invoice set status = 'approved' where u_email = :email and id = :invoiceId");
    $query->bindParam('email', $userEmail);
    $query->bindParam('invoiceId', $invoiceId);
    $query->execute();
    echo '<script>alert("Message has been sent"); location.assign("invoice.php")</script>';




} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}