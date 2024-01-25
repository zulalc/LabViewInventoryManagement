<?php

session_start();
include '../database/dbCon.php';

use PHPMailer\PHPMailer\PHPMailer;
require '../vendor\phpmailer\phpmailer\src\Exception.php';
require '../vendor\phpmailer\phpmailer\src\PHPMailer.php';
require '../vendor\phpmailer\phpmailer\src\SMTP.php';
require '../vendor/autoload.php';

function emailVerification($name,$email,$verifyToken){ //php mailer
    $mail = new PHPMailer(true);
   try {                 
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'labviewco@gmail.com';                     //SMTP username
    $mail->Password   = 'pyka ucka csxp jchi';                               //SMTP password
    
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('labviewco@gmail.com', 'LabView Inventory Management');
    $mail->addAddress($email,$name);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from LabView Inventory Management';
    
    $emailTemplate = "<h2>You have registered with LabView Inventory Management</h2>"
            . " <h5>Verify your email address to Login with the below given link</h5>"
            . "<br/><br/>"
            . "<a href= 'http://localhost:3000/registration/verifyEmail.php?token=$verifyToken'> Click This </a>";

    $mail->Body = $emailTemplate;
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

if (isset($_POST['reg_button'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $verifyToken = md5(rand()); //random number
  
    //check email exists, SQL query
    $chechEmail = "SELECT email FROM Users WHERE email='$email' LIMIT 1";
    $chechEmailRun = mysqli_query($con, $chechEmail);

    if (mysqli_num_rows($chechEmailRun) > 0) {
        $_SESSION['status'] = "Email is Already Registered";
        header("Location: register.php");
    } else {
        //Insert user into database
        if($role == 'user'){
        $insertUser = "INSERT INTO users (firstName,lastName,phone,email,password,role,userType,verifyToken) VALUES ('$firstName','$lastName','$phone','$email','$password','$role' ,'Regular','$verifyToken')";
        } else {
            $insertUser = "INSERT INTO users (firstName,lastName,phone,email,password,role,verifyToken) VALUES ('$firstName','$lastName','$phone','$email','$password','$role' ,'$verifyToken')";    
        }
        $insertUserRun = mysqli_query($con, $insertUser);

        if ($insertUserRun) {
            
            emailVerification("$firstName","$email","$verifyToken");
            $_SESSION['status']= "Registration is Succesfull. Verify your Email Please.";
            header("Location: register.php");
        } else {
            $_SESSION['status'] = "Registration Failed. Please Try Again";
            header("Location: register.php");
        }
    }
}
?>

