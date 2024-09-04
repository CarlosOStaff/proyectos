<?php
session_start();
$publickey = '6LdhtTYqAAAAAKEW9qFmj_napun7g_RmNeNR3M86';
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
  <script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>

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
              <form action="..\..\Auth\login.php" method="POST">
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
                <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="<?php echo $publickey ?>"></div>

                <div class="row justify-content-end">
                  <div class="col-sm-9">
                    <div>
                      <button type="submit" class="btn btn-primary w-md fw-bold fst-italic">Iniciar sesión</button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="col-6 text-center">
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