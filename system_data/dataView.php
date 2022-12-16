<?php
  //   Mister
  include_once "data_Mister.php";
  use models\curriculum_vitae;
  $mister = new curriculum_vitae();
  //   Datos personales
  $variante = $mister->datePersonal();
  //   Datos redes sociales
  $social = $mister->dateSocial();
  //   Datos cursos realizados
  $dcursos = $mister->dateCursos();
  //   Datos laboral
  $dlaboral = $mister->dateLaboral();
  
  //   Institutos
  include_once "data_Institute.php";
  use models\institutos;
  $intitutos = new institutos();
  //   Listar institutos
  $instituto = $intitutos->listar();
  
  //   Cursos
  include_once "data_Cursos.php";
  use models\detalle_curso;
  $cursos = new detalle_curso();
  //   Cusos
  $lcurso = $cursos->listar();
  //   cursos y local
  $cursoLocal = $cursos->cursos_Local();
  //   cursos y Activos
  $cursoV = $cursos->cursos_Activos();
  //   cursos y Desactivados
  $cursoF = $cursos->cursos_Desactivados();
  // cursos y local, Desactivados, Eliminar meses anteriores
  $cursoFE =$cursos->cursos_ListarDEliminarM();
  // cursos y local, alumnos activos
  $cursoAlumnos = $cursos->cursos_Alumnos();  
  // Alumnos
  $alumnosD = $cursos->alumnos();
  // Rangos
  $cursosRangos = $cursos->rangos();
  // Evaluaciones
  $cursosEvaluaciones = $cursos->evaluaciones();

  // print_r($cursosRangos);
  // echo count($cursosRangos);
?>