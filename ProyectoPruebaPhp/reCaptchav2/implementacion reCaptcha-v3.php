<!-- vista login -->
<?php
session_start();
//require '../../Claves/claves.php';
$publickey = '6LcjxzYqAAAAAFi_77JLs_NgGTKC1V7VU-0i8Ega';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Proyecto - Libreria</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../../Css/modal.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=6LcjxzYqAAAAAFi_77JLs_NgGTKC1V7VU-0i8Ega"></script>
  <script>
    $(document).ready(function() {
      $('#btnlogin').click(function() {
        grecaptcha.ready(function() {
          grecaptcha.execute('6LcjxzYqAAAAAFi_77JLs_NgGTKC1V7VU-0i8Ega', {
            action: 'submit'
          }).then(function(token) {
            $('#form-login').prepend('<input type="hidden" name="token" value="'+token+'">');
            $('#form-login').prepend('<input type="hidden" name="action" value="submit">');
            $('#form-login').submit();
          });
        });
      });
    });
  </script>
</head>

<body>
  <div class="container">
    <div class="row justify-content-md-center mx-auto mt-5">
      <div class="col col-lg-12">
        <div class="col-xl-12 d-flex justify-content-center align-items-center mt-5">
          <div class="col-sm-8 shadow-lg p-4 rounded-4">
            <div class="card-body">
              <h4 class="card-title mb-4 text-center fst-italic fw-bold">Login - Libreria</h4>
              <div class="col-6 text-center mb-3">
                <span class="mx-auto d-block"><a href="..\Home\index.php">Volver al inicio</a></span>
              </div>
              <form action="..\..\Auth\login.php" method="POST" id="form-login">
                <div class="row mb-4">
                  <label for="horizontal-email-input" class="col-sm-3 col-form-label text-end fw-bold fst-italic">Email</label>
                  <div class="col-sm-9">
                    <input type="email" required name="email" class="form-control" id="horizontal-email-input" placeholder="Enter Your Email ID" />
                  </div>
                </div>
                <div class="row mb-4">
                  <label for="horizontal-password-input" class="col-sm-3 col-form-label text-end fw-bold fst-italic">Password</label>
                  <div class="col-sm-9">
                    <input type="password" required name="password" class="form-control" id="horizontal-password-input" placeholder="Enter Your Password" />
                  </div>
                </div>
                <div class="row">
                  <!-- <div class="col text-center">
                    <div class="g-recaptcha d-inline-block" name="g-recaptcha-response"
                      data-sitekey=""></div>
                  </div> -->
                  <div class="row justify-content-end">
                    <div class="col-sm-9">
                      <div>
                        <button type="button" class="btn btn-primary w-md fw-bold fst-italic" id="btnlogin">Iniciar sesión</button>
                        <!-- <button class="g-recaptcha"
                          data-sitekey=""
                          data-callback='onSubmit'
                          data-action='submit'>Submit</button> -->
                      </div>
                    </div>
                  </div>
              </form>
              <div class="col-6 text-center mt-1">
                <span class="mx-auto d-block"><a href="forgotpassword.php">Recuperar contraseña</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include '../Layouts/modal.php'; ?>

</body>

</html>

  <!-- controlador login -->
  <?php
session_start();
require_once('../BD/conexion.php');
require_once '../reCaptchav2/verificar_recaptcha.php';

$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if ($result->num_rows > 0) {
    if (password_verify($password, $row['password'])) {
        if (!is_null($row['email_verified_at'])) {
            if ($row['rol_id'] == 1) {
                /*Valida que la respuesta del captcha sea true*/
                if ($datos['success'] == 1 && $datos['score'] >= 0.5) {
                    $_SESSION['admin'] = $row;
                    header("Location: ../Vistas/Admin/index.php");
                    exit();
                } else {
                    $_SESSION['message'] = 'Completa el captcha';
                }
            } else {
                if ($datos['success'] == 1 && $datos['score'] >= 0.5) {
                    $_SESSION['cliente'] = $row;
                    header("Location: ../Vistas/Cliente/index.php");
                    exit();
                } else {
                    $_SESSION['message'] = 'Completa el captcha';
                }
            }
        } else {
            $_SESSION['message'] = 'Correo no verificado';
        }
    } else {
        $_SESSION['message'] = 'Contraseña inválida';
    }
} else {
    $_SESSION['message'] = 'Usuario no encontrado';
}

header("Location: ../Vistas/Auth/login.php");
exit();

/*verificar captcha*/
define('CLAVE', '6LcjxzYqAAAAACiPm-fQiSjux1VXH0l8VyNn2gPQ');
$token = $_POST['token'];
$action = $_POST['action'];
$cu = curl_init();
curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($cu, CURLOPT_POST, 1);
curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => CLAVE, 'response' => $token)));
curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($cu);
curl_close($cu);

$datos = json_decode($response, true);