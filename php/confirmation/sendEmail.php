<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';


function sendConfirmationEmail($email, $token,$con,$id) {
    $mail = new PHPMailer();

    // SMTP configuration
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
    $mail->isSMTP();                            // Set mailer to use SMTP 
    // $mail->Host = 'localhost';           // Specify main and backup SMTP servers 
    // $mail->SMTPAuth = true;                     // Enable SMTP authentication 
    // // $mail->Username = 'email';       // SMTP username 
    // // $mail->Password = 'password';         // SMTP password 
    // $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
    // $mail->Port = 25;                          // TCP port to connect to 

    $mail->Host = 'localhost';          // Use 'localhost' since MailHog is running on your local machine
    $mail->SMTPAuth = false;            // Disable SMTP authentication
    $mail->SMTPSecure = '';             // No encryption is needed when using MailHog
    $mail->Port = 1025;

    // Sender and recipient
    $mail->setFrom('vasilispapg@outlook.com', 'Taskify');
    $mail->addAddress($email); // Recipient's email address

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Confirm Your Email';
    $mail->Body = "Click the following link to confirm your email: http://192.168.1.101/taskbuddynw/confirm.php?token=$token";
    $mail->CharSet = 'UTF-8';
    // Send the email
    if ($mail->send()) {
        echo 'Message has been sent';
        $expiryTime = date('Y-m-d H:i:s', strtotime('+24 hours'));
        // Store the token along with the user's email and the calculated expiry time in your database
        $sql = "INSERT INTO conf (user_email, conf_token, token_expiry,id) VALUES (?, ?, ?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssi", $email, $token, $expiryTime,$id);
        $stmt->execute();
        $stmt->close();

    }else{
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

function generateUniqueToken($length = 32) {
    // Define the characters allowed in the token
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $token = '';

    // Generate a random token by selecting characters from the allowed set
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $token;
}


sendConfirmationEmail($email,generateUniqueToken(),$conn,$id);

?>
