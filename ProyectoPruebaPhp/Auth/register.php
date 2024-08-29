<?php
session_start();
require_once('../BD/conexion.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Email/PhpMailer/Exception.php';
require '../Email/PhpMailer/PHPMailer.php';
require '../Email/PhpMailer/SMTP.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['password'];
$ciudad_id = $_POST['ciudad_id'];

$validated_token = base64_encode(random_bytes(20));
$validated_token = str_replace(['+', '/'], ['-', '_'], $validated_token);

$query = "SELECT * FROM users WHERE email = '$email'";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    $_SESSION['message'] = 'EL correo ya se encuentra registrado';
    header("Location: ../Vistas/Auth/register.php");
    exit();
} else {
    $password = password_hash($password, PASSWORD_BCRYPT);
    $newuser = "INSERT INTO users (rol_id,nombre,apellido,ciudad_id,email,password,validated_token) 
    VALUE (2,'$nombre','$apellido','$ciudad_id','$email','$password','$validated_token')";
    $result_new_user = $mysqli->query($newuser);
    if ($result_new_user) {
        $mail = new PHPMailer(true);
        try {
            $user = "SELECT * FROM users WHERE email = '$email'";
            $result_user = $mysqli->query($user);
            $row = $result_user->fetch_assoc();
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
            $mail->Subject = 'Confirmar Correo';
            $mail->Body = '<div style="max-width:100%; width:80%; margin:auto; padding:2vw; font-family: Arial, sans-serif; background-color: #f9f9f9; border:0.2vw solid #ddd;">
                            <h3 style="font-style:italic; font-weight:bold; color:black;">Hola, este es un correo generado para la verificación de tu cuenta en nuestra librería.</h3>
                            <p style="font-style:italic; color: #555;">Sigue los pasos a continuación.</p>
                            <p style="color: #555;">Haz clic en el siguiente enlace:</p>
                            <a href="http://localhost:3000/Controladores/confirmarCorreo.php?email=' . $email . '&token=' . $validated_token . '" style="display: inline-block; padding: 1vw 1.5vw; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Confirmar cuenta</a>
                        </div>';
            $mail->send();
            $_SESSION['message'] = 'Te has registrado con exito. Se ha enviado un correo de verificacion.';
            header("Location: ../Vistas/Auth/register.php");
            exit();
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            $_SESSION['message'] = 'No se pudo enviar el correo';
            header("Location: ../Vistas/Auth/register.php");
            exit();
        }
    }
}
