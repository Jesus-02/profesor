<?php
setlocale(LC_ALL, "es_PE");
session_start();
if (!isset($_SESSION['user'])) {
  header('location:../index.php');
}
/* Datos personales */
include_once "../system_data/dataView.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bonnelee | Profesor</title>
    <link rel="shortcut icon" href="../imagens/mister.png" type="image/x-icon">
    <link href="../styles/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="../styles/generals.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
    <!-- MODALS -->    
    <!-- Modal Red social -->
    <div class="modal fade" id="modalSocial" tabindex="-1" aria-labelledby="datos del profesor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Red social:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row visually-hidden">
                        <label for="social_Function" class="col-sm-2 col-form-label">Function</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="social_Function" value="" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Nombre:</span>
                            <input type="text" id="social_Name" placeholder="Red social" aria-label="Red social" class="form-control" required>
                            <div class="invalid-feedback">Nombre invalido - Es
                                nesesario escribir el nombre de la red social sin números ni links.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Correo:</span>
                            <input type="text" id="social_Correo" placeholder="@exemplo / ejemplo@gmail.com" class="form-control" aria-label="Red social" required>
                            <div class="invalid-feedback">Correo invalido - Es
                                nesesario escribir tu correo.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Link:</span>
                            <input type="text" id="social_Link" placeholder="https://www.example.com" aria-label="Link social" class="form-control" required>
                            <div class="invalid-feedback">Link invalido - Es
                                nesesario escribir un link seguro.</div>
                        </div>
                    </div>
                    <div class="mb-3 row visually-hidden">
                        <label for="social_edit" class="col-sm-2 col-form-label">Codigo</label>
                        <div class="col-sm-10">
                            <input type="number" readonly class="form-control-plaintext" id="social_edit" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" name="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Cursos realizados -->
    <div class="modal fade" id="modalCursos" tabindex="-1" aria-labelledby="datos del profesor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Curso realizado:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row visually-hidden">
                        <label for="cursos_Function" class="col-sm-2 col-form-label">Function</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="cursos_Function" value="" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Curso:</span>
                            <input type="text" id="cursos_name" placeholder="nombre" aria-label="Curso" class="form-control" required>
                            <div class="invalid-feedback">Curso invalido - Es
                                nesesario escribir el nombre del curso sin números, ni links y tampoco simbolos.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Descripción:</span>
                            <textarea class="form-control" id="cursos_descripcion" placeholder="Es una API o LENGUAJE" aria-label="descripcion" required style="max-height: 150px;"></textarea>
                            <div class="invalid-feedback">Descripción invalido
                                - Es nesesario escribir la descripción del curso sin números ni links.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Nivel de porcentaje:</span>
                            <input type="number" id="cursos_nPorcentaje" placeholder="Maximo 100" min="1" max="100" class="form-control" aria-label="porcentaje" required>
                            <div class="invalid-feedback">Nivel de porcentaje
                                invalido - Es nesesario escribir la descripción del curso sin números ni links.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Lugar:</span>
                            <input type="text" id="cursos_lugar" placeholder="AV. ejemplo #000" class="form-control" aria-label="lugar" required>
                            <div class="invalid-feedback">Lugar invalido - Es
                                nesesario escribir el lugar del curso sin links.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Inicio:</span>
                            <input type="date" id="cursos_inicio" class="form-control" aria-label="Fecha inicio" required>
                            <div class="invalid-feedback">Fecha invalida - Es
                                nesesario escribir la fecha de inicio del curso sin links.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Teminó:</span>
                            <input type="date" id="cursos_termino" class="form-control" aria-label="Fecha terminó" required>
                            <div class="invalid-feedback">Fecha invalida - Es
                                nesesario escribir la fecha final del curso sin links.</div>
                        </div>
                    </div>
                    <div class="mb-3 row visually-hidden">
                        <label for="social_edit" class="col-sm-2 col-form-label">Codigo</label>
                        <div class="col-sm-10">
                            <input type="number" readonly class="form-control-plaintext" id="cursos_edit" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" name="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Datos laborales -->
    <div class="modal fade" id="modalLaboral" tabindex="-1" aria-labelledby="datos del profesor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Experiencia laboral:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row visually-hidden">
                        <label for="laboral_Function" class="col-sm-2 col-form-label">Function</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="laboral_Function" value="" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Experiencia:</span>
                            <input type="text" id="laboral_cargo" placeholder="Cargo - Empresa" aria-label="experiencia" class="form-control" required>
                            <div class="invalid-feedback">Experiencia invalido
                                - Es nesesario escribir el nombre del cargo sin simbolos ni links.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Lugar:</span>
                            <input type="text" id="laboral_lugar" placeholder="AV. ejemplo #000, Distrito o Departamento" class="form-control" aria-label="lugar" required>
                            <div class="invalid-feedback">Lugar invalido - Es
                                nesesario escribir el lugar sin links.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Inicio:</span>
                            <input type="date" id="laboral_inicio" class="form-control" aria-label="Fecha inicio" required>
                            <div class="invalid-feedback">Fecha invalida - Es
                                nesesario escribir la fecha de inicio sin links.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group is-validation">
                            <span class="input-group-text">Teminó:</span>
                            <input type="date" id="laboral_termino" class="form-control" aria-label="Fecha terminó" required>
                            <div class="invalid-feedback">Fecha invalida - Es
                                nesesario escribir la fecha final sin links.</div>
                        </div>
                    </div>
                    <div class="mb-3 row visually-hidden">
                        <label for="social_edit" class="col-sm-2 col-form-label">Codigo</label>
                        <div class="col-sm-10">
                            <input type="number" readonly class="form-control-plaintext" id="laboral_edit" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" name="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal password -->
    <div class="modal fade" id="modalPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Administrar contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
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
                    <img src="../imagens/IMG_20160605_151301~2.jpg" width="40%" class="img-fluid border border-dark border-3 rounded-circle mx-auto d-block" alt="Cargando imagen" title="Jesús Zubilete">
                    <h3><?php echo $variante[1] . " " . $variante[2] . " " . $variante[3]; ?></h3>
                </div>
                <!-- menu admin -->
                <div class="list-group">
                    <a href="#curriculum_vitae" class="list-group-item list-group-item-action active" aria-current="true">
                        <i class="bi bi-person-check">&nbsp;</i> Curriculum vitae
                    </a>
                    <a href="#permisos" class="list-group-item list-group-item-action"><i class="bi bi-toggles">&nbsp;</i> Activar permisos</a>
                    <a href="#cursosActivos" class="list-group-item list-group-item-action"><i class="bi bi-clipboard-pulse">&nbsp;</i> Cursos disponibles</a>
                    <a href="#eliminar_alumnos" class="list-group-item list-group-item-action"><i class="bi bi-clipboard2-minus">&nbsp;</i> Eliminaciones</a>
                    <a href="#" id="mn-registrar" title="Registrar" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <b><i class="bi bi-clipboard-plus">&nbsp;</i> Registrar</b>
                        <span class="badge"><i class="bi bi-caret-down-fill"></i> <i class="bi bi-caret-up-fill"></i></span>
                    </a>
                    <div name="mn_registrar_list" class="list-goup-flush">
                        <a href="#alumnos" class="list-group-item list-group-item-action list-group-item-primary" title="Alumnos"><i class="bi bi-person-plus">&nbsp;</i> Alumnos</a>
                        <a href="#cursos" class="list-group-item list-group-item-action list-group-item-primary" title="Cursos"><i class="bi bi-journal-plus">&nbsp;</i> Cursos</a>
                        <a href="#activar-curso" class="list-group-item list-group-item-action list-group-item-primary" title="Activar nuevo curso"><i class="bi bi-journal-plus">&nbsp;</i> Activar curso</a>
                        <a href="#institutos" class="list-group-item list-group-item-action list-group-item-primary" title="Institutos"><i class="bi bi-building">&nbsp;</i> Institutos</a>
                        <a href="#evaluaciones" class="list-group-item list-group-item-action list-group-item-primary" title="Evaluaciones"><i class="bi bi-book">&nbsp;</i> Evaluaciones</a>
                        <a href="#notas" class="list-group-item list-group-item-action list-group-item-primary" title="Notas"><i class="bi bi-book">&nbsp;</i> Notas</a>
                    </div>
                    <a href="#" id="mn-configuracion" title="Configuracion" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <b><i class="bi bi-cone-striped">&nbsp;</i> Configuracion</b>
                        <span class="badge" name="b1"><i class="bi bi-caret-down-fill"></i> <i class="bi bi-caret-up-fill"></i></span>
                    </a>
                    <div name="mn_configuracion_list" class="list-goup-flush">
                        <a href="#colores_portadas" class="list-group-item list-group-item-action list-group-item-primary" title="#Colores de portadas"><i class="bi bi-brush">&nbsp;</i> Colores de portadas</a>
                        <a href="#edicion_letras" class="list-group-item list-group-item-action list-group-item-primary" title="Edicion de letras"><i class="bi bi-body-text">&nbsp;</i> Edición de letras</a>
                        <a href="#imagenes_portadas" class="list-group-item list-group-item-action list-group-item-primary" title="Imagenes portadas"><i class="bi bi-bookmark-plus">&nbsp;</i> Imagenes de portadas</a>
                    </div>
                    <a href="#close" class="list-group-item list-group-item-action bg-warning">Cerrar sesion</a>
                </div>
            </aside>
            <!-- articulos -->
            <section class="col-12 col-md-10">
                <!-- curriculum_vitae -->
                <article id="curriculum_vitae" class="container">
                    <h1 class="border-3">Editar:</h1>
                    <p class="fs-4">Editar informacion personal.</p>
                    <hr class="border-light opacity-75">
                    <!-- Datos personales -->
                    <form id="datos_personales" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Datos personales:</h2>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Nombres:</span>
                                <input type="text" name="editar_dp_name1" id="editar_dp_name1" placeholder="Primer nombre" value="<?php echo $variante[1]; ?>" class="form-control" disabled>
                                <div class="invalid-feedback">Nombres invalidos -
                                    Es nesesario escribir tu primer nombre mínimo sin números ni links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Apellidos:</span>
                                <input type="text" name="editar_dp_surName1" id="editar_dp_surName1" placeholder="Apellido paterno" value="<?php echo $variante[2]; ?>" aria-label="Last name" class="form-control" disabled>
                                <input type="text" name="editar_dp_surName2" id="editar_dp_surName2" placeholder="Apellido materno" value="<?php echo $variante[3]; ?>" aria-label="Last name" class="form-control" disabled>
                                <div class="invalid-feedback">Apellidos invalidos
                                    - Es nesesario escribir tus apellidos sin números ni links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Teléfono:</span>
                                <input type="number" name="editar_dp_phone1" id="editar_dp_phone1" placeholder="12345678" value="<?php echo $variante[4]; ?>" min="100000000" max="99999999" aria-label="phone" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Celular:</span>
                                <input type="number" name="editar_dp_cellphone1" id="editar_dp_cellphone1" placeholder="123456789" value="<?php echo $variante[5]; ?>" min="100000000" max="999999999" aria-label="cell phone" class="form-control" disabled>
                                <div class="invalid-feedback">Número invalido - Es
                                    nesesario escribir los 9 digitos de tu celular sin links.</div>
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
                    <!-- Redes sociales -->
                    <div name="redes" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Redes sociales:</h2>
                        <div class="mb-3">
                            <div class="table-responsive">
                                <table class="table text-dark fs-5">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col"># <span>
                                                    <?php
                                                    echo count($social);
                                                    ?>
                                                </span></th>
                                            <th scope="col">Red Social</th>
                                            <th scope="col">Cuenta</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-bottom" name="lista">
                                        <?php
                                        for ($x = 0; $x < count($social); $x++) {
                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php
                                                    echo $x + 1;
                                                    ?>
                                                </th>
                                                <td>
                                                    <?php
                                                    print_r($social[$x][0]);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    print_r($social[$x][1]);
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Opciones">
                                                        <button type="button" name="edit" class="btn btn-success" onclick="javaScript:editData(<?php echo $social[$x][3] ?>,'modalSocial')" data-bs-toggle="modal" data-bs-target="#modalSocial">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button type="button" name="delete" class="btn btn-danger" onclick="javaScript:deleteData(<?php echo $social[$x][3] ?>,'modalSocial')">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-grid gap-2" aria-label="opciones de tus redes sociales">
                            <button class="btn btn-info" type="button" onclick="javaScript: reset('modalSocial','socialNuevo')" data-bs-toggle="modal" data-bs-target="#modalSocial">Nuevo</button>
                        </div>
                    </div>
                    <!-- Cursos realizados -->
                    <div name="cursos" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Cursos realizados:</h2>
                        <p class="fs-5">Los cursos tienen fechas diferentes y las havilidades tienen las mismas fechas tanto como el inicio como la finalización.</p>
                        <div class="mb-3">
                            <div class="accordion text-muted" id="accordionExample">
                                <?php
                                for ($x = 0; $x < count($dcursos); $x++) {
                                ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?php echo $x; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $x; ?>" aria-expanded="false" aria-controls="collapse<?php echo $x; ?>">
                                                <?php echo $dcursos[$x][1]; ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo $x; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $x; ?>" data-bs-parent="#accordionExample">
                                            <div class="accordion-body py-2">
                                                <div class="container-lg">
                                                    <div class="row gx-5">
                                                        <div class="col-lg-8 align-self-center">
                                                            <h2>
                                                                <?php echo $dcursos[$x][1]; ?>
                                                            </h2>
                                                            <p>
                                                                <?php echo $dcursos[$x][2] . "."; ?>
                                                            </p>
                                                            <p>Lugar: <span><?php echo $dcursos[$x][4] . "."; ?></span></p>
                                                        </div>
                                                        <div class="col-lg-4 text-center">
                                                            <figure class="figure">
                                                                <div class="progress align-items-end" style="height: 200px;">
                                                                    <div class="progress-bar w-100" role="progressbar" aria-label="Example with label" style="height:<?php echo $dcursos[$x][3]; ?>%;"></div>
                                                                </div>
                                                                <figcaption class="figure-caption">
                                                                    <h4><?php echo $dcursos[$x][3]; ?>%</h4>
                                                                    <h4>Fecha: <span><?php echo $dcursos[$x][5]; ?></span></h4>
                                                                    <div class="btn-group" role="group" aria-label="Opciones">
                                                                        <button type="button" class="btn btn-success" onclick="javaScript:editData(<?php echo $dcursos[$x][7]; ?>, 'modalCursos')" data-bs-toggle="modal" data-bs-target="#modalCursos">
                                                                            <i class="bi bi-pencil-square"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger" onclick="javaScript:deleteData(<?php echo $dcursos[$x][7]; ?>, 'modalCursos')">
                                                                            <i class="bi bi-trash3"></i>
                                                                        </button>
                                                                    </div>
                                                                </figcaption>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="d-grid gap-2" aria-label="opciones de tus cursos">
                            <button class="btn btn-info" type="button" data-bs-toggle="modal" onclick="javaScript:reset('modalCursos','cursoNuevo')" data-bs-target="#modalCursos">Nuevo</button>
                        </div>
                    </div>
                    <!-- Datos laborales -->
                    <div name="laborales" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Datos laborales:</h2>
                        <div class="mb-3">
                            <div class="list-group">
                                <?php
                                for ($x = 0; $x < count($dlaboral); $x++) {
                                ?>
                                    <div class="list-group-item flex-column text-dark">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-2">
                                                <?php echo $dlaboral[$x][1] ?>
                                            </h5>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <p>
                                                <?php echo $dlaboral[$x][2] ?>
                                            </p>
                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" onclick="javaScript:editData(<?php echo $dlaboral[$x][5]; ?>, 'modalLaboral')" data-bs-target="#modalLaboral">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" onclick="javaScript:deleteData(<?php echo $dlaboral[$x][5]; ?>, 'modalLaboral')">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small>Inicio: <?php echo $dlaboral[$x][3] ?> / </small>
                                        <small>Fin: <span> <?php echo $dlaboral[$x][4] ?> </span></small>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="d-grid gap-2" aria-label="opciones de tus cursos">
                            <button class="btn btn-info" type="button" data-bs-toggle="modal" onclick="javaScript:reset('modalLaboral','laboralNuevo')" data-bs-target="#modalLaboral">Nuevo</button>
                        </div>
                    </div>
                </article>
                <!-- permisos -->
                <article id="permisos" class="container bg-secondary text-dark border border-warning rounded py-5">
                    <h1>Activaciones:</h1>
                    <p class="fs-4">Activar los permisos.</p>
                    <hr class="border-light opacity-75">
                    <form class="" action="index.html" method="post">
                        <h2 class="mb-3">Alumnos</h2>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Permitir que los alumnos se
                                puedan registar.</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-info" type="button">Permitir</button>
                        </div>
                    </form>
                </article>
                <!-- cursos Activos -->
                <article id="cursosActivos" class="container bg-secondary text-dark border border-warning rounded py-5">
                    <h1>Cursos disponibles:</h1>
                    <p class="fs-4">Ver los cursos que estoy dictando y los que ya han finalizado.</p>
                    <div class="recarga">
                        <hr class="border-light opacity-75">
                        <h3>Cursos activos:</h3>                    .
                        <div class="table-responsive">
                            <table class="table table-dark table-hover col-12">
                                <thead>
                                    <tr class="text-start fs-4">
                                        <th scope="col"><?php echo count($cursoV); ?> Cursos</th>
                                        <th scope="col">Institutos</th>
                                        <th scope="col">Trayecto</th>
                                        <th scope="col">Estados</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="text-start fs-5">
                                    <?php for ($i = 0; $i < count($cursoV); $i++) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $cursoV[$i][1] ?></th>
                                            <td><?php echo $cursoV[$i][8] ?></td>
                                            <td><?php echo $cursoV[$i][6] . " - " . $cursoV[$i][7] ?></td>
                                            <td class="text-center"><?php echo $cursoV[$i][5] ?></td>
                                            <td><button type="button" class="btn btn-primary" onclick="javaScript:activeCourse(<?php echo $cursoV[$i][10];?>, false)">Desactivar</button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <hr class="border-light opacity-75">
                        <h3>Cursos desactivos:</h3>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover col-12">
                                <thead class="table-dark">
                                    <tr class="text-start fs-4">
                                        <th scope="col"> <?php echo count($cursoF); ?> Cursos</th>
                                        <th scope="col">Institutos</th>
                                        <th scope="col">Trayecto</th>
                                        <th scope="col">Estados</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="text-start fs-5">
                                    <?php for ($i = 0; $i < count($cursoF); $i++) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $cursoF[$i][1] ?></th>
                                            <td><?php echo $cursoF[$i][5] ?></td>
                                            <td><?php echo $cursoF[$i][3] . " - " . $cursoF[$i][4] ?></td>
                                            <td class="text-center"><?php echo $cursoF[$i][2] ?></td>
                                            <td><button type="button" class="btn btn-success" onclick="javaScript:activeCourse(<?php echo $cursoF[$i][6];?>, true)">activar</button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                </article>
                <!-- eliminar_alumnos_cursos -->
                <article id="eliminar_alumnos" class="container bg-secondary text-dark border border-warning rounded py-5">
                    <h1>Eliminar cursos y alumnos:</h1>
                    <p class="fs-4">Eliminar grupos de alumnos que han finalizado el curso.</p>
                    <hr class="border-light opacity-75">
                    <h3>Cursos finalizados:</h3>
                    <div class="table-responsive">
                        <table class="table col-12 table-dark table-hover">
                            <thead class="table-dark">
                                <tr class="text-start fs-4">
                                    <th scope="col"><?php echo count($cursoFE); ?> Cursos</th>
                                    <th scope="col">Institutos</th>
                                    <th scope="col">Alumnos</th>
                                    <th scope="col">Finalizados</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-start fs-5">
                                <?php for ($i = 0; $i < count($cursoFE); $i++) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $cursoFE[$i][1] ?></th>
                                        <td><?php echo $cursoFE[$i][3] ?></td>
                                        <td><?php echo $cursoFE[$i][5] ?></td>
                                        <td><?php echo $cursoFE[$i][2] ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                <button type="button" name="empty" class="btn btn-primary" title="Desocupar alumnos">
                                                    <i class="bi bi-people"></i>
                                                </button>
                                                <button type="button" name="delete" class="btn btn-danger" title="Eliminar curso">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- ALUMNOS CURSADOS -->
                    <hr class="border-light opacity-75">
                    <h3>Eliminar alumnos:</h3>
                    <div class="accordion" id="cursosAlumnos">
                        <?php for ($i = 0; $i < count($cursoV); $i++) { ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="curso<?php echo $i; ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#alumnos<?php echo $i; ?>" aria-expanded="false" aria-controls="alumnos<?php echo $i; ?>">
                                        <?php echo $cursoV[$i][1] . " / " . $cursoV[$i][8] . " / " . $cursoV[$i][9]; ?>
                                    </button>
                                </h2>
                                <div id="alumnos<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="curso<?php echo $i; ?>" data-bs-parent="#cursosAlumnos">
                                    <div class="accordion-body table-responsive">
                                        <?php $alumnos = $cursos->bAlumnosxCurso($cursoV[$i][10]); ?>
                                        <table class="table table-striped">
                                            <thead class="table-dark">
                                                <tr class="text-start">
                                                    <th scope="col"># <?php echo count($alumnos); ?></th>
                                                    <th scope="col">Apellidos y nombres</th>
                                                    <th scope="col">Genero</th>
                                                    <th scope="col">Celular</th>
                                                    <th scope="col">Correo</th>
                                                    <th scope="col">Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-start">
                                                <?php for ($y = 0; $y < count($alumnos); $y++) { ?>
                                                    <tr>
                                                        <td><?php echo $y + 1; ?></td>
                                                        <th scope="row"><?php echo $alumnos[$y][3] . " " . $alumnos[$y][4]; ?></th>
                                                        <td><?php echo $alumnos[$y][1]; ?></td>
                                                        <td><?php echo $alumnos[$y][6]; ?></td>
                                                        <td><?php echo $alumnos[$y][5]; ?></td>
                                                        <td><button type="button" class="btn btn-danger"><i class="bi bi-trash3"></i></button></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </article>
                <!-- alumnos -->
                <article id="alumnos" class="container">
                    <h1>Alumnos:</h1>
                    <p class="fs-4">Registar nuevo alumno al curso.</p>
                    <hr class="border-light opacity-75">
                    <!-- Datos personales -->
                    <form id="datos_alumnos" name="datos_alumnos" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Datos personales:</h2>
                        <div class="mb-3 row visually-hidden">
                            <label for="evaluacion_code" class="col-sm-2 col-form-label">code</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext bg-success" id="alumno_code" value="" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">DNI:</span>
                                <input type="number" name="alumno_dp_dni" id="alumno_dp_dni" placeholder="N° 12345678" min="10000000" max="99999999" aria-label="cell phone" class="form-control" disabled required>
                                <div class="invalid-feedback">DNI invalido - Es
                                    nesesario escribir los 8 digitos de tu dni sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Nombres:</span>
                                <input type="text" name="alumno_dp_name1" id="alumno_dp_name1" placeholder="Primer nombre" aria-label="Primer nombre" class="form-control" disabled required>
                                <div class="invalid-feedback">Nombres invalidos -
                                    Es nesesario escribir tu primer nombre mínimo sin números ni links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Apellidos:</span>
                                <input type="text" name="alumno_dp_surName1" id="alumno_dp_surName1" placeholder="Apellido paterno" aria-label="Apellidos" class="form-control" disabled required>
                                <input type="text" name="alumno_dp_surName2" id="alumno_dp_surName2" placeholder="Apellido materno" aria-label="Apellidos" class="form-control" disabled required>
                                <div class="invalid-feedback">Apellidos invalidos
                                    - Es nesesario escribir tus apellidos sin números ni links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Genero:</span>
                                <select name="alumno_dp_genero1" id="alumno_dp_genero1" aria-label="Genero" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="O">Otros</option>
                                </select>
                                <div class="invalid-feedback">Genero invalido - Es
                                    nesesario seleccionar una opción sin links ni números.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Edad:</span>
                                <input type="number" name="alumno_dp_edad" id="alumno_dp_edad" placeholder="Edad" min="1" max="200" aria-label="Edad" class="form-control" disabled required>
                                <div class="invalid-feedback">Edad invalido - Es
                                    nesesario escribir tu edad sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Correo:</span>
                                <input type="email" name="alumno_dp_correo1" id="alumno_dp_correo1" placeholder="ejemplo@gmail.com" aria-label="Correo" class="form-control" disabled required>
                                <div class="invalid-feedback">Correo invalido - Es
                                    nesesario escribir tu correo sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Celular:</span>
                                <input type="number" name="alumno_dp_cellPhone1" id="alumno_dp_cellPhone1" placeholder="N° 123456789" min="1000000000" max="999999999" aria-label="cell phone" class="form-control" disabled required>
                                <div class="invalid-feedback">Número invalido - Es
                                    nesesario escribir los 9 digitos de tu celular sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Curso:</span>
                                <select name="alumno_dp_curso1" id="alumno_dp_curso1" aria-label="Curso" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Cursos actuales">
                                        <?php for ($i = 0; $i < count($cursoV); $i++) { ?>
                                            <option value="<?php echo $cursoV[$i][10]; ?>"><?php echo $cursoV[$i][1] . " - " . $cursoV[$i][8] . " - " . $cursoV[$i][9]; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">Curso invalidos - Es
                                    nesesario seleccionar una opción sin links ni números.</div>
                            </div>
                        </div>
                        <div name="opn-vertical" class="col-12 btn-group" role="group" aria-label="opciones">
                            <!-- en cada input o select agregar is-invalid para errores -->
                            <button type="button" class="btn btn-info visually-hidden" name="buscar">Buscar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="cancelar">Cancelar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="editar">Editar</button>
                            <button type="button" class="btn btn-info" name="editar1">Editar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="nuevo">Nuevo</button>
                            <button type="button" class="btn btn-info" name="nuevo1">Nuevo</button>
                            <button type="button" class="btn btn-info" name="listar">Listar</button>
                        </div>
                    </form>
                    <!-- ALUMNOS -->
                    <div name="table_alumnos" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Todos los alumnos:</h2>
                        <form method="POST" class="input-group bg-dark pt-3 px-3 rounded-top" name="form_buscar1">
                            <select class="form-select" id="table_alumnos-b1Opciones" name="buscar_alumnos1" aria-label="Default select example">
                                <option value="a1">DNI</option>
                                <option value="a2">NOMBRES, APELLIDO</option>
                                <option value="a4">CORREO</option>
                                <option value="a5">CELULAR</option>
                                <option value="a6" selected>CURSOS</option>
                            </select>
                            <input type="text" name="a1" placeholder="00000000" aria-label="DNI" class="form-control">
                            <input type="text" name="a2" placeholder="NOMBRES" aria-label="NOMBRES" class="form-control">
                            <input type="text" name="a3" placeholder="APELLIDO PATERNO" aria-label="APELLIDO" class="form-control">
                            <input type="text" name="a4" placeholder="ejemplo@gamil.com" aria-label="CORREO" class="form-control">
                            <input type="text" name="a5" placeholder="000000000" aria-label="CELULAR" class="form-control">
                            <select name="a6" aria-label="Curso" class="form-select">
                                <option value="0">todos</option>
                                <optgroup label="Cursos actuales">
                                    <?php for ($i = 0; $i < count($cursoLocal); $i++) { ?>
                                        <option value="<?php echo $cursoLocal[$i][9]; ?>">
                                            <?php echo $cursoLocal[$i][1] . " " . $cursoLocal[$i][8]; ?>
                                        </option>
                                    <?php } ?>
                                </optgroup>
                            </select>
                            <button class="btn btn-outline-secondary" type="button" onclick="JavaScript:searchUsers()">Buscar</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Cursos</th>
                                        <th scope="col">DNI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($alumnosD); $i++) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $alumnosD[$i][7]; ?></th>
                                            <td><?php echo $alumnosD[$i][2] . " " . $alumnosD[$i][3]; ?></td>
                                            <td><?php echo $alumnosD[$i][4]; ?></td>
                                            <td><?php echo $alumnosD[$i][5]; ?></td>
                                            <td><?php echo $alumnosD[$i][6]; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<?php echo $alumnosD[$i][1]; ?>">
                                                    <i class="bi bi-person-badge"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
                <!-- evaluaciones -->
                <article id="evaluaciones" class="container">
                    <h1>Evaluaciones:</h1>
                    <p class="fs-4">Aqui puedes registrar nuevas evaluaciones a los alumnos.</p>
                    <hr class="border-light opacity-75">
                    <!-- Registrar evaluacion pendiente -->
                    <form name="evaluaciones" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Registrar evaluación:</h2>
                        <div class="mb-3 row visually-hidden">
                            <label for="evaluacion_code" class="col-sm-2 col-form-label">code</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext bg-success" id="evaluacion_code" value="" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Cursos:</span>
                                <select id="evaluaciones_pd_curso1" aria-label="Cursos" title="Cursos" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Cursos Encontrados">
                                        <?php for ($i = 0; $i < count($cursoV); $i++) { ?>
                                            <option value="<?php echo $cursoV[$i][10]; ?>"><?php echo $cursoV[$i][1] . " - " . $cursoV[$i][8]; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">Curso invalido - Es
                                    nesesario seleccionar un curso sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Titulo:</span>
                                <input type="text" id="evaluaciones_pd_titulo1" placeholder="Titulo" aria-label="Titulo" class="form-control" disabled required>
                                <div class="invalid-feedback">Titulo invalido - Es
                                    nesesario escribir el titulo de la evaluación sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Descripcion:</span>
                                <textarea class="form-control" id="evaluaciones_pd_descripcion1" aria-label="Descripcion" disabled required style="max-height: 100px;"></textarea>
                                <div class="invalid-feedback">Descripcion invalido
                                    - Es nesesario escribir la descripcion sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Estado:</span>
                                <select id="evaluaciones_pd_estado" aria-label="Estado" class="form-select form-control" disabled required>
                                    <option selected>Ninguno</option>
                                    <option value="v">Pendiente</option>
                                    <option value="f">Completo</option>
                                </select>
                                <div class="invalid-feedback">Estado invalido - Es
                                    nesesario seleccionar un estado sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Rango:</span>
                                <select id="evaluaciones_pd_rango1" aria-label="Rango" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Cursos Encontrados">
                                        <?php for ($x = 0; $x < count($cursosRangos); $x++) { ?>
                                            <option value="<?php echo $cursosRangos[$x][1]; ?>"><?php echo $cursosRangos[$x][2]; ?></option>
                                        <?php  } ?>
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">Rango invalido - Es
                                    nesesario seleccionar un rango sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Fecha propuesta:</span>
                                <input type="date" id="alumno_dp_fecha" title="Fecha propuesta" aria-label="Fecha propuesta" class="form-control" disabled required>
                                <div class="invalid-feedback">Fecha invalido - Es
                                    nesesario escribir la fecha propuesta sin links.</div>
                            </div>
                        </div>
                        <div name="opn-vertical" class="col-12 btn-group" role="group" aria-label="opciones">
                            <!-- en cada input o select agregar is-invalid para errores -->
                            <button type="button" class="btn btn-info visually-hidden" name="buscar">Buscar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="cancelar">Cancelar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="editar">Editar</button>
                            <button type="button" class="btn btn-info" name="editar1">Editar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="nuevo">Nuevo</button>
                            <button type="button" class="btn btn-info" name="nuevo1">Nuevo</button>
                            <button type="button" class="btn btn-info" name="listar">Listar</button>
                        </div>
                    </form>
                    <!-- Tareas pendientes -->
                    <div name="pendientes" class="card bg-secondary text-dark border border-warning mb-3">
                        <div class="card-body">
                            <h2 class="mb-3">Todas las evaluaciones pendientes:</h2>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Curso</th>
                                            <th scope="col">Rango</th>
                                            <th scope="col">Titulo</th>
                                            <th scope="col">F. Propuesto</th>
                                            <th scope="col">Agenda</th>
                                            <th scope="col">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($cursosEvaluaciones); $i++) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $cursosEvaluaciones[$i][6] . " - " . $cursosEvaluaciones[$i][10] ?></th>
                                                <td><?php echo $cursosEvaluaciones[$i][7] ?></td>
                                                <td><?php echo $cursosEvaluaciones[$i][3] ?></td>
                                                <td><?php echo $cursosEvaluaciones[$i][2] ?></td>
                                                <td><?php echo $cursosEvaluaciones[$i][5] == "v" ? "Pendiente" : "Completo"; ?></td>
                                                <td><button type="button" class="btn btn-danger"><i class="bi bi-trash3"></i></button></td>
                                            </tr>
                                        <?php }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </article>
                <!-- notas -->
                <article id="notas" class="container">
                    <h1>Notas:</h1>
                    <p class="fs-4">Aqui puedes registrar las notas de los alumnos en las evaluaciones.</p>
                    <hr class="border-light opacity-75">
                    <!-- Notas para evaluaciones pendientes -->
                    <form name="notas" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Registrar notas a los alumnos:</h2>
                        <div class="row">
                            <div class="col-6 col-lg-8">
                                <div class="mb-3">
                                    <div class="input-group is-validation">
                                        <span class="input-group-text">Evaluacion:</span>
                                        <select id="notas_pd_evaluacion1" aria-label="Evaluacion" title="Evaluacion" class="form-select form-control" disabled required>
                                            <option value="0">Ninguno</option>
                                            <optgroup label="Evaluaciones encontradas">
                                                <?php for ($i = 0; $i < count($cursosEvaluaciones); $i++) { ?>
                                                        <option value="<?php echo $cursosEvaluaciones[$i][1]; ?>">
                                                            <?php echo $cursosEvaluaciones[$i][3] . " - " . $cursosEvaluaciones[$i][6] . " - " . $cursosEvaluaciones[$i][10]. " - " . ($cursosEvaluaciones[$i][5]=="v" ? "pendiente" : "completo"); ?>
                                                        </option>
                                                <?php } ?>
                                            </optgroup>
                                        </select>
                                        <div class="invalid-feedback">Evaluacion invalido
                                            - Es nesesario seleccionar una evaluación sin links.</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group is-validation">
                                        <span class="input-group-text">Nota:</span>
                                        <input type="number" id="notas_pd_nota1" placeholder="N° 20" min="5" max="20" aria-label="Nota" class="form-control" disabled required>
                                        <div class="invalid-feedback">Nota invalido -
                                            Es nesesario escribir la nota de la evaluacion mayor que 4 y menor que 21 sin
                                            links.</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group is-validation">
                                        <span class="input-group-text">Reseña:</span>
                                        <textarea id="notas_pd_reseña1" placeholder="Cosejo para que el alumno mejore" class="form-control" aria-label="Reseña" maxlength="299" disabled required style="max-height: 100px;"></textarea>
                                        <div class="invalid-feedback">Reseña invalido
                                            - Es nesesario escribir tu reseña sin links.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4">
                                <div class="mb-3">
                                    <div class="input-group is-validation">
                                        <span class="input-group-text"><i class="bi bi-people"></i></span>
                                        <select id="notas_pd_alumno1" aria-label="Alumnos" class="form-control" size="8" disabled required>
                                            <option value="0">Ninguno</option>
                                            <optgroup label="Alumnos encontrados"></optgroup>
                                        </select>
                                        <div class="invalid-feedback">Alumnos
                                            invalidos - Es nesesario seleccionar el alumno sin links.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div name="opn-vertical" class="col-12 btn-group" role="group" aria-label="opciones">
                            <!-- en cada input o select agregar is-invalid para errores -->
                            <button type="button" class="btn btn-info visually-hidden" name="buscar">Buscar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="cancelar">Cancelar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="editar">Editar calificación</button>
                            <button type="button" class="btn btn-info visually-hidden" name="editar1">Editar calificación</button>
                            <button type="button" class="btn btn-info visually-hidden" name="nuevo">Calificar</button>
                            <button type="button" class="btn btn-info" name="nuevo1">Calificar</button>
                            <button type="button" class="btn btn-info" name="listar">Listar</button>
                        </div>
                    </form>
                    <!-- ALUMNOS -->
                    <div name="datos_personales" class="card bg-secondary text-dark border border-warning mb-3">
                        <div class="card-body">
                            <h2 class="mb-3">Todas las evaluaciones pendientes:</h2>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Curso</th>
                                            <th scope="col">Rango</th>
                                            <th scope="col">Titulo</th>
                                            <th scope="col">F. Propuesto</th>
                                            <th scope="col">Agenda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($cursosEvaluaciones); $i++) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $cursosEvaluaciones[$i][6] . " - " . $cursosEvaluaciones[$i][10] ?></th>
                                                <td><?php echo $cursosEvaluaciones[$i][7] ?></td>
                                                <td><?php echo $cursosEvaluaciones[$i][3] ?></td>
                                                <td><?php echo $cursosEvaluaciones[$i][2] ?></td>
                                                <td><?php echo $cursosEvaluaciones[$i][5] == "v" ? "Pendiente" : "Completo"; ?></td>
                                            </tr>
                                        <?php }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </article>
                    <!-- cursos -->
                <article id="cursos" class="container">
                    <h1>Cursos:</h1>
                    <p class="fs-4">Registrar nuevo curso para poner como opcion para las activaciones.</p>
                    <hr class="border-light opacity-75">
                    <!-- Nuevo curso -->
                    <form name="laborales" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Nuevo curso:</h2>
                        <div class="mb-3 row visually-hidden">
                            <label for="laboral_code" class="col-sm-2 col-form-label">code</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext bg-success" id="laboral_code" value="" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Nuevo curso:</span>
                                <input type="text" id="nuevo_cs_name1" placeholder="Curso" aria-label="Nuevo curso" class="form-control" disabled required>
                                <div class="invalid-feedback">Nuevo curso invalido
                                    - Es nesesario escribir el curso sin números ni links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Detalles:</span>
                                <textarea class="form-control" placeholder="Detalle del curso" id="nuevo_cs_detalle1" aria-label="Detalles" disabled required style="max-height: 100px;"></textarea>
                                <div class="invalid-feedback">Detalles invalido -
                                    Es nesesario escribir el detalle del curso sin links.</div>
                            </div>
                        </div>
                        <div name="opn-vertical" class="col-12 btn-group" role="group" aria-label="opciones">
                            <!-- en cada input o select agregar is-invalid para errores -->
                            <button type="button" class="btn btn-info visually-hidden" name="buscar">Buscar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="cancelar">Cancelar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="editar">Editar</button>
                            <button type="button" class="btn btn-info" name="editar1">Editar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="nuevo">Nuevo</button>
                            <button type="button" class="btn btn-info" name="nuevo1">Nuevo</button>
                            <button type="button" class="btn btn-info" name="listar">Listar</button>
                        </div>
                    </form>
                    <!-- Cursos -->
                    <div name="table_Cursos" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Todos los cursos:</h2>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo "#" . count($lcurso); ?></th>
                                        <th scope="col">Cusos</th>
                                        <th scope="col">Detalles</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($x = 0; $x < count($lcurso); $x++) {  ?>
                                        <tr>
                                            <td><?php echo $x + 1; ?></td>
                                            <th scope="row"> <?php echo $lcurso[$x][1]; ?></th>
                                            <td> <?php echo $lcurso[$x][2]; ?> </td>
                                            <td><button type="button" class="btn btn-danger"><i class="bi bi-trash3"></i></button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
                <!-- activar cursos -->
                <article id="activar-curso" class="container">
                    <h1>Cursos:</h1>
                    <p class="fs-4">Activar nuevo curso para presentar en como opcion en el inicio.</p>
                    <hr class="border-light opacity-75">
                    <!-- Activar nuevos cursos -->
                    <form name="data_cursos" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Activar nuevo curso:</h2>
                        <div class="mb-3 row visually-hidden">
                            <label for="curso_code" class="col-sm-2 col-form-label">code</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext bg-success" id="curso_code" value="" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Curso:</span>
                                <input type="text" id="curso_ac_titulo" placeholder="Titulo" aria-label="Curso" class="form-control" maxlength="100" disabled required>
                                <div class="invalid-feedback">Titulo del curso
                                    invalido - Es nesesario escribir el Titulo del curso sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Detalles:</span>
                                <textarea class="form-control" placeholder="Detalle del curso" id="curso_ac_detalle" aria-label="Detalles" maxlength="300" disabled required style="max-height: 100px;"></textarea>
                                <div class="invalid-feedback">Detalles invalido -
                                    Es nesesario escribir el detalle del curso sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Local:</span>
                                <select id="curso_ac_Local" aria-label="Local" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Locales encontrados">
                                        <?php
                                        for ($i = 0; $i < count($instituto); $i++) {
                                        ?>
                                            <option value="<?php echo $instituto[$i][3]; ?>"><?php echo $instituto[$i][1] . " - " . $instituto[$i][2]; ?></option>
                                        <?php  } ?>
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">Local invalido - Es
                                    nesesario seleccionar una opción sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Nivel del curso:</span>
                                <input type="number" id="curso_ac_nivel1" placeholder="Nivel" aria-label="Nivel" max="100" class="form-control" max="100" disabled required>
                                <div class="invalid-feedback">Nivel del curso
                                    invalido - Es nesesario escribir el nivel del curso sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">link:</span>
                                <input type="text" id="curso_ac_link1" placeholder="Link del curso" aria-label="Link del curso" maxlength="100" class="form-control" disabled required>
                                <div class="invalid-feedback">link invalido - Es
                                    nesesario escribir el link del curso.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Inicio:</span>
                                <input type="date" id="curso_ac_inicio1" class="form-control" aria-label="Fecha inicio" disabled required>
                                <div class="invalid-feedback">Fecha invalida - Es
                                    nesesario escribir la fecha de inicio sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Teminó:</span>
                                <input type="date" id="curso_ac_termino1" class="form-control" aria-label="Fecha terminó" disabled required>
                                <div class="invalid-feedback">Fecha invalida - Es
                                    nesesario escribir la fecha final sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Número de temas:</span>
                                <select id="num_Temas" aria-label="Cantidad" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <div class="invalid-feedback">Cantidad invalida - Es
                                    nesesario seleccionar una opción sin links.</div>
                            </div>
                        </div>
                        <div name="temas" class="mb-3 visually-hidden">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Temas:</span>
                                <select id="curso_ac_Tema1" aria-label="Tema 1" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Temas encontrados">
                                        <?php
                                        for ($x = 0; $x < count($lcurso); $x++) {
                                        ?>
                                            <option value="<?php echo $x + 1; ?>"><?php echo $lcurso[$x][1]; ?></option>
                                        <?php  } ?>
                                    </optgroup>
                                </select>
                                <select id="curso_ac_Tema2" aria-label="Tema 2" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Temas encontrados">
                                        <?php
                                        for ($x = 0; $x < count($lcurso); $x++) {
                                        ?>
                                            <option value="<?php echo $x + 1; ?>"><?php echo $lcurso[$x][1]; ?></option>
                                        <?php  } ?>
                                    </optgroup>
                                </select>
                                <select id="curso_ac_Tema3" aria-label="Tema 3" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Temas encontrados">
                                        <?php
                                        for ($x = 0; $x < count($lcurso); $x++) {
                                        ?>
                                            <option value="<?php echo $x + 1; ?>"><?php echo $lcurso[$x][1]; ?></option>
                                        <?php  } ?>
                                    </optgroup>
                                </select>
                                <select id="curso_ac_Tema4" aria-label="Tema 4" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Temas encontrados">
                                        <?php
                                        for ($x = 0; $x < count($lcurso); $x++) {
                                        ?>
                                            <option value="<?php echo $x + 1; ?>"><?php echo $lcurso[$x][1]; ?></option>
                                        <?php  } ?>
                                    </optgroup>
                                </select>
                                <select id="curso_ac_Tema5" aria-label="Tema 5" class="form-select form-control" disabled required>
                                    <option value="0">Ninguno</option>
                                    <optgroup label="Temas encontrados">
                                        <?php
                                        for ($x = 0; $x < count($lcurso); $x++) {
                                        ?>
                                            <option value="<?php echo $x + 1; ?>"><?php echo $lcurso[$x][1]; ?></option>
                                        <?php  } ?>
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">Temas invalidos - Es
                                    nesesario seleccionar las opcines sin links.</div>
                            </div>
                        </div>
                        <div name="opn-vertical" class="col-12 btn-group" role="group" aria-label="opciones">
                            <!-- en cada input o select agregar is-invalid para errores -->
                            <button type="button" class="btn btn-info visually-hidden" name="buscar">Buscar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="cancelar">Cancelar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="editar">Editar</button>
                            <button type="button" class="btn btn-info" name="editar1">Editar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="nuevo">Nuevo</button>
                            <button type="button" class="btn btn-info" name="nuevo1">Nuevo</button>
                            <button type="button" class="btn btn-info" name="listar">Listar</button>
                        </div>
                    </form>
                    <!-- locales con cursos -->
                    <div name="table_locales_cursos" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Todos los locales con cursos:</h2>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo count($cursoLocal); ?> Cursos</th>
                                        <th scope="col">Local</th>
                                        <th scope="col">Nivel</th>
                                        <th scope="col">Inicio</th>
                                        <th scope="col">Finalizado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($cursoLocal); $i++) {   ?>
                                        <tr>
                                            <th scope="row"><?php echo $cursoLocal[$i][1]; ?></th>
                                            <td><?php echo $cursoLocal[$i][8]; ?></td>
                                            <td><?php echo $cursoLocal[$i][3]; ?></td>
                                            <td><?php echo $cursoLocal[$i][6]; ?></td>
                                            <td><?php echo $cursoLocal[$i][7]; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
                <!-- institutos -->
                <article id="institutos" class="container">
                    <h1>Institutos:</h1>
                    <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
                    <hr class="border-light opacity-75">
                    <!-- Nuevo curso -->
                    <form name="school" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Nuevo instituto:</h2>
                        <div class="mb-3 row visually-hidden">
                            <label for="school_code" class="col-sm-2 col-form-label">code</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext bg-success" id="school_code" value="" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Nuevo instituto:</span>
                                <input type="text" id="instituto_Name" placeholder="Instituto - Distrito" aria-label="Instituto" class="form-control" disabled required>
                                <div class="invalid-feedback">Nuevo instituto
                                    invalido - Es nesesario escribir el nombre del instituto sin links.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group is-validation">
                                <span class="input-group-text">Dirección:</span>
                                <input type="text" id="indtituto_Address" placeholder="Av. example, caserio #" class="form-control" aria-label="Direccion" disabled required>
                                <div class="invalid-feedback">Dirección invalido -
                                    Es nesesario escribir la direccion del local del instituto sin links.</div>
                            </div>
                        </div>
                        <div name="opn-vertical" class="col-12 btn-group" role="group" aria-label="opciones">
                            <!-- en cada input o select agregar is-invalid para errores -->
                            <button type="button" class="btn btn-info visually-hidden" name="buscar">Buscar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="cancelar">Cancelar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="editar">Editar</button>
                            <button type="button" class="btn btn-info" name="editar1">Editar</button>
                            <button type="button" class="btn btn-info visually-hidden" name="nuevo">Nuevo</button>
                            <button type="button" class="btn btn-info" name="nuevo1">Nuevo</button>
                            <button type="button" class="btn btn-info" name="listar">Listar</button>
                        </div>
                    </form>
                    <!-- Institutos -->
                    <div name="table_Cursos" class="bg-secondary text-dark border border-warning rounded p-3 my-3">
                        <h2 class="mb-3">Todos los institutos:</h2>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo "#" . count($instituto); ?></th>
                                        <th scope="col">Institutos</th>
                                        <th scope="col">Direcciones</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($x = 0; $x < count($instituto); $x++) { ?>
                                        <tr>
                                            <td><?php echo $x + 1; ?></td>
                                            <th scope="row"><?php echo $instituto[$x][1]; ?></th>
                                            <td><?php echo $instituto[$x][2]; ?></td>
                                            <td><button type="button" class="btn btn-danger"><i class="bi bi-trash3"></i></button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
                <!-- colores_portadas -->
                <article id="colores_portadas" class="container bg-secondary text-dark border border-warning rounded py-5">
                    <h1>Colores de portadas:</h1>
                    <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
                    <hr class="border-light opacity-75">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                </article>
                <!-- edición_letras -->
                <article id="edicion_letras" class="container bg-secondary text-dark border border-warning rounded py-5">
                    <h1>Edición de letras:</h1>
                    <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
                    <hr class="border-light opacity-75">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                </article>
                <!-- imagenes_portadas -->
                <article id="imagenes_portadas" class="container bg-secondary text-dark border border-warning rounded py-5">
                    <h1>Imagenes de portadas:</h1>
                    <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
                    <hr class="border-light opacity-75">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                </article>
                <!-- general -->
                <article id="general" class="container bg-secondary text-dark border border-warning rounded py-5">
                    <h1>General:</h1>
                    <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
                    <hr class="border-light opacity-75">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                </article>

            </section>
        </div>
    </div>

    <?php
    include "../footer.php";
    $footers = new footers();
    echo $footers->footer2();
    ?>
    <!-- CDN bootstrap -->
    <script type="text/javascript" src="../configuration/bootstrap.bundle.min.js" languaje="javascript" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <!-- CDN jQuery -->
    <script type="text/javascript" src="../configuration/jquery-3.5.1.min.js" languaje="javascript" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../configuration/config-mister.js" languaje="javascript"></script>
    <script type="text/javascript" src="../configuration/manage-mister.js" languaje="javascript"></script>

</body>

</html>