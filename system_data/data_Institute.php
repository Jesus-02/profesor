<?php namespace models;

require_once 'conexion.php';
require_once 'validacion_datos.php';
use models\conexion;
use register\validation;

/**
 * Intitutos
 */
class institutos
{
  private $con;
  private $data; /*  consulta privada */
  private $validate; /* class requery */
  private $arrayUsers=[]; /* validacion de datos */
  public function __construct(){
    $this->con = new conexion();
    $this->validate = new validation();
  }
  public function listar(){
    $arrayIntituto=[];
    $i=0;
    $sql="select * from institutos";
    $datos= $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)){
      $arrayIntituto[$i][1] = $row['instituto'];
      $arrayIntituto[$i][2] = $row['av_local'];
      $arrayIntituto[$i][3] = $row['id_local'];
      $i++;
    }
    return $arrayIntituto;
  }
    /* buscar Instituto */
  public function bSchool(string $var)
  {
    $response = [];
    $this->arrayUsers[0] = [$var, "texto_numero"];
    $response['test'] = $this->validate->value_date($this->arrayUsers);
    if ($response['test'][1] == "completo") {
      $sql = "select * from institutos where instituto='{$var}'";
      $this->data = $this->con->consultaRetorno($sql);
      $response['row'] = $this->data->fetch_array(MYSQLI_ASSOC);
    }
    return json_encode($response);
  }
    /* Editar Instituto */
  public function updateSchool(int $codeSchool)
  {
    $response = [];
    $order = [];
    $order['name'] = isset($_POST['instituto_Name']) ? $_POST['instituto_Name'] : "";
    $order['address'] = isset($_POST['indtituto_Address']) ? $_POST['indtituto_Address'] : "";
    $this->arrayUsers[0] = [$order['name'], "texto_numero"];
    $this->arrayUsers[1] = [$order['address'], "select_texto"];
    $response['test'] = $this->validate->value_date($this->arrayUsers);
    if ($response['test'][2] == "completo") {
      $sql = "update institutos set instituto='{$order['name']}', av_local='{$order['address']}' where id_local={$codeSchool}";
      $this->con->consultaSimple($sql);
    }
    return json_encode($response);
  }
  /* Nuevo instituto */
  public function newSchool()
  {
    $response = [];
    $order = [];
    $order['name'] = isset($_POST['instituto_Name']) ? $_POST['instituto_Name'] : "";
    $order['address'] = isset($_POST['indtituto_Address']) ? $_POST['indtituto_Address'] : "";
    $this->arrayUsers[0] = [$order['name'], "texto_numero"];
    $this->arrayUsers[1] = [$order['address'], "select_texto"];
    $response['test'] = $this->validate->value_date($this->arrayUsers);
    if ($response['test'][2] == "completo"){
      $sql = "insert into institutos(instituto, av_local) values('{$order['name']}', '{$order['address']}')";
      $this->con->consultaSimple($sql);
    }
    return json_encode($response);
  }
}
error_reporting(0);
if ($_POST['function'] == "schoolB") {
  $classSchool = new institutos();
  echo $classSchool->bSchool($_POST['schoolBuscar']);
}else if ($_POST['function'] == "schoolEdit") {
  $classSchool = new institutos();
  echo $classSchool->updateSchool($_POST['school_code']);
}else if ($_POST['function'] == "registerSchool") {
  $classSchool = new institutos();
  echo $classSchool->newSchool();
}
// $listar = new institutos();
// $variante = $listar->listar();
// print_r($variante);
// echo count($variante);
