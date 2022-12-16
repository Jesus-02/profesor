<?php namespace models;
/**
 * conexion
 */
class conexion
{
  private $datos = array(
    "host" => "localhost",
    "user" => "root",
    "pass" => "962913797",
    "db" => "profesor1"
  );
  private $con;

  public function __construct(){
    $this->con = new \mysqli(
      $this->datos['host'],
      $this->datos['user'],
      $this->datos['pass'],
      $this->datos['db']
    );
  }
  public function consultaSimple($sql){
    $this->con->query($sql);
  }
  public function consultaRetorno($sql){
    $datos = $this->con->query($sql);
    return $datos;
  }
}
?>
