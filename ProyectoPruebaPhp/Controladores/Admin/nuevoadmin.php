<?php
require_once('../../BD/conexion.php');
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../Email/PhpMailer/Exception.php';
require '../../Email/PhpMailer/PHPMailer.php';
require '../../Email/PhpMailer/SMTP.php';

$img = $_FILES['img_perfil'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$ciudad_id = $_POST['ciudad_id'];
$ruta_img = "../../Recursos/img/users/perfil/";

$query = "SELECT email FROM users WHERE email = '$email'";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    $_SESSION['message'] = 'El correo ya existe';
    header("Location: ../../Vistas/Admin/Admins/nuevoAdministrador.php");
    exit();
} else {
    $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
    $img_name = $nombre . '_' . $apellido . '_' . $email . '.' . $ext;
    $img_path = $ruta_img . $img_name;
    move_uploaded_file($img['tmp_name'], $img_path);

    $validated_token = base64_encode(random_bytes(20));
    $validated_token = str_replace(['+', '/'], ['-', '_'], $validated_token);
    $newadmin = "INSERT INTO users (rol_id,img_perfil,nombre,apellido,ciudad_id,email,password,validated_token) 
    VALUES(1,'$img_name','$nombre','$apellido','$ciudad_id','$email','$password','$validated_token')";
    $result_newadmin = $mysqli->query($newadmin);

    if ($result_newadmin) {
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

            $_SESSION['message'] = 'Nuevo Administrador creado, El correo de verificacion se ha enviado';
            header("Location: ../../Vistas/Admin/Admins/nuevoAdministrador.php");
            exit();
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            $_SESSION['message'] = 'No se pudo enviar el correo';
            header("Location: ../../Vistas/Admin/Admins/nuevoAdministrador.php");
            exit();
        }
    } else {
        $_SESSION['message'] = 'El correo ya existe';
        header("Location: ../../Vistas/Admin/Admins/nuevoAdministrador.php");
        exit();
    }
}
