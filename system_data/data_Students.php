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
      $response['row'][8]=$row[0];
      return $response;
    }
    /* Cursos */    
    public function userCurses(){
      $response = []; $i=0;
      $sql="select cul.id_curso from alumnos al inner join cursos_alumnos cul on al.id_alumnos=cul.id_alumno where al.dni={$this->session[0]}";
      $this->data = $this->con->consultaRetorno($sql);
      if($this->data->num_rows > 0){
        while($curses=$this->data->fetch_array(MYSQLI_ASSOC)){
          $sql="select cu.id_cursos, cu.titulo, cu.descripcion, cu.link, cu.fecha_inicio, cu.fecha_fin, it.instituto, it.av_local from cursos cu inner join institutos it on cu.id_local=it.id_local where cu.id_cursos={$curses['id_curso']}";
          $this->data = $this->con->consultaRetorno($sql);
          $row=$this->data->fetch_array(MYSQLI_ASSOC);
          $response['row'][$i][1]=$row['id_cursos'];
          $response['row'][$i][2]=$row['titulo'];
          $response['row'][$i][3]=$row['descripcion'];
          $response['row'][$i][4]=$row['link'];
          $response['row'][$i][5]=$row['fecha_inicio'];
          $response['row'][$i][6]=$row['fecha_fin'];
          $response['row'][$i][7]=$row['instituto'];
          $response['row'][$i][8]=$row['av_local'];
          $i++;
        }       
      }else{
        $response['row']=0;
      }
      return $response;
    }
    public function testCurse(){
      $response = []; $i=0;
      $user = $this->dataUser();
      $sql="select cu.titulo as curso, ev.id_nota, ev.fecha, ev.titulo, ev.descripcion, rg.tipo_evaluacion, it.instituto from cursos cu join evaluaciones ev on cu.id_cursos=ev.id_curso join cursos_alumnos cual on cual.id_curso=cu.id_cursos join rangos rg on rg.id_rango=ev.id_rango join institutos it on it.id_local=cu.id_local where cual.id_alumno={$user['row'][8]} order by ev.fecha desc";
      $this->data = $this->con->consultaRetorno($sql);
      if($this->data->num_rows > 0){
        while($row = $this->data->fetch_array(MYSQLI_ASSOC)){
          $response['row'][$i][1]=$row['id_nota'];
          $response['row'][$i][2]=$row['fecha'];
          $response['row'][$i][3]=$row['titulo'];
          $response['row'][$i][4]=$row['descripcion'];
          $response['row'][$i][5]=$row['tipo_evaluacion'];
          $response['row'][$i][6]=$row['instituto'];
          $response['row'][$i][7]=$row['curso'];
          $i++;
        }
      }else{
        $response['row']=0;
      }
      return $response;
    }
    /* grade = calificación */
    public function testGrade(int $grade){
      $response = [];
      $sql="select * from evaluaciones_alumnos where id_nota={$grade}";
      $this->data = $this->con->consultaRetorno($sql);
      if($this->data->num_rows > 0){
        $row = $this->data->fetch_array(MYSQLI_NUM);
        $response['grade'][0]=true;
        $response['grade'][1]=$row[2];
        $response['grade'][2]=$row[3];
        $response['grade'][3]=$row[4];
      }else{
        $response['grade'][0] = false;
      }
      return $response;
    }
    public function countTest(string $rango){
      $response = [];
      $user = $this->dataUser();
      $sql="select count(cu.titulo) as 'notas' from cursos cu join evaluaciones ev on cu.id_cursos=ev.id_curso join cursos_alumnos cual on cual.id_curso=cu.id_cursos join rangos rg on rg.id_rango=ev.id_rango join institutos it on it.id_local=cu.id_local where cual.id_alumno={$user['row'][8]} and rg.tipo_evaluacion='{$rango}'";
      $this->data = $this->con->consultaRetorno($sql);
      if($this->data->num_rows > 0){
        $row = $this->data->fetch_array(MYSQLI_ASSOC);
        $response['count'][0]= true;
        $response['count'][1]= $row['notas'];
      }else{
        $response['count'][0] = false;
      }
      return $response;
    }
  }
  // pruevas
  // $student = new students();
  // $dataSt = $student->testCurse();
  // print_r($dataSt);
  // echo count($dataSt);

?>