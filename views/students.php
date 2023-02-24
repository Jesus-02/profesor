<?php
/* Fecha local */
setlocale(LC_ALL, "es_PE");

/**
 * STUDENTS
 * Data
*/
include_once "../system_data/data_Students.php";
use models\students;
$student = new students();
$dataSt = $student->dataUser();
$dataCurse = $student->userCurses();
$testCurse = $student->testCurse();
/* Session */
if (!isset($_SESSION['user'])) {
  header('location:../index.php');
}
/* asignacion por genero */
$icon=null;
$genero=null;
if($dataSt['row'][4]=="M"){
  $icon="../imagens/userh3.png";
  $genero='Masculino';
}elseif($dataSt['row'][4]=="F"){
  $icon="../imagens/userm2.png";
  $genero='Femenino';
}else{
  $icon="../imagens/lgtbq.png";
  $genero='LGTBQ';
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
  <!-- MODALS --> 
  <!-- Modal password -->
  <div class="modal fade" id="modalPassword" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Administrar contraseña</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3 row visually-hidden">
                  <label for="pass_edit" class="col-sm-2 col-form-label">Usuario:</label>
                  <div class="col-sm-10">
                      <input type="number" readonly class="form-control-plaintext" id="pass_edit" value="<?php echo $_SESSION['user'];?>" disabled>
                  </div>
              </div>
              <div class="mb-3">
                  <div class="input-group is-validation">
                      <span class="input-group-text">Contraseña actual:</span>
                      <input type="password" id="pass_currently" class="form-control" placeholder="********" aria-label="Contraseña actual" required>
                       <div class="invalid-feedback">Contraseña invalida - Es
                      nesesario escribir la contraseña sin links.</div>
                  </div>
              </div>
              <hr class="border border-primary border-2">
              <div class="mb-3">
                  <div class="input-group is-validation">
                      <span class="input-group-text">Nueva contraseña:</span>
                      <input type="password" id="pass_new" class="form-control" placeholder="********" aria-label="Nueva contraseña" required>
                       <div class="invalid-feedback">Contraseña invalida - Es
                      nesesario escribir la contraseña sin links.</div>
                  </div>
              </div>
              <div class="mb-3">
                  <div class="input-group is-validation">
                      <span class="input-group-text">Confirmar contraseña:</span>
                      <input type="password" id="pass_confirm" class="form-control" placeholder="********" aria-label="Confirmar contraseña" required>
                       <div class="invalid-feedback">Contraseña invalida - Es
                      nesesario escribir la contraseña sin links.</div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" name="save">Guardar</button>
          </div>
          </div>
      </div>
  </div>
  <!-- cuerpo -->
  <div class="container-fluid my-3">
    <div class="row">
      <aside class="col-12 col-md-2 p-0 border-end border-dark border-3">
        <div class="container-fluid text-center">
          <img src=<?php echo $icon; ?> width="50%" class="img-fluid border border-dark border-3 rounded-circle mx-auto d-block" alt="Cargando imagen" title="Alumno">
          <h3><?php echo $dataSt['row'][1]." ".$dataSt['row'][2]." ".$dataSt['row'][3];?></h3>
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
        <!-- alumno -->
        <article id="alumnos" class="container">
          <h1>Alumnos:</h1>
          <p class="fs-4">Actualiza tus datos para darte una mejor experiencia &#128521;</p>
          <hr class="border-light opacity-75">
          <!-- Datos personales -->
          <form name="datos_personales" class="card bg-secondary text-dark mb-3">
            <div class="card-header">
              <h2>Datos personales:</h2>
            </div>
            <div class="card-body">
              <div class="mb-3 visually-hidden">
                <div class="input-group">
                  <span class="input-group-text">DNI:</span>
                  <input type="number" name="alumno_dp_dni" id="alumno_dp_dni"  placeholder="N° 12345678" min="10000000" max="99999999" aria-label="DNI" class="form-control" value="<?php echo $_SESSION['user'];?>" disabled>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group is-validation">
                  <span class="input-group-text">Nombres:</span>
                  <input type="text" name="alumno_dp_name1" id="alumno_dp_name1" placeholder="Primer nombre" aria-label="Primer nombre" class="form-control" value="<?php echo $dataSt['row'][1];?>" disabled>
                  <div class="invalid-feedback">Nombres invalidos - Es nesesario escribir tu primer nombre mínimo sin números ni links.</div>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group is-validation">
                  <span class="input-group-text">Apellidos:</span>
                  <input type="text" name="alumno_dp_surName1" id="alumno_dp_surName1" placeholder="Apellido paterno" aria-label="Paterno" class="form-control" value="<?php echo $dataSt['row'][2];?>" disabled>
                  <input type="text" name="alumno_dp_surName2" id="alumno_dp_surName2" placeholder="Apellidos materno" aria-label="Materno" class="form-control" value="<?php echo $dataSt['row'][3];?>" disabled>
                  <div class="invalid-feedback">Apellidos invalidos -  Es nesesario escribir tus apellidos sin números ni links.</div>
                </div>
              </div>              
              <div class="mb-3">
                <div class="input-group">
                  <span class="input-group-text">Genero:</span>
                  <select class="form-select bg-transparent" name="alumno_dp_genero1" id="alumno_dp_genero1" aria-label="Genero" disabled>
                    <option selected disabled value="<?php echo $dataSt['row'][4];?>">Genero <?php echo $genero;?></option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="O">LGTBQ</option>
                  </select>
                  <div class="invalid-feedback">Genero invalido -  Es nesesario seleccionar tu genero.</div>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group is-validation">
                  <span class="input-group-text">Edad:</span>
                  <input type="number" name="alumno_dp_edad" id="alumno_dp_edad"  placeholder="Edad" min="1" max="200" aria-label="Edad" class="form-control" value="<?php echo $dataSt['row'][5];?>" disabled>
                  <div class="invalid-feedback">Edad invalido -  Es nesesario escribir tu edad sin links.</div>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group is-validation">
                  <span class="input-group-text">Correo:</span>
                  <input type="gmail" name="alumno_dp_correo1" id="alumno_dp_correo1"  placeholder="ejemplo@gmail.com" aria-label="Correo" class="form-control" value="<?php echo $dataSt['row'][6];?>" disabled>
                  <div class="invalid-feedback">Correo invalido -  Es nesesario escribir tu correo sin links.</div>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group is-validation">
                  <span class="input-group-text">Celular:</span>
                  <input type="number" name="alumno_dp_cellPhone1" id="alumno_dp_cellPhone1"  placeholder="N° 123456789" min="1000000000" max="999999999" aria-label="cell phone" class="form-control" value="<?php echo $dataSt['row'][7];?>" disabled>
                  <div class="invalid-feedback">Número invalido -  Es nesesario escribir los 9 digitos de tu celular sin links.</div>
                </div>
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
          <!-- Cursos que esta ejerciendo -->
          <h1>Ejerciendo:</h1>
          <p class="fs-4">Cursos que estas ejerciendo.</p>
          <hr class="border-light opacity-75">
          <div class="row mb-2 justify-content-center">
            <?php for($i=0; $i < count($dataCurse); $i++){ ?>
              <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative bg-transparent">
                  <div class="col p-4 d-flex flex-column position-static">
                    <b class="d-inline-block mb-2 text-primary"><?php echo $dataCurse['row'][$i][7]; ?></b>
                    <h3 class="mb-0"><?php echo $dataCurse['row'][$i][2]; ?></h3>
                    <div class="mb-1 text-muted"><?php echo $dataCurse['row'][$i][5]." - ".$dataCurse['row'][$i][6]; ?></div>
                    <p class="card-text mb-auto"><?php echo $dataCurse['row'][$i][3]."<br>".$dataCurse['row'][$i][8]; ?></p>
                    <a href="<?php echo $dataCurse['row'][$i][4]; ?>" target="_blank" class="stretched-link">Más inforrmación</a>
                  </div>
                  <div class="col-auto d-none d-lg-block">
                    <img class="bd-placeholder-img" width="200" height="300" src="https://i.ibb.co/T81KLFC/edificio.jpg" title="Istitutos" alt="Istitutos">                    
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
            
        </article>
        <!-- Tareas -->
        <article id="tareas" class="container">
          <h1>Tareas:</h1>
          <p class="fs-4">Revisa todas tus tareas a detalle &#128208;</p>
          <hr class="border-light opacity-75">
          <!-- ALUMNOS -->
          <div name="table_tareas" class="card mb-3">
            <div class="card-header">
              <h2>Todas las tareas:</h2>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-dark table-hover">
                  <thead>
                    <tr>
                      <th scope="col" colspan="5">
                        <form name="listar_tareas" class="input-group" method="POST">
                          <span class="input-group-text">Cursos:</span>
                          <select id="listar_Cursos1" class="form-select" title="Cursos que ejerces" aria-label="Cursos que ejerces">
                            <option>Todos</option>
                            <optgroup label="Cursos">
                              <?php for($x=0 ; $x<count($dataCurse); $x++){ if($x==0){ ?>
                                <option value="<?php echo $dataCurse['row'][$x][1]; ?>" ><?php echo $dataCurse['row'][$x][2]." / ".$dataCurse['row'][$x][7]; ?></option>
                              <?php }else{ ?>  
                                <option value="<?php echo $dataCurse['row'][$x][1]; ?>"><?php echo $dataCurse['row'][$x][2]." / ".$dataCurse['row'][$x][7]; ?></option>
                              <?php } } ?>
                            </optgroup>
                          </select>
                          <button type="button" id="lsCurso_1button" class="btn btn-info">Listar</button>
                        </form>
                      </th>
                    </tr>
                    <tr>
                      <th scope="col">Titulos</th>
                      <th scope="col">Notas</th>
                      <th scope="col">Cursos</th>
                      <th scope="col">fecha propuesta</th>
                      <th scope="col">fecha revición</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sumaTare=0;
                    if($testCurse['row']!=0){
                      for($x=0 ; $x < count($testCurse['row']); $x++){
                        if($testCurse['row'][$x][5]=="tarea"){
                        $testGrade = $student->testGrade($testCurse['row'][$x][1]);
                        if($testGrade['grade'][0]){
                          $testGrade['row'][100]=$testGrade['grade'][1];
                          $testGrade['row'][102]=$testGrade['grade'][3];
                        }else{
                          $testGrade['row'][100]=0;
                          $testGrade['row'][102]="fecha revición a 5 dias maximo";
                        }
                        $sumaTare=$sumaTare+$testGrade['row'][100];
                    ?>
                      <tr>
                        <th scope="row"><?php echo $testCurse['row'][$x][3];?></th>
                        <td class="text-end"><?php echo $testGrade['row'][100];?></td>
                        <td><?php echo $testCurse['row'][$x][7];?></td>
                        <td class="text-end"><?php echo $testCurse['row'][$x][2];?></td>
                        <td class="text-end"><?php echo $testGrade['row'][102];?></td>
                      </tr>
                      <?php  } } }else{?>
                        <th scope="row" colspan="5" class="text-primary fs-2">No hay Evaluaciones</th>
                      <?php } ?>
                      <tr>
                        <td class="text-end">Total de notas:</td>
                        <td class="text-end">
                          <?php
                            echo $sumaTare;
                          ?>
                        </td>
                        <td class="text-end">Total de tareas:</td>
                        <td class="text-end">
                          <?php 
                            $countT = $student->countTest('tarea');
                            if($countT['count'][0]){
                              echo $countT['count'][1];
                            }else{
                              echo "No hay Tareas";
                            }
                            ?>
                        </td>
                        <td></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Detalles de Tareas -->
          <h1>Detalles de las tareas:</h1>
          <hr class="border-light opacity-75">
          <?php 
          if($testCurse['row']!=0){
            $residuoTare = 0;
          for($i=0; $i < count($testCurse['row']); $i++){ 
            if($testCurse['row'][$i][5]=="tarea"){
              $residuoTare = $i % 2;
              $classResTare = $residuoTare > 0 ? "border-success" : "border-primary";
          ?>
            <div class="card <?php echo $classResTare; ?> mb-3">
              <div class="card-header text-primary"><?php echo $testCurse['row'][$i][7]." / ".$testCurse['row'][$i][6];?></div>
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-12 col-md-6">
                    <h3 class="card-title"><?php echo $testCurse['row'][$i][3];?></h3>
                    <p class="card-text fs-4"><?php echo $testCurse['row'][$i][4];?></p>
                    <p class="card-text">fecha propusta: <?php echo $testCurse['row'][$i][2];?></p>
                  </div>
                  <div class="col-12 col-md-6">
                    <?php $testGrade = $student->testGrade($testCurse['row'][$i][1]);
                      if($testGrade['grade'][0]){
                        $testGrade['row'][100]=$testGrade['grade'][1];
                        $testGrade['row'][102]=$testGrade['grade'][3];
                        $testGrade['row'][103]=$testGrade['grade'][2];
                      }else{
                        $testGrade['row'][100]= 0;
                        $testGrade['row'][102]= date('Y-m-d');
                        $testGrade['row'][103]= "nota o la revición se mencionara aproximadamente en 5 dias maximo.";
                      }
                    ?>
                    <h3 class="card-text text-center text-info"><?php echo $testGrade['row'][100]; ?></h3>
                    <p class="card-text text-center fst-italic">Revision: <?php echo $testGrade['row'][102]; ?></p>
                    <p class="card-text fst-italic fs-5"><?php echo $testGrade['row'][103]; ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php  } } }else{?>
            <h1 class="text-primary">No hay Evaluaciones</h1>
          <?php } ?>
          <!-- total de tareas -->
          <div class="card border-info mb-3">
            <div class="card-body">
              <h2>
              <?php 
                $countTar = $student->countTest('tarea');
                if($countTar['count'][0]){
                  echo "Total de practicas: ".$countTar['count'][1];
                }else{
                  echo "No hay Tareas";
                }
              ?>
              </h2>
            </div>
          </div>
        </article>
        <!-- Prácticas -->
        <article id="practicas" class="container">
          <h1>Prácticas:</h1>
          <p class="fs-4">Cursos que puedes ejercer con mi persona &#128202;</p>
          <hr class="border-light opacity-75">
          <!-- ALUMNOS -->
          <div name="table_practicas" class="card mb-3">
            <div class="card-header">
              <h2>Todas las Prácticas:</h2>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-dark table-hover">
                  <thead>
                    <tr>
                      <th scope="col" colspan="5">
                        <form name="listar_tareas" class="input-group" method="POST">
                          <span class="input-group-text">Cursos:</span>
                          <select id="listar_Cursos1" class="form-select" title="Cursos que ejerces" aria-label="Cursos que ejerces">
                            <option>Todos</option>
                            <optgroup label="Cursos">
                              <?php for($x=0 ; $x<count($dataCurse); $x++){ if($x==0){ ?>
                                <option value="<?php echo $dataCurse['row'][$x][1]; ?>" ><?php echo $dataCurse['row'][$x][2]." / ".$dataCurse['row'][$x][7]; ?></option>
                              <?php }else{ ?>  
                                <option value="<?php echo $dataCurse['row'][$x][1]; ?>"><?php echo $dataCurse['row'][$x][2]." / ".$dataCurse['row'][$x][7]; ?></option>
                              <?php } } ?>
                            </optgroup>
                          </select>
                          <button type="button" id="lsCurso_1button" class="btn btn-info">Listar</button>
                        </form>
                      </th>
                    </tr>
                    <tr>
                      <th scope="col">Titulos</th>
                      <th scope="col">Notas</th>
                      <th scope="col">Cursos</th>
                      <th scope="col">fecha propuesta</th>
                      <th scope="col">fecha revición</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sumaPract=0;
                    if($testCurse['row'] != 0){
                      for($x=0 ; $x < count($testCurse['row']); $x++){
                        if($testCurse['row'][$x][5] == "practica presencial" || $testCurse['row'][$x][5] == "practica virtual"){
                          $testGrade = $student->testGrade($testCurse['row'][$x][1]);
                          if($testGrade['grade'][0]){
                            $testGrade['row'][100]=$testGrade['grade'][1];
                            $testGrade['row'][102]=$testGrade['grade'][3];
                          }else{
                            $testGrade['row'][100]=0;
                            $testGrade['row'][102]="fecha revición a 5 dias maximo";
                          }
                        $sumaPract=$sumaPract+$testGrade['row'][100];
                    ?>
                      <tr>
                        <th scope="row"><?php echo $testCurse['row'][$x][3];?></th>
                        <td class="text-end"><?php echo $testGrade['row'][100];?></td>
                        <td><?php echo $testCurse['row'][$x][7];?></td>
                        <td class="text-end"><?php echo $testCurse['row'][$x][2];?></td>
                        <td class="text-end"><?php echo $testGrade['row'][102];?></td>
                      </tr>
                      <?php } } }else{ ?>
                        <th scope="row" colspan="4" class="text-primary fs-2">No hay Evaluaciones</th>
                      <?php } ?>
                      <!-- todas las practicas -->
                      <tr>
                        <td class="text-end">Total de notas:</td>
                        <td class="text-end">
                          <?php
                            echo $sumaPract;
                          ?>
                        </td>
                        <td class="text-end">Total de practicas:</td>
                        <td class="text-end">
                          <?php 
                            $countPracP = $student->countTest('practica presencial');
                            $countPracV = $student->countTest('practica virtual');
                            if($countPracP['count'][0] || $countPracV['count'][0]){
                              $countPrac=$countPracP['count'][1]+$countPracV['count'][1];
                              echo $countPrac;
                            }else{
                              echo "No hay practicas";
                            }
                          ?>
                        </td>
                        <td></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Detalles de Prácticas -->
          <h1>Detalles de las Prácticas:</h1>
          <hr class="border-light opacity-75">
          <?php 
          if($testCurse['row']!=0){
            $residuoPract=0;
            for($i=0; $i < count($testCurse['row']); $i++){
              if($testCurse['row'][$i][5] == "practica presencial" || $testCurse['row'][$i][5] == "practica virtual"){
                $residuoPract = $i % 2;
                $classResPrac=$residuoPract > 0 ? "border-success" : "border-primary";
          ?>
            <div class="card <?php echo $classResPrac; ?> mb-3">
              <div class="card-header text-primary"><?php echo $testCurse['row'][$i][7]." / ".$testCurse['row'][$i][6];?></div>
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-12 col-md-6">
                    <h3 class="card-title"><?php echo $testCurse['row'][$i][3];?></h3>
                    <p class="card-text fs-4"><?php echo $testCurse['row'][$i][4];?></p>
                    <p class="card-text">fecha propusta: <?php echo $testCurse['row'][$i][2];?></p>
                  </div>
                  <div class="col-12 col-md-6">
                    <?php $testGrade = $student->testGrade($testCurse['row'][$i][1]);
                      if($testGrade['grade'][0]){
                        $testGrade['row'][100]=$testGrade['grade'][1];
                        $testGrade['row'][102]=$testGrade['grade'][3];
                        $testGrade['row'][103]=$testGrade['grade'][2];
                      }else{
                        $testGrade['row'][100]= 0;
                        $testGrade['row'][102]= date('Y-m-d');
                        $testGrade['row'][103]= "nota o la revición se mencionara aproximadamente en 5 dias maximo.";
                      }
                    ?>
                    <h3 class="card-text text-center text-info"><?php echo $testGrade['row'][100]; ?></h3>
                    <p class="card-text text-center fst-italic">Revision: <?php echo $testGrade['row'][102]; ?></p>
                    <p class="card-text fst-italic fs-5"><?php echo $testGrade['row'][103]; ?></p>
                  </div>
                </div>
              </div>
            </div>          
          <?php } } }else{?>
            <h1 class="text-primary">No hay Evaluaciones</h1>
          <?php } ?>
          <!-- todas las practicas -->
          <div class="card border-info mb-3">
            <div class="card-body">
              <h2>
              <?php 
                $countPracP = $student->countTest('practica presencial');
                $countPracV = $student->countTest('practica virtual');
                if($countPracP['count'][0] || $countPracV['count'][0]){
                  $countPrac=$countPracP['count'][1]+$countPracV['count'][1];
                  echo "Total de practicas: ".$countPrac;
                }else{
                  echo "No hay practicas";
                }
              ?>
              </h2>
            </div>
          </div>          
        </article>
        <!-- Puntos -->
        <article id="puntos" class="container">
          <h1>Puntos:</h1>
          <p class="fs-4">Cursos que puedes ejercer con mi persona &#129306;</p>
          <hr class="border-light opacity-75">
          <!-- ALUMNOS -->
          <div name="table_puntos"class="card mb-3">
            <div class="card-header">
              <h2>Todas los puntos:</h2>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-dark table-hover">
                  <thead>
                    <tr>
                      <th scope="col" colspan="5">
                        <form name="listar_tareas" class="input-group" method="POST">
                          <span class="input-group-text">Cursos:</span>
                          <select id="listar_Cursos1" class="form-select" title="Cursos que ejerces" aria-label="Cursos que ejerces">
                            <option>Todos</option>
                            <optgroup label="Cursos">
                              <?php for($x=0 ; $x<count($dataCurse); $x++){ if($x==0){ ?>
                                <option value="<?php echo $dataCurse['row'][$x][1]; ?>" ><?php echo $dataCurse['row'][$x][2]." / ".$dataCurse['row'][$x][7]; ?></option>
                              <?php }else{ ?>  
                                <option value="<?php echo $dataCurse['row'][$x][1]; ?>"><?php echo $dataCurse['row'][$x][2]." / ".$dataCurse['row'][$x][7]; ?></option>
                              <?php } } ?>
                            </optgroup>
                          </select>
                          <button type="button" id="lsCurso_1button" class="btn btn-info">Listar</button>
                        </form>
                      </th>
                    </tr>
                    <tr>
                      <th scope="col">Titulos</th>
                      <th scope="col">Notas</th>
                      <th scope="col">Cursos</th>
                      <th scope="col">fecha propuesta</th>
                      <th scope="col">fecha revición</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sumaPunt=0;
                    if($testCurse['row'] != 0){
                      for($x=0 ; $x < count($testCurse['row']); $x++){
                        if($testCurse['row'][$x][5] == "puntos" || $testCurse['row'][$x][5] == "clase presencial" || $testCurse['row'][$x][5] == "clase virtual"){
                          $testGrade = $student->testGrade($testCurse['row'][$x][1]);
                          if($testGrade['grade'][0]){
                            $testGrade['row'][100]=$testGrade['grade'][1];
                            $testGrade['row'][102]=$testGrade['grade'][3];
                          }else{
                            $testGrade['row'][100]=0;
                            $testGrade['row'][102]="fecha revición a 5 dias maximo";
                          }
                          $sumaPunt=$sumaPunt+$testGrade['row'][100];
                    ?>
                      <tr>
                        <th scope="row"><?php echo $testCurse['row'][$x][3];?></th>
                        <td class="text-end"><?php echo $testGrade['row'][100];?></td>
                        <td><?php echo $testCurse['row'][$x][7];?></td>
                        <td class="text-end"><?php echo $testCurse['row'][$x][2];?></td>
                        <td class="text-end"><?php echo $testGrade['row'][102];?></td>
                      </tr>
                      <?php } } }else{ ?>
                        <th scope="row" colspan="4" class="text-primary fs-2">No hay Evaluaciones</th>
                      <?php } ?>
                      <!-- todas los puntos -->
                      <tr>
                        <td class="text-end">Todal de notas:</td>
                        <td class="text-end">
                          <?php echo $sumaPunt; ?>
                        </td>
                        <td class="text-end">Todal de puntos:</td>
                        <td class="text-end">
                          <?php 
                            $countclasPu = $student->countTest('puntos');
                            $countclasPre = $student->countTest('clase presencial');
                            $countclasV = $student->countTest('clase virtual');
                            if($countclasPu['count'][0] || $countclasPre['count'][0] || $countclasV['count'][0]){
                              $countPuntos=$countclasPu['count'][1]+$countclasPre['count'][1]+$countclasV['count'][1];
                              echo $countPuntos;
                            }else{
                              echo "No hay Puntos";
                            }
                          ?>
                        </td>
                        <td></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Detalles de Puntos -->
          <h1>Detalles de los puntos:</h1>
          <hr class="border-light opacity-75">
          <?php 
          if($testCurse['row']!=0){
            $residuoPunt=0;
            for($i=0; $i < count($testCurse['row']); $i++){
              if($testCurse['row'][$i][5] == "puntos" || $testCurse['row'][$i][5] == "clase presencial" || $testCurse['row'][$i][5] == "clase virtual"){
                $residuoPunt = $i % 2;
                $classResPunt=$residuoPunt > 0 ? "border-success" : "border-primary";
          ?>
            <div class="card <?php echo $classResPunt; ?> mb-3">
              <div class="card-header text-primary"><?php echo $testCurse['row'][$i][7]." / ".$testCurse['row'][$i][6];?></div>
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-12 col-md-6">
                    <h3 class="card-title"><?php echo $testCurse['row'][$i][3];?></h3>
                    <p class="card-text fs-4"><?php echo $testCurse['row'][$i][4];?></p>
                    <p class="card-text">fecha propusta: <?php echo $testCurse['row'][$i][2];?></p>
                  </div>
                  <div class="col-12 col-md-6">
                    <?php $testGrade = $student->testGrade($testCurse['row'][$i][1]);
                      if($testGrade['grade'][0]){
                        $testGrade['row'][100]=$testGrade['grade'][1];
                        $testGrade['row'][102]=$testGrade['grade'][3];
                        $testGrade['row'][103]=$testGrade['grade'][2];
                      }else{
                        $testGrade['row'][100]= 0;
                        $testGrade['row'][102]= date('Y-m-d');
                        $testGrade['row'][103]= "nota o la revición se mencionara aproximadamente en 5 dias maximo.";
                      }
                    ?>
                    <h3 class="card-text text-center text-info"><?php echo $testGrade['row'][100]; ?></h3>
                    <p class="card-text text-center fst-italic">Revision: <?php echo $testGrade['row'][102]; ?></p>
                    <p class="card-text fst-italic fs-5"><?php echo $testGrade['row'][103]; ?></p>
                  </div>
                </div>
              </div>
            </div>          
          <?php } } }else{?>
            <h1 class="text-primary">No hay Evaluaciones</h1>
          <?php } ?>
          <!-- todas los puntos -->
          <div class="card border-info mb-3">
            <div class="card-body">
              <h2>
              <?php 
                $countclasPu = $student->countTest('puntos');
                $countclasPre = $student->countTest('clase presencial');
                $countclasV = $student->countTest('clase virtual');
                if($countclasPu['count'][0] || $countclasPre['count'][0] || $countclasV['count'][0]){
                  $countPuntos=$countclasPu['count'][1]+$countclasPre['count'][1]+$countclasV['count'][1];
                  echo "Total de puntos: ".$countPuntos;
                }else{
                  echo "No hay Puntos";
                }
              ?>
              </h2>
            </div>
          </div>
        </article>
        <!-- Promedio -->
        <article id="promedio" class="container">
          <h1>Promedio:</h1>
          <p class="fs-4">Todos los examenes que has desarrollado en los cursos &#128220;</p>
          <hr class="border-light opacity-75">
          <!-- ALUMNOS -->
          <div name="table_promedio" class="card mb-3">
            <div class="card-header">
              <h2>Todos los examenes:</h2>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-dark table-hover">
                  <thead>
                    <tr>
                      <th scope="col" colspan="5">
                        <form name="listar_tareas" class="input-group" method="POST">
                          <span class="input-group-text">Cursos:</span>
                          <select id="listar_Cursos1" class="form-select" title="Cursos que ejerces" aria-label="Cursos que ejerces">
                            <option>Todos</option>
                            <optgroup label="Cursos">
                              <?php for($x=0 ; $x<count($dataCurse); $x++){ if($x==0){ ?>
                                <option value="<?php echo $dataCurse['row'][$x][1]; ?>" ><?php echo $dataCurse['row'][$x][2]." / ".$dataCurse['row'][$x][7]; ?></option>
                              <?php }else{ ?>  
                                <option value="<?php echo $dataCurse['row'][$x][1]; ?>"><?php echo $dataCurse['row'][$x][2]." / ".$dataCurse['row'][$x][7]; ?></option>
                              <?php } } ?>
                            </optgroup>
                          </select>
                          <button type="button" id="lsCurso_1button" class="btn btn-info">Listar</button>
                        </form>
                      </th>
                    </tr>
                    <tr>
                      <th scope="col">Titulos</th>
                      <th scope="col">Notas</th>
                      <th scope="col">Cursos</th>
                      <th scope="col">fecha propuesta</th>
                      <th scope="col">fecha revición</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sumaExamen=0;
                    if($testCurse['row'] != 0){
                      for($x=0 ; $x < count($testCurse['row']); $x++){
                        if($testCurse['row'][$x][5] == "examen presencial" || $testCurse['row'][$x][5] == "examen virtual"){
                          $testGrade = $student->testGrade($testCurse['row'][$x][1]);
                          if($testGrade['grade'][0]){
                            $testGrade['row'][100]=$testGrade['grade'][1];
                            $testGrade['row'][102]=$testGrade['grade'][3];
                          }else{
                            $testGrade['row'][100]=0;
                            $testGrade['row'][102]="fecha revición a 5 dias maximo";
                          }
                          $sumaExamen=$sumaExamen+$testGrade['row'][100];
                    ?>
                      <tr>
                        <th scope="row"><?php echo $testCurse['row'][$x][3];?></th>
                        <td class="text-end"><?php echo $testGrade['row'][100];?></td>
                        <td><?php echo $testCurse['row'][$x][7];?></td>
                        <td class="text-end"><?php echo $testCurse['row'][$x][2];?></td>
                        <td class="text-end"><?php echo $testGrade['row'][102];?></td>
                      </tr>
                      <?php } } }else{ ?>
                        <th scope="row" colspan="4" class="text-primary fs-2">No hay Evaluaciones</th>
                      <?php } ?>
                      <!-- todos los examenes -->
                      <tr>
                        <td class="text-end">Total de notas:</td>
                        <td class="text-end"><?php echo $sumaExamen;?></td>
                        <td class="text-end">Total de examenes:</td>
                        <td class="text-end">
                          <?php 
                            $countExaP = $student->countTest('examen presencial');
                            $countExaV = $student->countTest('examen virtual');
                            if($countExaP['count'][0] || $countExaV['count'][0]){
                              $countExam=$countExaP['count'][1]+$countExaV['count'][1];
                              echo $countExam;
                            }else{
                              echo "No hay examenes";
                            }
                          ?>
                        </td>
                        <td></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Detalles de examenes -->
          <h1>Detalles de los examenes:</h1>
          <hr class="border-light opacity-75">
          <?php 
          if($testCurse['row']!=0){
            $residuoExam=0;
            for($i=0; $i < count($testCurse['row']); $i++){
              if($testCurse['row'][$i][5] == "examen presencial" || $testCurse['row'][$i][5] == "examen virtual"){
                $residuoExam = $i % 2;
                $classRes= $residuoExam > 0 ? "border-success" : "border-primary";
          ?>
            <div class="card <?php echo $classRes; ?> mb-3">
              <div class="card-header text-primary"><?php echo $testCurse['row'][$i][7]." / ".$testCurse['row'][$i][6];?></div>
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-12 col-md-6">
                    <h3 class="card-title"><?php echo $testCurse['row'][$i][3];?></h3>
                    <p class="card-text fs-4"><?php echo $testCurse['row'][$i][4];?></p>
                    <p class="card-text">fecha propusta: <?php echo $testCurse['row'][$i][2];?></p>
                  </div>
                  <div class="col-12 col-md-6">
                    <?php $testGrade = $student->testGrade($testCurse['row'][$i][1]);
                      if($testGrade['grade'][0]){
                        $testGrade['row'][100]=$testGrade['grade'][1];
                        $testGrade['row'][102]=$testGrade['grade'][3];
                        $testGrade['row'][103]=$testGrade['grade'][2];
                      }else{
                        $testGrade['row'][100]= 0;
                        $testGrade['row'][102]= date('Y-m-d');
                        $testGrade['row'][103]= "nota o la revición se mencionara aproximadamente en 5 dias maximo.";
                      }
                    ?>
                    <h3 class="card-text text-center text-info"><?php echo $testGrade['row'][100]; ?></h3>
                    <p class="card-text text-center fst-italic">Revision: <?php echo $testGrade['row'][102]; ?></p>
                    <p class="card-text fst-italic fs-5"><?php echo $testGrade['row'][103]; ?></p>
                  </div>
                </div>
              </div>
            </div>          
          <?php } } }else{?>
            <h1 class="text-primary">No hay Evaluaciones</h1>
          <?php } ?>
          <!-- todas las practicas -->
          <div class="card border-info mb-3">
            <div class="card-body">
              <h2>
              <?php 
                $countExaP = $student->countTest('examen presencial');
                $countExaV = $student->countTest('examen virtual');
                if($countExaP['count'][0] || $countExaV['count'][0]){
                  $countExam=$countExaP['count'][1]+$countExaV['count'][1];
                  echo "Total de examenes: ".$countExam;
                }else{
                  echo "No hay examenes";
                }
              ?>
              </h2>
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
