<?php namespace models;
  require_once "conexion.php";
  use models\conexion;
  /**
   * STUDENTS
  */
  class students{
    private $con; /* conexion */
    private $session = []; /* session */
    private $data; /* consulta privada */
    public function __construct(){
      $this->con=new conexion();
      session_start();
      $this->session = [$_SESSION['user'], $_SESSION['type']];
    }
    /* datosalumno */
    public function dataUser(){
      $response = [];
      $sql="select * from alumnos where dni={$this->session[0]}";
      $this->data = $this->con->consultaRetorno($sql);
      $row=$this->data->fetch_array(MYSQLI_NUM);
      $response['row'][1]=$row[2];
      $response['row'][2]=$row[3];
      $response['row'][3]=$row[4];
      $response['row'][4]=$row[5];
      $response['row'][5]=$row[6];
      $response['row'][6]=$row[7];
      $response['row'][7]=$row[8];
      return $response;
    }
    /* Cursos */    
    public function userCurses(){
      $response = [];
      $sql="select cul.id_curso from alumnos al inner join cursos_alumnos cul on al.id_alumnos=cul.id_alumno where al.dni={$this->session[0]}";
      $this->data = $this->con->consultaRetorno($sql);
      if($this->data->num_rows > 0){
        while($curses=$this->data->fetch_array(MYSQLI_ASSOC)){
          $sql="select cu.id_cursos, cu.titulo, cu.descripcion, cu.link, cu.fecha_inicio, cu.fecha_fin, it.instituto, it.av_local from cursos cu inner join institutos it on cu.id_local=it.id_local where cu.id_cursos={$curses['id_curso']}";
          $this->data = $this->con->consultaRetorno($sql);
          $row=$this->data->fetch_array(MYSQLI_ASSOC);
          $response['row'][1]=$row['id_cursos'];
          $response['row'][2]=$row['titulo'];
          $response['row'][3]=$row['descripcion'];
          $response['row'][4]=$row['link'];
          $response['row'][5]=$row['fecha_inicio'];
          $response['row'][6]=$row['fecha_fin'];
          $response['row'][7]=$row['instituto'];
          $response['row'][8]=$row['av_local'];
        }        
      }
      return $response;
    }
  }
  // pruevas
  // $student = new students();
  // $dataSt = $student->curses();
  // print_r($dataSt);
  // echo count($dataSt);

?>