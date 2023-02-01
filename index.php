<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bonnelee | Inicio</title>
  <link rel="shortcut icon" href="imagens/mister.png" type="image/x-icon">
  <link href="styles/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="styles/generals.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
  <?php
  include "header.php";
  $portadas= new portadas();
  echo $portadas->portada1();
  include_once "system_data/dataView.php";
  ?>
  <!-- cuerpo -->
  <div class="container my-3">
    <h1>Cursos:</h1>
    <p class="fs-4">Cursos que puedes ejercer con mi persona.</p>
    <hr>
    <div class="row justify-content-center">
      <?php for ($i=0; $i < count($cursoV); $i++) { ?>
      <div class="my-3 col-12 col-md-6 col-lg-4">
        <div class="card">
          <div class="card-header text-uppercase">
            <i class="bi bi-building"></i> 
            <?php 
              /* Nombre de intituto */
              $posit = strpos($cursoV[$i][8],"-") - 1;
              echo substr($cursoV[$i][8],0, $posit);            
            ?>
          </div>
          <div class="card-img">
            <img src="imagens/pocesamiento-lenguaje.jpg" class="d-block" alt="lenguajes" width="100%">
          </div>
          <div class="card-body">
            <h5 class="card-title"><?php echo $cursoV[$i][1]; ?></h5>
            <p class="card-text"><?php echo $cursoV[$i][2]; ?></p>
              <div class="accordion" id="accordion<?php echo $cursoV[$i][1]; ?>">
              <?php ;
                $bdCursos = $cursos->bdcusosXcurso($cursoV[$i][10]);              
              ?>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $cursoV[$i][10]; ?>" aria-expanded="false" aria-controls="collapse<?php echo $cursoV[$i][10]; ?>">
                    <?php echo count($bdCursos); ?> Tecnologias a usar:
                    </button>
                  </h2>
                  <div id="collapse<?php echo $cursoV[$i][10]; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $cursoV[$i][10]; ?>" data-bs-parent="#accordion<?php echo $cursoV[$i][1]; ?>">
                    <div class="accordion-body">
                      <ul class="card-text">
                      <?php for ($x=0; $x < count($bdCursos); $x++) { ?>
                        <li><?php echo $bdCursos[$x][1]; ?></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>              
              </div>
            <br><a href="<?php echo $cursoV[$i][4]; ?>" target="_blank" class="btn btn-primary">Ir a suscribirse</a>
          </div><!-- body card -->
        </div><!-- card -->
      </div><!-- columna -->
      <?php } ?>      
    </div><!-- divicion -->
  </div>

<?php
include_once "footer.php";
$footers = new footers();
echo $footers->footer1();
?>
<script src="configuration/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="configuration/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="configuration/config-general.js" crossorigin="anonymous"></script>
</body>
</html>
