<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('location:../index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bonnelee | Estudiantes</title>
  <link href="../styles/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="../styles/generals.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
  <!-- cuerpo -->
  <div class="container-fluid my-3">
    <div class="row">
      <aside class="col-12 col-md-2 p-0 border-end border-dark border-3">
        <div class="container-fluid text-center">
          <img src="../imagens/IMG_20160605_151301~2.jpg" width="40%" class="img-fluid border border-dark border-3 rounded-circle mx-auto d-block" alt="Cargando imagen" title="Jesús Zubilete">
          <h3>Eduardo Rancio Poncio</h3>
        </div>
        <!-- menu admin -->
        <div class="list-group">
          <a href="#alumnos"class="list-group-item list-group-item-action active" title="Perfil">Perfil</a>
          <a href="#tareas" class="list-group-item list-group-item-action" title="Tareas">Tareas</a>
          <a href="#practicas" class="list-group-item list-group-item-action" title="Practicas">Practicas</a>
          <a href="#puntos" class="list-group-item list-group-item-action" title="Puntos">Puntos</a>
          <a href="#promedio" class="list-group-item list-group-item-action" title="Promedio">Promedio</a>
          <a href="#" class="list-group-item list-group-item-action bg-warning">Cerrar sesion</a>
        </div>
      </aside>
      <!-- articulos -->
      <section class="col-12 col-md-10">
        <!-- alumnos -->
        <article id="alumnos" class="container">
          <h1>Alumnos:</h1>
          <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
          <hr class="border-light opacity-75">
          <!-- Datos personales -->
          <form name="datos_personales" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
            <h2 class="mb-3">Datos personales:</h2>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">DNI:</span>
                <input type="number" name="alumno_dp_dni" id="alumno_dp_dni"  placeholder="N° 12345678" min="10000000" max="99999999" aria-label="DNI" class="form-control" value="<?php echo $_SESSION['user'];?>" disabled>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group is-validation">
                <span class="input-group-text">Nombres:</span>
                <input type="text" name="alumno_dp_name1" id="alumno_dp_name1" placeholder="Primer nombre" aria-label="Primer nombre" class="form-control is-invalid" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">Nombres invalidos - Es nesesario escribir tu primer nombre mínimo sin números ni links.</div>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group is-validation">
                <span class="input-group-text">Apellidos:</span>
                <input type="text" name="alumno_dp_surName1" id="alumno_dp_surName1" placeholder="Apellidos" aria-label="Apellidos" class="form-control is-invalid" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">Apellidos invalidos -  Es nesesario escribir tus apellidos sin números ni links.</div>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Genero:</span>
                <input type="text" name="alumno_dp_genero1" id="alumno_dp_genero1" placeholder="Genero" aria-label="Genero" class="form-control" value="Ninguno" disabled>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group is-validation">
                <span class="input-group-text">Edad:</span>
                <input type="number" name="alumno_dp_edad" id="alumno_dp_edad"  placeholder="Edad" min="1" max="200" aria-label="Edad" class="form-control is-invalid" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">Edad invalido -  Es nesesario escribir tu edad sin links.</div>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group is-validation">
                <span class="input-group-text">Correo:</span>
                <input type="gmail" name="alumno_dp_correo1" id="alumno_dp_correo1"  placeholder="ejemplo@gmail.com" aria-label="Correo" class="form-control is-invalid" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">Correo invalido -  Es nesesario escribir tu correo sin links.</div>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group is-validation">
                <span class="input-group-text">Celular:</span>
                <input type="number" name="alumno_dp_cellPhone1" id="alumno_dp_cellPhone1"  placeholder="N° 123456789" min="1000000000" max="999999999" aria-label="cell phone" class="form-control is-invalid" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">Número invalido -  Es nesesario escribir los 9 digitos de tu celular sin links.</div>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Curso:</span>
                <input type="text" name="alumno_dp_curso1" id="alumno_dp_curso1"  placeholder="Curso" aria-label="Curso" class="form-control" value="Exemplo" disabled>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Instituto:</span>
                <input type="text" name="alumno_dp_intituto1" id="alumno_dp_intituto1"  placeholder="Instituto y local" aria-label="Instituto" class="form-control" value="Exemplo" disabled>
              </div>
            </div>
            <div class="col-12 btn-group" role="group" aria-label="opciones de datos personales">
              <!-- en cada input o select agregar la clase is-invalid para errores de escritura -->
              <button type="button" class="btn btn-info" name="mEditar">Editar</button>
              <button type="button" class="btn btn-info visually-hidden" name="mCancelar">Cancelar</button>
              <button type="button" class="btn btn-info visually-hidden" name="mGuardar">Guardar</button>
              <button type="button" class="btn btn-info" name="mPass" data-bs-toggle="modal" data-bs-target="#modalPassword">Contraseña</button>
            </div>
          </form>
        </article>
        <!-- Tareas -->
        <article id="tareas" class="container">
          <h1>Alumnos:</h1>
          <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
          <hr class="border-light opacity-75">
          <!-- ALUMNOS -->
          <div name="table_tareas" class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-body">
              <h2 class="mb-3">Todas las tareas:</h2>
              <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th scope="col" colspan="4">
                      <form name="listar_tareas" class="input-group" method="POST">
                        <span class="input-group-text">Cursos:</span>
                        <select id="listar_Cursos1" class="form-select" title="Cursos que ejerces" aria-label="Cursos que ejerces">
                          <option selected>Todos</option>
                          <optgroup label="Cursos">
                            <option value="java-idat-av.larco">java idat av.larco</option>
                            <option value="java-idat-av.larco">java idat av.larco</option>
                            <option value="java-idat-av.larco">java idat av.larco</option>
                          </optgroup>
                        </select>
                        <button type="button" id="lsCurso_1button" class="btn btn-info">Listar</button>
                      </form>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Nota</th>
                    <th scope="col">fecha propuesta</th>
                    <th scope="col">fecha revición</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Titulo</th>
                    <td>Nota</td>
                    <td>fecha propuesta..</td>
                    <td>fecha revición a 5 dias maximo</td>
                  </tr>
                  <tr>
                    <th  scope="row">Titulo</th>
                    <td>Nota</td>
                    <td>fecha propuesta..</td>
                    <td>fecha revición a 5 dias maximo</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Detalles de Tareas -->
          <div class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-header">Instituto</div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <h4 class="card-title">Titulo</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">fecha propusta: 45/12/22</p>
                </div>
                <div class="col-12 col-md-6">
                  <h3 class="card-text text-center">nota o la revición se mencionara aproximadamente en 5 dias maximo.</h3>
                  <p class="card-text fst-italic">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-header">Instituto</div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <h4 class="card-title">Titulo</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">fecha propusta: 45/12/22</p>
                </div>
                <div class="col-12 col-md-6">
                  <h3 class="card-text text-center">nota o la revición se mencionara aproximadamente en 5 dias maximo.</h3>
                  <p class="card-text fst-italic">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          </div>
        </article>
        <!-- Practicas -->
        <article id="practicas" class="container">
          <h1>Practicas:</h1>
          <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
          <hr class="border-light opacity-75">
          <!-- ALUMNOS -->
          <div name="table_practicas" class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-body">
              <h2 class="mb-3">Todas las Practicas:</h2>
              <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th scope="col" colspan="4">
                      <form name="listar_practicas" class="input-group" method="POST">
                        <span class="input-group-text">Cursos:</span>
                        <select id="listar_Cursos2" class="form-select" title="Cursos que ejerces" aria-label="Cursos que ejerces">
                          <option selected>Todos</option>
                          <optgroup label="Cursos">
                            <option value="java-idat-av.larco">java idat av.larco</option>
                            <option value="java-idat-av.larco">java idat av.larco</option>
                            <option value="java-idat-av.larco">java idat av.larco</option>
                          </optgroup>
                        </select>
                        <button type="button" id="lsCurso_2button" class="btn btn-info">Listar</button>
                      </form>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Nota</th>
                    <th scope="col">fecha propuesta</th>
                    <th scope="col">fecha revición</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Titulo</th>
                    <td>Nota</td>
                    <td>fecha propuesta..</td>
                    <td>fecha revición a 5 dias maximo</td>
                  </tr>
                  <tr>
                    <th  scope="row">Titulo</th>
                    <td>Nota</td>
                    <td>fecha propuesta..</td>
                    <td>fecha revición a 5 dias maximo</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-header">Instituto</div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <h4 class="card-title">Titulo</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">fecha propusta: 45/12/22</p>
                </div>
                <div class="col-12 col-md-6">
                  <h3 class="card-text text-center">nota o la revición se mencionara aproximadamente en 5 dias maximo.</h3>
                  <p class="card-text fst-italic">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-header">Instituto</div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <h4 class="card-title">Titulo</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">fecha propusta: 45/12/22</p>
                </div>
                <div class="col-12 col-md-6">
                  <h3 class="card-text text-center">nota o la revición se mencionara aproximadamente en 5 dias maximo.</h3>
                  <p class="card-text fst-italic">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          </div>
        </article>
        <!-- Puntos -->
        <article id="puntos" class="container">
          <h1>Puntos:</h1>
          <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
          <hr class="border-light opacity-75">
          <!-- ALUMNOS -->
          <div name="table_puntos" class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-body">
              <h2 class="mb-3">Todos los puntos adicionales:</h2>
              <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th scope="col" colspan="4">
                      <form name="listar_puntos" class="input-group" method="POST">
                        <span class="input-group-text">Cursos:</span>
                        <select id="listar_Cursos3" class="form-select" title="Cursos que ejerces" aria-label="Cursos que ejerces">
                          <option selected>Todos</option>
                          <optgroup label="Cursos">
                            <option value="java-idat-av.larco">java idat av.larco</option>
                            <option value="java-idat-av.larco">java idat av.larco</option>
                            <option value="java-idat-av.larco">java idat av.larco</option>
                          </optgroup>
                        </select>
                        <button type="button" id="lsCurso_3button" class="btn btn-info">Listar</button>
                      </form>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Nota</th>
                    <th scope="col">fecha propuesta</th>
                    <th scope="col">fecha revición</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Titulo</th>
                    <td>Nota</td>
                    <td>fecha propuesta..</td>
                    <td>fecha revición a 5 dias maximo</td>
                  </tr>
                  <tr>
                    <th  scope="row">Titulo</th>
                    <td>Nota</td>
                    <td>fecha propuesta..</td>
                    <td>fecha revición a 5 dias maximo</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-header">Instituto</div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <h4 class="card-title">Titulo</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">fecha propusta: 45/12/22</p>
                </div>
                <div class="col-12 col-md-6">
                  <h3 class="card-text text-center">nota o la revición se mencionara aproximadamente en 5 dias maximo.</h3>
                  <p class="card-text fst-italic">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-header">Instituto</div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <h4 class="card-title">Titulo</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">fecha propusta: 45/12/22</p>
                </div>
                <div class="col-12 col-md-6">
                  <h3 class="card-text text-center">nota o la revición se mencionara aproximadamente en 5 dias maximo.</h3>
                  <p class="card-text fst-italic">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          </div>
        </article>
        <!-- Promedio -->
        <article id="promedio" class="container">
          <h1>Promedio:</h1>
          <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
          <hr class="border-light opacity-75">
          <!-- ALUMNOS -->
          <div name="table_promedio" class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-body">
              <h2 class="mb-3">Todas las evaluaciones:</h2>
              <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th scope="col" colspan="4">
                      <form name="listar_promedio" class="input-group" method="POST">
                        <span class="input-group-text">Cursos:</span>
                        <select id="listar_Cursos4" class="form-select" title="Cursos que ejerces" aria-label="Cursos que ejerces">
                          <option selected>Todos</option>
                          <optgroup label="Cursos">
                            <option value="java-idat-av.larco">java idat av.larco</option>
                            <option value="java-idat-av.larco">java idat av.larco</option>
                            <option value="java-idat-av.larco">java idat av.larco</option>
                          </optgroup>
                        </select>
                        <button type="button" id="lsCurso_4button" class="btn btn-info">Listar</button>
                      </form>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Nota</th>
                    <th scope="col">fecha propuesta</th>
                    <th scope="col">fecha revición</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th scope="col" class="text-end">Total:</th>
                    <th scope="col">#</th>
                    <th scope="col" class="text-end">Puntos:</th>
                    <th scope="col">#</th>
                  </tr>
                  <tr>
                    <th scope="col" colspan="2" class="text-end">Promedio:</th>
                    <th scope="col" colspan="2">#</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr>
                    <th scope="row">Titulo</th>
                    <td>Nota</td>
                    <td>fecha propuesta..</td>
                    <td>fecha revición a 5 dias maximo</td>
                  </tr>
                  <tr>
                    <th  scope="row">Titulo</th>
                    <td>Nota</td>
                    <td>fecha propuesta..</td>
                    <td>fecha revición a 5 dias maximo</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-header">Instituto</div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <h4 class="card-title">Titulo</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">fecha propusta: 45/12/22</p>
                </div>
                <div class="col-12 col-md-6">
                  <h3 class="card-text text-center">nota o la revición se mencionara aproximadamente en 5 dias maximo.</h3>
                  <p class="card-text fst-italic">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="card bg-secondary text-dark border border-warning mb-3">
            <div class="card-header">Instituto</div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <h4 class="card-title">Titulo</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">fecha propusta: 45/12/22</p>
                </div>
                <div class="col-12 col-md-6">
                  <h3 class="card-text text-center">nota o la revición se mencionara aproximadamente en 5 dias maximo.</h3>
                  <p class="card-text fst-italic">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          </div>
        </article>
      </section>
    </div>
  </div>

<?php
include "../footer.php";
$footers = new footers();
echo $footers->footer2();
?>
<script src="../configuration/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../configuration/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="../configuration/config-students.js" crossorigin="anonymous"></script>
</body>
</html>
