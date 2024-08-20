<?php
require_once('..\BD\conexion.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Email/PhpMailer/Exception.php';
require '../Email/PhpMailer/PHPMailer.php';
require '../Email/PhpMailer/SMTP.php';

$email = $_POST['email'];
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($result->num_rows > 0) {
    $password_reset_token = base64_encode(random_bytes(20));
    $now = new DateTime();
    $now->modify('+1minute');
    $password_reset_expires_at = $now->format('Y-m-d H:i:s');
    $queryUpdate = "UPDATE users SET password_reset_token ='$password_reset_token', password_reset_expires_at='$password_reset_expires_at' WHERE email = '$email'";
    $result = $mysqli->query($queryUpdate);
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'carlos.ovando@staffbridge.com.mx';
        $mail->Password = 'ravk gxlu tgov upyt'; ///2AvD$iFEbS*t3SM 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        //Recipients
        $mail->setFrom('carlos.ovando@staffbridge.com.mx', 'Carlos Ivan Ovando Toledo');
        $mail->addAddress($row['email'], $row['nombre']);     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperacion de contraseña';
        $mail->Body = '<div style="max-width:100%; width:80%; margin: auto; padding: 2vw; font-family: Arial, sans-serif; background-color: #f9f9f9; border: 0.2vw solid #ddd;">
    <h3 style="font-style: italic; font-weight: bold; color: black;">Hola, este es un correo generado para la recuperación de tu contraseña.</h3>
    <p style="font-style: italic; color: #555;">Sigue los pasos a continuación para poder cambiar tu contraseña:</p>
    <p style="color: #555;">Haz clic en el siguiente enlace:</p>
    <a href="http://localhost:3000/ProyectoPruebaPhp/Vistas/Auth/cambiarpassword.php?email='.$email.'&token='.$password_reset_token.'" style="display: inline-block; padding: 1vw 1.5vw; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Cambiar contraseña</a>
</div>';
        $mail->send();
        $_SESSION['message'] = 'Correo enviado';
        header("Location: ../Vistas/Auth/forgotpassword.php");
        exit();
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        $_SESSION['message'] = 'No se pudo enviar el correo';
        header("Location: ../Vistas/Auth/forgotpassword.php");
        exit();
    }
} else {
    $_SESSION['message'] = 'Usuario no encontrado';
    header("Location: ../Vistas/Auth/forgotpassword.php");
    exit();
}
