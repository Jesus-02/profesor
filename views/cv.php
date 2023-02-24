<?php
include_once "../header.php";
include_once "../system_data/dataView.php";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bonnelee | CV</title>
  <link rel="shortcut icon" href="../imagens/mister.png" type="image/x-icon">
  <link href="../styles/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="../styles/generals.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
  <?php
  $portadas= new portadas();
  echo $portadas->portada3();
  ?>
  <!-- cuerpo -->
  <section class="container-lg" style="margin-top:50px">
    <div class="row">
      <div class="col-12 p-0 my-5">
        <!-- card principal -->
        <div class="card text-white bg-opacity-50 border border-success border-3">
          <div class="card-header">
            <div class="row my-4 mx-auto" style="width: 70%;">
              <div class="col-12 col-md-7">
                <h1 class="display-3"><?php echo $variante[1]; ?></h1>
                <h1 class="display-3"><span><?php echo $variante[2]; ?></span> <span><?php echo $variante[3]; ?></span></h1>
                <h2>Programador web full stack junior</h2>
              </div>
              <div class="col-12 col-md-5 p-2">
                <img src="../imagens/IMG_20160605_151301~2.jpg" class="d-block rounded-pill mx-auto" width="80%" height="250"
                 aria-label="Imagen cargando" title="'<?php echo $variante[1]." ".$variante[2]; ?>'" alt="Docente">
              </div>
            </div>
          </div>
          <div class="card-body lh-base">
            <div class="row">
              <!-- seccion menu -->
              <section class="col-12 col-md-3">
                <article class="py-4">
                  <div class="border-bottom border-dark">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item justify-content-between align-items-center">
                        <h3>
                          <span>CONTACTOS</span>
                        </h3>
                        <h5 class="lh-lg">
                          <span class="badge bg-primary rounded-pill"><i class="bi bi-telephone-fill" title="Telefono"></i></span>
                          <span>(01) <?php echo $variante[4]; ?></span>
                        </h5>
                        <h5 class="lh-lg">
                          <span class="badge bg-primary rounded-pill"><i class="bi bi-phone" title="Celular"></i></span>
                          <span>+51 <?php echo $variante[5]; ?></span>
                        </h5>
                      </li><!-- grupo niveles -->
                      <li class="list-group-item justify-content-between align-items-center">
                        <h3>
                          <span>PROYECTOS REALIZADOS</span>
                        </h3>
                        <h5 class="lh-lg">
                          <span class="badge bg-primary rounded-pill"><i class="bi bi-globe" title="Web"></i></span>
                          <a href="https://alesus2022.000webhostapp.com" target="_blanck">www.alesus2022.com</a>
                        </h5>
                        <h5 class="lh-lg">
                          <span class="badge bg-primary rounded-pill"><i class="bi bi-globe" title="Web"></i></span>
                          <a href="https://alesus2022.000webhostapp.com/clases/tareas/ejercicio-14/index.html" target="_blanck">www.aurili.com</a>
                        </h5>
                      </li><!-- grupo niveles -->
                      <li class="list-group-item">
                        <h3>HABILIDADES</h3>
                        <?php for ($i=0; $i < count($dcursos); $i++) {
                          if($dcursos[$i][5]==$dcursos[$i][6]){
                        ?>                           
                          <div class="row px-0 my-3">
                            <div class="col-5 text-end">
                              <span><?php echo $dcursos[$i][1]; ?></span>
                            </div>
                            <div class="col-7 p-0">
                              <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" aria-valuenow="<?php echo $dcursos[$i][3]; ?>%" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $dcursos[$i][3]; ?>%">
                                  <span class="fw-bolder text-dark">
                                    <?php echo $dcursos[$i][3]; ?>%
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php }} ?>
                      </li><!-- grupo niveles -->
                      <li class="list-group-item justify-content-between align-items-center">
                        <h3>
                          <span>SOCIAL</span>
                        </h3>
                        <?php for ($i=0; $i < count($social); $i++) {   ?>
                        <h5 class="lh-lg">
                          <span class="badge bg-primary rounded-pill"><i class="bi bi-<?php echo $social[$i][0];?>"></i></span>
                          <a href="<?php echo $social[$i][2];?>" title="<?php echo $social[$i][0];?>" target="_blanck"><?php echo $social[$i][1];?></a>
                        </h5>
                        <?php } ?>
                      </li><!-- grupo niveles -->
                    </ul>
                  </div>
                </article>
              </section>
              <!-- Seccion Cuerpo -->
              <section class="col-12 col-md-8 border-start border-dark border-2">
                <!-- sobre mi -->
                <article class="p-4">
                  <div class="border-bottom border-2">
                    <h1>SOBRE MY</h1>
                    <p class="fs-4">
                      Hola, mi nombre es Jesús y soy un desarrollador de diseño web,
                      actualmente por el momento estoy laborado en plaza vea en el area
                      de almacen frescos como part time.
                    </p>
                  </div>
                </article>
                <!-- labora -->
                <article class="p-4">
                  <div class="row align-items-center border-bottom border-2">
                    <div class="col-12 col-md-7">
                      <h2>ESPERIENCIA LABORAL</h2>
                      <ul class="list-group list-group-flush ms-5 py-4">
                        <?php for ($i=0; $i < count($dlaboral); $i++) { ?>
                          <li class="list-group-item border-start px-0">
                            <div class="row">
                              <div class="col-1">
                                <i class="bi bi-chevron-right position-start"></i>
                              </div>
                              <div class="col-11">
                                <h3><?php echo substr($dlaboral[$i][3], 0, 7); ?> / <?php echo substr($dlaboral[$i][4], 0, 7); ?></h3>
                                <h4 class="text-uppercase"><?php echo $dlaboral[$i][1]; ?></h4>
                                <p>
                                <?php echo $dlaboral[$i][2]; ?>
                                </p>
                              </div>
                            </div>
                          </li><!-- li -->
                          <?php } ?>                        
                      </ul>
                    </div>
                    <div class="col-12 col-md-5">
                      <img src="../imagens/programador.png" alt="" width="100%">
                    </div>
                  </div>
                </article>
                <!-- educacion -->
                <article class="p-4">
                  <div class="row align-items-center border-bottom border-2">
                    <div class="col-12 col-md-7">
                      <h2>EDUCACION</h2>
                      <ul class="list-group list-group-flush ms-5 py-4">
                        <?php for ($i=0; $i < count($dcursos); $i++) { 
                        if($dcursos[$i][5]<$dcursos[$i][6]){
                        ?>
                          <li class="list-group-item border-start px-0">
                            <div class="row">
                              <div class="col-1">
                                <i class="bi bi-chevron-right position-start"></i>
                              </div>
                              <div class="col-11">
                                <h3><?php echo substr($dcursos[$i][5], 0, 7); ?> / <?php echo substr($dcursos[$i][6], 0, 7); ?></h3>
                                <h4 class="text-uppercase"><?php echo $dcursos[$i][1]; ?></h4>
                                <p>
                                  <?php echo $dcursos[$i][4]; ?>
                                </p>
                              </div>
                            </div>
                          </li><!-- li -->
                          <?php }} ?>                        
                      </ul>
                    </div>
                    <div class="col-12 col-md-5">
                      <img src="../imagens/estudent.png" alt="" width="100%">
                    </div>
                  </div>
                </article>
                <!-- hobbys -->
                <article class="p-4">
                  <h1>HOBBY</h1>
                  <div class="row justify-content-md-center">
                    <div class="col-6 col-md-2">
                      <i class="bi bi-book" title="Lectura" style="font-size:5em;"></i>
                    </div>
                    <div class="col-6 col-md-2">
                      <i class="bi bi-controller" title="Juegos de PC" style="font-size:5em;"></i>
                    </div>
                    <div class="col-6 col-md-2">
                      <i class="bi bi-music-note-beamed" title="Música" style="font-size:5em;"></i>
                    </div>
                    <div class="col-6 col-md-2">
                      <i class="bi bi-youtube" title="Youtube" style="font-size:5em;"></i>
                    </div>
                  </div>
                </article>
              </section>
            </div>
          </div>
        </div><!-- card -->
      </div>
    </div>
  </section>

<script src="../configuration/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../configuration/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="../configuration/config-general.js" crossorigin="anonymous"></script>
</body>
</html>
