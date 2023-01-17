<?php

/**
 * Modelos de encavesados
 */
session_start();
class portadas
{
  public function portada1()
  {
?>
    <!-- encabezado -->
    <div class="hero-image">
      <?php echo $this->portada3(); ?>
      <!-- cuerpo hero -->
      <section class="container position-relative top-50 start-0 translate-middle-y">
        <div class="page-header" id="banner">
          <div class="row">
            <div class="col-12">
              <h1 class="display-1">¿Como te esta llendo en el curso?</h1>
            </div>
            <div class="col-12">
              <p class="lead fs-2">Aquí podras revisar tus notas y promedios durante el
                curso con mi persona, registrate y podras vivir de la experiencia.<br>
                Buena suerte.</p>
            </div>
            <div class="col-12">
              <a class="btn btn-primary btn-lg" href="views/register.php" role="button"><i class="bi bi-pencil-square"></i> Registrate</a>
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php
  }/* function */
  
  public function portada2()
  {
  ?>
    <!-- encabezado -->
    <header class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark bg-opacity-50">
      <section class="container">
        <a href="/profesor1" class="navbar-brand">Cursos bonnelee</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <article class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/profesor1" title="Inicio"><i class="bi bi-house"></i> home</a></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/profesor1/views/cv.php" title="Información profecional"><i class="bi bi-person-check"></i> Curriculum vitae</a></a>
            </li>
          </ul>
          <ul class="navbar-nav ms-md-auto">
            <?php
            if (isset($_SESSION['user'])) {
              echo "
            <ul class='nav nav-tabs session-admin'>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-uppercase' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false' title='{$_SESSION['user']}'> <i class='bi bi-person-circle'></i>&nbsp;
                {$_SESSION['type']}
                </a>
                <ul class='dropdown-menu'>
                  <li><a class='dropdown-item' href='#'>Administrar {$_SESSION['type']}</a></li>
                  <li>
                    <hr class='dropdown-divider'>
                  </li>
                  <li><a class='dropdown-item' href='#'>Cerrar session</a></li>
                </ul>
              </li>
            </ul>
          ";
            } ?>
          </ul>
        </article>
      </section>
    </header>
<?php
  }/* function */
  
  public function portada3()
  {
?>
  <header class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark bg-opacity-50">
    <section class="container">
      <a href="/profesor1" class="navbar-brand">Cursos bonnelee</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <article class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/profesor1" title="Inicio"><i class="bi bi-house"></i> home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/profesor1/views/cv.php" title="Información profecional"><i class="bi bi-person-check"></i> Curriculum vitae</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-md-auto">
          <?php if (isset($_SESSION['user'])) { ?>
            <ul class='nav nav-tabs session-admin'>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-uppercase' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false' title='<?php echo $_SESSION['user']; ?>'> <i class='bi bi-person-circle'></i>&nbsp;
                <?php echo $_SESSION['type']; ?>
                </a>
                <ul class='dropdown-menu'>
                  <li><a class='dropdown-item' href='#'>Administrar <?php echo $_SESSION['type']; ?></a></li>
                  <li>
                    <hr class='dropdown-divider'>
                  </li>
                  <li><a class='dropdown-item' href='#'>Cerrar session</a></li>
                </ul>
              </li>
            </ul>
          <?php } else { ?>
            <form name='sesion' class='input-group mb-2' method='POST'>
              <input type='number' class='form-control' id='userInit' placeholder='DNI' aria-label='DNI' min='10000000' max='99999999' aria-describedby='button-addon2' title='Iniciar sesion'>
              <button type='button' class='btn btn-primary' title='Iniciar sesion'><i class='bi bi-door-open-fill'></i> Ingresar</button>
            </form>                
          <?php
          }
          ?>
        </ul>
      </article>
    </section>
  </header>
<?php    
  }
}/* Class */
?>