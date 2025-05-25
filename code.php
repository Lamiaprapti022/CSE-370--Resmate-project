<?php
session_start();
include("dbcon.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($name,$email,$verify_token) {

    $mail = new PHPMailer(true);

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'navedabrar80@gmail.com';                     //SMTP username
    $mail->Password   = 'whvujolhzijkoldi';                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('resmate@gmail.com', $name);
    $mail->addAddress($email);     //Add a recipient

    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from ResMate';

    $email_template = "
        <h2>You have registered with ResMate</h2>
        <h5>Verify your email address with the given link below:</h5>
        <br>
        <a href='http://localhost/ResMate/verify-email.php?token=$verify_token' >Click Me</a>
    ";

    $mail->Body    = $email_template;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    
    // echo 'Message has been sent';
}

if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];
    $verify_token = md5(rand());

    // sendemail_verify("$name","$email","$verify_token");
    // echo 'sent or not?';

    $check_email_querry = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_querry_run = mysqli_query($con, $check_email_querry);

    if (mysqli_num_rows($check_email_querry_run) > 0) {
        $_SESSION['status'] = "Email  Already Exists";
        header("Location: register.php");
    } else {
        if ($password != $confirm_pass) {
            $_SESSION['status'] = "Password does not match. Please try again.";
            header("Location: register.php");
        } else {
            $query = "INSERT INTO users (name,phone,email,password,image,verify_token) VALUES ('$name','$phone','$email','$password','default-avatar.png','$verify_token')";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                
                sendemail_verify("$name","$email","$verify_token");

                $_SESSION['status'] = "Registration Successfull. Please verify your email.";
                header("Location: register.php");
            } else {
                $_SESSION['status'] = "Registration Failed. Please try again.";
                header("Location: register.php");
            }
        }
    }
}
