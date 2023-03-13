<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bonnelee | registrarse</title>
  <link rel="shortcut icon" href="../imagens/mister.png" type="image/x-icon">
  <link href="../styles/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
  <?php
  include_once("../header.php");
  $portadas= new portadas();
  echo $portadas->portada3();
  include_once("../system_data/dataView.php");
  $class1= '';
  $class2= '';
  if (isset($_SESSION['user'])!="") {
    $class1= 'visually-hidden';
    $class2= '';    
  }else{
    $class1= '';
    $class2= 'visually-hidden';
  }
  ?>
  <!-- cuerpo -->
  <section class="container" id="user">
    <div class="row justify-content-center" style="margin: 80px 0px">
      <!-- regitrar alumnos -->
      <article id="registrar_1" class="col-11 col-md-10 <?php echo $class1;?>">
        <div class="card border-info my-5">
          <div class="card-header text-center"><h3>Registar alumnos</h3></div>
          <!-- Datos personales -->
          <form name="registrar_1" method="POST">
            <div class="row align-items-center">
              <div class="col-12 col-lg-5">
                <div class="ps-lg-3">
                  <img src="../imagens/programador.png" class="img-fluid" alt="Usuario">
                </div>
              </div>
              <div class="col-12 col-lg-7 ps-lg-3">
                <div class="card-body">
                  <div class="mb-3">
                    <div class="input-group input-group-lg is-validation">
                      <span class="input-group-text">DNI:</span>
                      <input type="number" name="dni" id="user_r1Dni"  placeholder="87654321" min="10000000" max="99999999" aria-label="DNI" class="form-control" required>
                      <div class="invalid-feedback">DNI invalido - Tu número de dni tiene que tener 8 digitios y no tener letras ni links.</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="input-group input-group-lg is-validation">
                      <span class="input-group-text">Nombres:</span>
                      <input type="text" name="name" id="user_r1name" placeholder="Nombres" aria-label="Nombre" class="form-control" maxlength="150" required>
                      <div class="invalid-feedback">Nombres invalidos - Es nesesario escribir tu primer nombre mínimo sin números ni links.</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="input-group input-group-lg is-validation">
                      <span class="input-group-text">Apellidos:</span>
                      <input type="text" name="fader" id="user_r1surNameP" placeholder="Paterno" aria-label="Paterno" class="form-control" maxlength="50" required>
                      <input type="text" name="moder" id="user_r1surNameM" placeholder="Materno" aria-label="Materno" class="form-control" maxlength="50" required>
                      <div class="invalid-feedback">Apellidos invalidos -  Es nesesario escribir tus apellidos sin números ni links.</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="input-group input-group-lg is-validation">
                      <span class="input-group-text">Genero:</span>
                      <select name="genero" id="user_r1genero1" aria-label="Genero" class="form-select form-control" required>
                        <option value="0">Ninguno</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otros</option>
                      </select>
                      <div class="invalid-feedback">Genero invalido -  Es nesesario seleccionar una opción sin links ni números.</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="input-group input-group-lg is-validation">
                      <span class="input-group-text">Edad:</span>
                      <input type="number" name="edad" id="user_r1edad"  placeholder="Edad" min="4" max="100" aria-label="Edad" class="form-control" required>
                      <div class="invalid-feedback">Edad invalido -  Es nesesario escribir tu edad sin links.</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="input-group input-group-lg is-validation">
                      <span class="input-group-text">Correo:</span>
                      <input type="gmail" name="correo" id="user_r1correo"  placeholder="ejemplo@gmail.com" aria-label="Correo" class="form-control" maxlength="100" required>
                      <div class="invalid-feedback">Correo invalido -  Es nesesario escribir tu correo sin links.</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="input-group input-group-lg is-validation">
                      <span class="input-group-text">Celular:</span>
                      <input type="number" name="cellPhone" id="user_r1cellPhone1"  placeholder="987654321" min="9000000000" max="999999999" aria-label="cell phone" class="form-control" required>
                      <div class="invalid-feedback">Número invalido -  Es nesesario escribir los 9 digitos de tu celular sin links.</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="input-group input-group-lg is-validation">
                      <span class="input-group-text">Curso:</span>
                      <select name="curso" id="user_r1curso1" aria-label="Curso" class="form-select form-control" required>
                        <option value="0">Ninguno</option>
                        <optgroup label="Cursos actuales">
                          <?php for ($i=0; $i < count($cursoV); $i++) { ?> 
                          <option value="<?php echo $cursoV[$i][10]; ?>"><?php echo $cursoV[$i][1]." - ".$cursoV[$i][8]." - ".$cursoV[$i][9]; ?></option>
                          <?php } ?>
                        </optgroup>
                      </select>
                      <div class="invalid-feedback">Curso invalidos -  Es nesesario seleccionar una opción sin links ni números.</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="form-check is-validation">
                      <input class="form-check-input" type="checkbox" id="user_r1terminos1" checked required>
                      <label class="form-check-label" for="user_r1terminos1">
                        Asepto los <a href="#" class="link-primary">terminos y condiciones</a> que me propone la organización.
                      </label>
                      <div class="invalid-feedback">Terminos invalidos -  Es nesesario aseptar lor terminos de registro.</div>
                    </div>
                  </div>
                </div> <!-- CARD BODY -->                
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="d-grid gap-2">
                <!-- en cada input o select agregar is-invalid para errores -->
                <button class="btn btn-lg btn-info rounded-0" type="submit">Registrarse</button>
              </div>
            </div>
          </form>
        </div> <!-- card -->

      </article>
      <!-- login visually-hidden-->
      <article id="login_1" class="col-11 col-md-10 <?php echo $class2;?>">
        <div class="card border-info my-5">
          <div class="card-header text-center"><h3> Clave de seguridad</h3></div>
          <!-- Datos personales -->
          <form name="login_1" method="POST">
          <div class="row align-items-center">
            <div class="col-12 col-lg-5">
              <div class="ps-lg-3">
                <img src="../imagens/programador.png" class="img-fluid" alt="Usuario">
              </div>
            </div>
            <div class="col-12 col-lg-7 ps-lg-3">
              <div class="card-body">
                <div class="mb-3 row">
                  <label for="staticType" class="col-sm-2 col-form-label"><span class="fs-5">Usuario</span></label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext fs-5 text-uppercase" id="staticType" value="<?php echo $_SESSION['type']; ?>" >
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-group input-group-lg is-validation">
                    <span class="input-group-text">Contraseña:</span>
                    <input type="password" name="password" id="log_r1pass"  placeholder="********" aria-label="password" class="form-control" min="9" autofocus="true" required>
                    <div class="invalid-feedback">Contraseña invalida -  Es nesesario escribir los 8 digitos como minimo sin links.</div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-text text-center">
                    <a href="#" class="link-primary">¿Me olvidé mi contraseña?</a>
                  </div>
                </div>
              </div> <!-- CARD BODY -->
            </div>
          </div>
            <div class="card-footer p-0">
              <div class="col-12 btn-group" role="group">
                <!-- en cada input o select agregar is-invalid para errores -->
                <button class="btn btn-lg btn-info rounded-0" type="button" name="Ingresar">Ingresar</button>
                <button class="btn btn-lg btn-danger rounded-0" type="button" name="cancelar">cancelar</button>
              </div>
            </div>
          </form>
        </div> <!-- card -->

      </article>

    </div>
  </section>

  <?php
  include "../footer.php";
  $footers = new footers();
  echo $footers->footer2();
  ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../configuration/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="../configuration/config-general.js" crossorigin="anonymous"></script>
</body>
</html>
