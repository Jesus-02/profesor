<?php

namespace models;

require_once 'conexion.php';
require_once 'validacion_datos.php';

use models\conexion;
use register\validation;

/**
 * Cursos
 */
class detalle_curso
{
  private $con; /* conexion bd */
  private $data; /*  consulta privada */
  private $validate; /* class requery */
  private $arrayUsers = []; /* validacion de datos */
  public function __construct()
  {
    $this->validate = new validation();
    $this->con = new conexion();
  }
  // detalle temas curso
  public function listar()
  {
    $i = 0;
    $arrayCurso = [];
    $sql = "select * from detalle_curso";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['curso'];
      $arrayCurso[$i][2] = $row['detalle'];
      $arrayCurso[$i][3] = $row['id_decurso'];
      $i++;
    }
    return $arrayCurso;
  }
  /* buscar temas del curso */
  public function btcurso(string $var)
  {
    $response = [];
    $this->arrayUsers[0] = [$var, "texto"];
    $response['test'] = $this->validate->value_date($this->arrayUsers);
    if ($response['test'][1] == "completo") {
      $sql = "select * from detalle_curso where curso='{$var}'";
      $this->data = $this->con->consultaRetorno($sql);
      $response['row'] = $this->data->fetch_array(MYSQLI_ASSOC);
    }
    return json_encode($response);
  }
  /* editar temas */
  public function updateArticle(int $codeArticle)
  {
    $response = [];
    $order = [];
    $order['name'] = isset($_POST['nuevo_cs_name1']) ? $_POST['nuevo_cs_name1'] : "";
    $order['detalle'] = isset($_POST['nuevo_cs_detalle1']) ? $_POST['nuevo_cs_detalle1'] : "";
    $this->arrayUsers[0] = [$order['name'], "texto"];
    $this->arrayUsers[1] = [$order['detalle'], "select_texto"];
    $response['test'] = $this->validate->value_date($this->arrayUsers);
    if ($response['test'][2] == "completo") {
      $sql = "update detalle_curso set curso='{$order['name']}', detalle='{$order['detalle']}' where id_decurso={$codeArticle}";
      $this->con->consultaSimple($sql);
    }
    return json_encode($response);
  }
  /* Nuevo tema */
  public function newArticle()
  {
    $response = [];
    $order = [];
    $order['name'] = isset($_POST['nuevo_cs_name1']) ? $_POST['nuevo_cs_name1'] : "";
    $order['detalle'] = isset($_POST['nuevo_cs_detalle1']) ? $_POST['nuevo_cs_detalle1'] : "";
    $this->arrayUsers[0] = [$order['name'], "texto"];
    $this->arrayUsers[1] = [$order['detalle'], "select_texto"];
    $response['test'] = $this->validate->value_date($this->arrayUsers);
    if ($response['test'][2] == "completo") {
      $sql = "insert into detalle_curso(curso, detalle) values('{$order['name']}', '{$order['detalle']}')";
      $this->con->consultaSimple($sql);
    }
    return json_encode($response);
  }
  // cursos y local
  public function cursos_Local()
  {
    $i = 0;
    $arrayCurso = [];
    $sql = "select * from cursos cu join institutos it ON it.id_local=cu.id_local";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['titulo'];
      $arrayCurso[$i][2] = $row['descripcion'];
      $arrayCurso[$i][3] = $row['nivel'];
      $arrayCurso[$i][4] = $row['link'];
      $arrayCurso[$i][5] = $row['disponivilidad'];
      $arrayCurso[$i][6] = $row['fecha_inicio'];
      $arrayCurso[$i][7] = $row['fecha_fin'];
      $arrayCurso[$i][8] = $row['instituto'] . " - " . $row['av_local'];
      $arrayCurso[$i][9] = $row['id_cursos'];
      $i++;
    }
    return $arrayCurso;
  }
  // cursos y local, Activos
  public function cursos_Activos()
  {
    $i = 0;
    $arrayCurso = [];
    $arrayB = [];
    $sql = "select * from cursos cu join institutos it ON it.id_local=cu.id_local where cu.disponivilidad ='V' order by fecha_inicio desc";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['titulo'];
      $arrayCurso[$i][2] = $row['descripcion'];
      $arrayCurso[$i][3] = $row['nivel'];
      $arrayCurso[$i][4] = $row['link'];
      $arrayCurso[$i][5] = $row['disponivilidad'];
      $arrayCurso[$i][6] = $row['fecha_inicio'];
      $arrayCurso[$i][7] = $row['fecha_fin'];
      $arrayCurso[$i][8] = $row['instituto'];
      $arrayCurso[$i][9] = $row['av_local'];
      $arrayCurso[$i][10] = $row['id_cursos'];
      $i++;
    }
    return $arrayCurso;
  }
  // cursos y local, Desactivados
  public function cursos_Desactivados()
  {
    $i = 0;
    $arrayCurso = [];
    $sql = "select id_cursos, titulo, disponivilidad, fecha_inicio, fecha_fin, instituto";
    $sql = $sql . " from cursos cu join institutos it ON it.id_local=cu.id_local where cu.disponivilidad ='F'";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['titulo'];
      $arrayCurso[$i][2] = $row['disponivilidad'];
      $arrayCurso[$i][3] = $row['fecha_inicio'];
      $arrayCurso[$i][4] = $row['fecha_fin'];
      $arrayCurso[$i][5] = $row['instituto'];
      $arrayCurso[$i][6] = $row['id_cursos'];
      $i++;
    }
    return $arrayCurso;
  }
  // cursos y local, Desactivados, Eliminar mes
  public function cursos_ListarDEliminarM()
  {
    $m = date('m'); $year = date('Y');
    $i = 0;
    $arrayCurso = [];
    $sql = "SELECT cu.id_cursos, cu.titulo, cu.fecha_fin, it.instituto, it.av_local FROM cursos cu JOIN institutos it ON it.id_local=cu.id_local  WHERE cu.disponivilidad='F' AND cu.fecha_fin < '$year-$m-01'";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['titulo'];
      $arrayCurso[$i][2] = $row['fecha_fin'];
      $arrayCurso[$i][3] = $row['instituto'];
      $arrayCurso[$i][4] = $row['av_local'];
      $sql="select count(dni) as 'alumnos' from alumnos as alm join cursos_alumnos as clm on alm.id_alumnos=clm.id_alumno where clm.id_curso='{$row['id_cursos']}'";        
      $this->data = $this->con->consultaRetorno($sql);
      $countData = $this->data->fetch_array(MYSQLI_NUM);
      $arrayCurso[$i][5] = $countData[0];
      $arrayCurso[$i][6] = $row['id_cursos']; 
      $i++;
    }
    return $arrayCurso;
  }
  // cursos y alumnos
  public function cursos_Alumnos()
  {
    $i = 0;
    $arrayCurso = [];
    $arrayB = [];
    $sql = "select cu.id_local, cu.titulo, alu.id_alumnos, alu.nombres, alu.ap_paterno, alu.ap_materno, alu.correo, alu.celular";
    $sql = $sql . " from cursos_alumnos AS ca join alumnos AS alu ON alu.id_alumnos=ca.id_alumno";
    $sql = $sql . " join cursos AS cu on cu.id_cursos=ca.id_curso where cu.disponivilidad='V' order by alu.fecha_registro desc";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['titulo'];
      $arrayCurso[$i][2] = $row['id_alumnos'];
      $arrayCurso[$i][3] = $row['nombres'];
      $arrayCurso[$i][4] = $row['ap_paterno'];
      $arrayCurso[$i][5] = $row['ap_materno'];
      $arrayCurso[$i][6] = $row['correo'];
      $arrayCurso[$i][7] = $row['celular'];
      $arrayB = $this->bLocalxCurso($row['id_local']);
      $arrayCurso[$i][8] = $arrayB[1];
      $arrayCurso[$i][9] = $arrayB[2];
      $i++;
    }
    return $arrayCurso;
  }
    // detalle Alumnos
    public function alumnosError()
    {
      $i = 0;
      $arrayCurso = [];
      $sql = "select al.id_alumnos, al.nombres, al.ap_paterno, al.ap_materno, al.correo, cl.id_curso from alumnos al left join cursos_alumnos cl on cl.id_alumno=al.id_alumnos";
      $this->data = $this->con->consultaRetorno($sql);
      while ($row = $this->data->fetch_array(MYSQLI_ASSOC)) {
        if ($row['id_curso']=="" || $row['id_curso']==null) {
          $arrayCurso[$i][1] = $row['id_alumnos'];
          $arrayCurso[$i][2] = $row['ap_paterno'];
          $arrayCurso[$i][3] = $row['ap_materno'];
          $arrayCurso[$i][4] = $row['correo'];
          $arrayCurso[$i][5] = $row['nombres'];
          $i++;
        }
      }
      return $arrayCurso;
    }
  
  // detalle Alumnos
  public function alumnos()
  {
    $i = 0;
    $arrayCurso = [];
    $sql = "select * from cursos_alumnos ca right join alumnos alu ON alu.id_alumnos=ca.id_alumno";
    $sql = $sql . " join cursos cu on cu.id_cursos=ca.id_curso";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['dni'];
      $arrayCurso[$i][2] = $row['ap_paterno'];
      $arrayCurso[$i][3] = $row['ap_materno'];
      $arrayCurso[$i][4] = $row['correo'];
      $arrayCurso[$i][5] = $row['celular'];
      $arrayCurso[$i][6] = $row['titulo'];
      $arrayCurso[$i][7] = $row['nombres'];
      $i++;
    }
    return $arrayCurso;
  }
  /* buscar alumnos por curso */
  public function bAlumnosxCurso(int $x)
  {
    $i = 0;
    $arrayCurso = [];
    $sql = "select alu.id_alumnos, alu.nombres, alu.ap_paterno, alu.ap_materno, alu.genero, alu.correo, alu.celular";
    $sql = $sql . " from cursos_alumnos AS ca join alumnos AS alu ON alu.id_alumnos=ca.id_alumno";
    $sql = $sql . " join cursos AS cu on cu.id_cursos=ca.id_curso where cu.id_cursos='{$x}'";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['genero'];
      $arrayCurso[$i][2] = $row['id_alumnos'];
      $arrayCurso[$i][3] = $row['nombres'];
      $arrayCurso[$i][4] = $row['ap_paterno'];
      $arrayCurso[$i][5] = $row['correo'];
      $arrayCurso[$i][6] = $row['celular'];
      $i++;
    }
    return $arrayCurso;
  }
  // detalle rango curso
  public function rangos()
  {
    $i = 0;
    $arrayCurso = [];
    $sql = "select * from rangos";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['id_rango'];
      $arrayCurso[$i][2] = $row['tipo_evaluacion'];
      $i++;
    }
    return $arrayCurso;
  }
  // detalle evaluaciones, curso y rango
  public function evaluaciones()
  {
    $i = 0;
    $arrayCurso = [];
    $sql = "select evn.id_nota, evn.fecha, evn.titulo as 'evnTitulo', evn.pendiente, evn.descripcion, cu.id_cursos, cu.titulo  as 'cuTitulo', cu.id_local, rg.id_rango, rg.tipo_evaluacion";
    $sql = $sql." from evaluaciones as evn join cursos as cu on evn.id_curso=cu.id_cursos join rangos as rg on rg.id_rango=evn.id_rango order by evn.fecha asc";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayCurso[$i][1] = $row['id_nota'];
      $arrayCurso[$i][2] = $row['fecha'];
      $arrayCurso[$i][3] = $row['evnTitulo'];
      $arrayCurso[$i][4] = $row['descripcion'];
      $arrayCurso[$i][5] = $row['pendiente'];
      $arrayCurso[$i][6] = $row['cuTitulo'];
      $arrayCurso[$i][7] = $row['tipo_evaluacion'];
      $arrayCurso[$i][8] = $row['id_cursos'];
      $local = $this->bLocalxCurso($row['id_local']);
      $arrayCurso[$i][10] = $local[1];
      $i++;
    }
    return $arrayCurso;
  }
  // buscar local con el curso
  public function bLocalxCurso(int $x)
  {
    $arrayBusqueda = [];
    $sql = "select * from institutos where id_local={$x}";
    $datos = $this->con->consultaRetorno($sql);
    $row = mysqli_fetch_array($datos);
    $arrayBusqueda[1] = $row['instituto'];
    $arrayBusqueda[2] = $row['av_local'];
    return $arrayBusqueda;
  }
  // buscar detalles del curso
  public function bdcusosXcurso(int $x)
  {
    $arrayBusqueda = [];
    $b = 0;
    $sql = "SELECT dcu.curso, dcu.detalle FROM detalle_curso AS dcu";
    $sql = $sql . " INNER JOIN detalles_curso_cursos AS dccu ON dccu.id_decurso=dcu.id_decurso WHERE dccu.id_curso={$x}";
    $datos = $this->con->consultaRetorno($sql);
    while ($row = mysqli_fetch_array($datos)) {
      $arrayBusqueda[$b][1] = $row['curso'];
      $arrayBusqueda[$b][2] = $row['detalle'];
      $b++;
    }
    return $arrayBusqueda;
  }
  // Buscar notas de evaluaciones
  public function bNotasXTest(int $var)
  {
    $y=0;
    $arrayBusqueda=[];
    $sql="SELECT evl.id_nota, evl.nota_numero, alm.nombres, alm.ap_paterno, alm.ap_materno FROM evaluaciones_alumnos evl INNER JOIN alumnos alm ON alm.id_alumnos=evl.id_alumno WHERE  evl.id_nota={$var}";
    $this->data=$this->con->consultaRetorno($sql);
    while ($row = $this->data->fetch_array(MYSQLI_NUM)) {
      $arrayBusqueda['row'][$y][1]=$row[0];
      $arrayBusqueda['row'][$y][2]=$row[2];
      $arrayBusqueda['row'][$y][3]=$row[3];
      $arrayBusqueda['row'][$y][4]=$row[4];
      $arrayBusqueda['row'][$y][5]=$row[1];
      $y++;
    }
    return $arrayBusqueda;
  }
}
error_reporting(0);
if ($_POST['function'] == "articleCB") {
  $classCursos = new detalle_curso();
  echo $classCursos->btcurso($_POST['articleCBuscar']);
} elseif ($_POST['function'] == "editArticle") {
  $classCursos = new detalle_curso();
  echo $classCursos->updateArticle($_POST['laboral_code']);
} elseif ($_POST['function'] == "registerArticle") {
  $classCursos = new detalle_curso();
  echo $classCursos->newArticle();
}

// $listar = new detalle_curso();
// $variante = $listar->cursos_ListarDEliminarM();
// print_r($variante);
// echo count($variante);
