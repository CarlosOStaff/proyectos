<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Proyecto - Libreria</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/app.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
        /* Estilos del modal */
        .modal {
            display: none; /* Ocultar por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
  </head>

  <body>
    <div class="container">
      <div class="row justify-content-md-center mx-auto mt-5">
        <div class="col col-lg-12">
          <div
            class="col-xl-12 d-flex justify-content-center align-items-center mt-5"
          >
            <div class="col-sm-8 shadow-lg p-4 rounded-4">
              <div class="card-body">
                <h4 class="card-title mb-4 text-center fst-italic fw-bold">
                  Login - Libreria
                </h4>
                <div class="col-6 text-center mb-3">
                  <span class="mx-auto d-block"
                    ><a href="#">Volver al inicio</a></span
                  >
                </div>
                <form action="..\..\Auth\login.php" method="POST">
                  <div class="row mb-4">
                    <label
                      for="horizontal-email-input"
                      class="col-sm-3 col-form-label text-end fw-bold fst-italic"
                      >Email</label
                    >
                    <div class="col-sm-9">
                      <input
                        type="email"
                        required
                        name="email"
                        class="form-control"
                        id="horizontal-email-input"
                        placeholder="Enter Your Email ID"
                      />
                    </div>
                  </div>
                  <div class="row mb-4">
                    <label
                      for="horizontal-password-input"
                      class="col-sm-3 col-form-label text-end fw-bold fst-italic"
                      >Password</label
                    >
                    <div class="col-sm-9">
                      <input
                        type="password"
                        required
                        name="password"
                        class="form-control"
                        id="horizontal-password-input"
                        placeholder="Enter Your Password"
                      />
                    </div>
                  </div>
                  <div class="row justify-content-end">
                    <div class="col-sm-9">
                      <div>
                        <button
                          type="submit"
                          class="btn btn-primary w-md fw-bold fst-italic"
                        >
                          Iniciar sesión
                        </button>
                      </div>
                    </div>
                  </div>
                </form>

                <div id="myModal" class="modal">
                  <div class="modal-content">
                    <span class="close">&times;</span>
                    <p id="modalMessage"></p>
                  </div>
                </div>

                <div class="col-6 text-center">
                  <span class="mx-auto d-block"
                    ><a href="#">Recuperar contraseña</a></span
                  >
                </div>
                <!-- end card body -->
              </div>
              <!-- end card -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      // Mostrar el modal si hay un mensaje en la sesión
      window.onload = function() {
          var modal = document.getElementById('myModal');
          var span = document.getElementsByClassName('close')[0];
          var message = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>";
          if (message) {
              document.getElementById('modalMessage').textContent = message;
              modal.style.display = 'block';
              <?php unset($_SESSION['message']); // Limpiar el mensaje ?>
          }
          // Cerrar el modal
          span.onclick = function() {
              modal.style.display = 'none';
          }
          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = 'none';
              }
          }
      }
    </script>
  </body>
</html>
