<?php namespace models;
require_once 'conexion.php';
use models\conexion;
/**
 * Docente
 */
class curriculum_vitae
{
  private $con;
  public function __construct(){
    $this->con=new conexion();
  }
  /* contar tablas */
  private function contarDate($value){
    $sql="select * from {$value}";
    $datos= $this->con->consultaRetorno($sql);
    return $cont = mysqli_num_rows($datos);
  }
  /* datos docente */
  public function datePersonal(){
    $arrayPersonal = [];
    $sql="select * from cv_docente";
    $datos= $this->con->consultaRetorno($sql);
    while ($row=mysqli_fetch_array($datos)) {
      $arrayPersonal[1] = $row['nombres'];
      $arrayPersonal[2] = $row['ap_paterno'];
      $arrayPersonal[3] = $row['ap_materno'];
      $arrayPersonal[4] = $row['telefono'];
      $arrayPersonal[5] = $row['celular'];
    }
    return $arrayPersonal;
  }
  /* datos redes sociales */
  public function dateSocial(){
    $arrayPersonal = [];
    $sql="select * from redes_sociales";
    $datos= $this->con->consultaRetorno($sql);
    $i=0;      
    while ($row=mysqli_fetch_array($datos)) {
      $arrayPersonal[$i][0] = $row['nombre'];
      $arrayPersonal[$i][1] = $row['correo'];
      $arrayPersonal[$i][2] = $row['link'];
      $arrayPersonal[$i][3] = $row['id_rsocial'];
      $i++;      
    }
    return $arrayPersonal;
  }
  /* datos laborales */
  public function dateLaboral(){
    $arrayPersonal = [];
    $sql="select * from date_laboral order by fecha_inicio desc";
    $datos= $this->con->consultaRetorno($sql);
    $i=0;
    while ($row=mysqli_fetch_array($datos)) {
      $arrayPersonal[$i][1] = $row['experiencia'];
      $arrayPersonal[$i][2] = $row['lugar'];
      $arrayPersonal[$i][3] = $row['fecha_inicio'];
      $arrayPersonal[$i][4] = $row['fecha_fin'];
      $arrayPersonal[$i][5] = $row['id_experiencia'];
      $i++;
    }
    return $arrayPersonal;
  }
  /* datos cursos */
  public function dateCursos(){
    $arrayPersonal = [];
    $sql="select * from date_cursos order by fecha_inicio desc";
    $datos= $this->con->consultaRetorno($sql);
    $i=0;
    while ($row=mysqli_fetch_array($datos)) {
      $arrayPersonal[$i][1] = $row['curso_ejercido'];
      $arrayPersonal[$i][2] = $row['descripcion'];
      $arrayPersonal[$i][3] = $row['nivel_porcentaje'];
      $arrayPersonal[$i][4] = $row['lugar'];
      $arrayPersonal[$i][5] = $row['fecha_inicio'];
      $arrayPersonal[$i][6] = $row['fecha_fin'];
      $arrayPersonal[$i][7] = $row['id_dcurso'];
      $i++;
    }
    return $arrayPersonal;
  }

}/*clase*/

// $listar = new curriculum_vitae();
// $variante = $listar->dateCursos();
// print_r($variante);
// echo count($variante);

?>