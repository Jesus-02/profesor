<?php namespace userAdmin;

require_once "conexion.php";
require_once "validacion_datos.php";

use models\conexion;
use register\validation;

setlocale(LC_ALL, "es_PE");
/**
 * Usuario administrador
 */
class userAdmin
{
    private $con; /* conexion */
    private $session = []; /* session */
    private $data; /*  consulta privada */
    private $validate; /* class requery */
    private $arrayUsers = []; /* validacion de datos */
    public function __construct()
    {
        $this->con = new conexion();
        $this->validate = new validation();
        session_start();
        $this->session = [$_SESSION['user'], $_SESSION['type']];
    }
    public function editData()
    {
        $order = [];
        $response = [];
        $order['name'] = isset($_POST['editar_dp_name1']) ? $_POST['editar_dp_name1'] : "";
        $order['surNameP'] = isset($_POST['editar_dp_surName1']) ? $_POST['editar_dp_surName1'] : "";
        $order['surNameM'] = isset($_POST['editar_dp_surName2']) ? $_POST['editar_dp_surName2'] : "";
        $order['phone'] = isset($_POST['editar_dp_phone1']) ? $_POST['editar_dp_phone1'] : "";
        $order['cellphone'] = isset($_POST['editar_dp_cellphone1']) ? $_POST['editar_dp_cellphone1'] : "";
        $this->arrayUsers[0] = [$order['name'], 'texto'];
        $this->arrayUsers[1] = [$order['surNameP'], 'texto'];
        $this->arrayUsers[2] = [$order['surNameM'], 'texto'];
        $this->arrayUsers[3] = [$order['phone'], 'telefono'];
        $this->arrayUsers[4] = [$order['cellphone'], 'celular'];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][5] == "validar") {
            $response['test'];
        } else {
            $sql = "UPDATE cv_docente SET nombres='{$order['name']}', ap_paterno = '{$order['surNameP']}', ap_materno = '{$order['surNameM']}',";
            $sql = $sql . " telefono = '{$order['phone']}', celular = '{$order['cellphone']}' WHERE dni = {$this->session[0]}";
            $this->data = $this->con->consultaRetorno($sql);
            $response['error'][1] = $this->data;
        }
        return json_encode($response);
    }
    public function updataPassqord(int $user)
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['pass']) ? $_POST['pass'] : "";
        $order[2] = isset($_POST['newPass']) ? $_POST['newPass'] : "";
        $order[3] = isset($_POST['passConfirm']) ? $_POST['passConfirm'] : "";
        $this->arrayUsers[0] = [$user, 'telefono'];
        $this->arrayUsers[1] = [$order[1], 'password'];
        $this->arrayUsers[2] = [$order[2], 'password'];
        $this->arrayUsers[3] = [$order[3], 'password'];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($order[2]!=$order[3]) {
            $response['segurity']="confirm";
        }else if ($response['test'][4]=="completo") {
            $sql = "SELECT dt.id_cv, ci.id_correo, ci.pass01 FROM cv_docente AS dt JOIN seguritymister AS sm ON dt.id_cv=sm.id_cv JOIN correo_ingreso AS ci ON ci.id_correo=sm.id_correo WHERE dni={$user}";
            $this->data=$this->con->consultaRetorno($sql);
            $row = $this->data->fetch_array(MYSQLI_NUM);
            if (password_verify($order[1], $row[2])) {
                $encript = password_hash($order[2], PASSWORD_DEFAULT, ['cost' => 5]);
                $sql="UPDATE correo_ingreso SET pass01='{$encript}' WHERE id_correo={$row[1]}";
                $this->con->consultaSimple($sql);
            }else{
                $response['segurity']="password";
            }
        }
        return json_encode($response);
    }
    /* datos Red social */
    public function newSocial()
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['social']) ? $_POST['social'] : "";
        $order[2] = isset($_POST['mail']) ? $_POST['mail'] : "";
        $order[3] = isset($_POST['url']) ? $_POST['url'] : "";
        $order[4] = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        $this->arrayUsers[0] = [$order[1], "texto"];
        $this->arrayUsers[1] = [$order[2], "nameCorreo"];
        $this->arrayUsers[2] = [$order[3], "link"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][3] == "completo") {
            $user = $this->sessionUser();
            $sql = "INSERT INTO redes_sociales(nombre, correo, link, id_cv) VALUES('{$order[1]}','{$order[2]}','{$order[3]}', '$user')";
            $this->data = $this->con->consultaSimple($sql);
        }
        return json_encode($response);
    }
    public function updataSocial()
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['social']) ? $_POST['social'] : "";
        $order[2] = isset($_POST['mail']) ? $_POST['mail'] : "";
        $order[3] = isset($_POST['url']) ? $_POST['url'] : "";
        $order[4] = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        $this->arrayUsers[0] = [$order[1], "texto"];
        $this->arrayUsers[1] = [$order[2], "nameCorreo"];
        $this->arrayUsers[2] = [$order[3], "link"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][3] == "completo") {
            $sql = "update redes_sociales set nombre='{$order[1]}', correo='$order[2]', link='$order[3]' where id_rsocial={$order[4]}";
            $this->data = $this->con->consultaSimple($sql);
        }
        return json_encode($response);
    }
    public function buscarSocial($valor)
    {
        $sql = "select id_rsocial, nombre, correo, link from redes_Sociales where id_rsocial={$valor}";
        $this->data = $this->con->consultaRetorno($sql);
        $row = $this->data->fetch_array(MYSQLI_ASSOC);
        return json_encode($row);
    }
    /* Datos Cursos */
    public function newCurso()
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['curso']) ? $_POST['curso'] : "";
        $order[2] = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
        $order[3] = isset($_POST['nPorcentaje']) ? $_POST['nPorcentaje'] : "";
        $order[4] = isset($_POST['lugar']) ? $_POST['lugar'] : "";
        $order[5] = isset($_POST['fInicio']) ? $_POST['fInicio'] : "";
        $order[6] = isset($_POST['fTermino']) ? $_POST['fTermino'] : "";
        $order[7] = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        $order[8] = isset($_POST['function']) ? $_POST['function'] : "";
        $this->arrayUsers[0] = [$order[1], "texto"];
        $this->arrayUsers[1] = [$order[2], "texto_numero"];
        $this->arrayUsers[2] = [$order[3], "porcentaje"];
        $this->arrayUsers[3] = [$order[4], "select_texto"];
        $this->arrayUsers[4] = [$order[5], "date"];
        $this->arrayUsers[5] = [$order[6], "date"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][6] == "completo") {
            $user = $this->sessionUser();
            $sql = "INSERT INTO date_cursos(curso_ejercido, descripcion, nivel_porcentaje, lugar, fecha_inicio, fecha_fin, id_cv)";
            $sql = $sql . " VALUES('{$order[1]}','{$order[2]}','{$order[3]}','{$order[4]}','{$order[5]}','{$order[6]}', '$user')";
            $this->data = $this->con->consultaSimple($sql);
        }
        return json_encode($response);
    }
    public function updataCurso()
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['curso']) ? $_POST['curso'] : "";
        $order[2] = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
        $order[3] = isset($_POST['nPorcentaje']) ? $_POST['nPorcentaje'] : "";
        $order[4] = isset($_POST['lugar']) ? $_POST['lugar'] : "";
        $order[5] = isset($_POST['fInicio']) ? $_POST['fInicio'] : "";
        $order[6] = isset($_POST['fTermino']) ? $_POST['fTermino'] : "";
        $order[7] = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        $order[8] = isset($_POST['function']) ? $_POST['function'] : "";
        $this->arrayUsers[0] = [$order[1], "texto"];
        $this->arrayUsers[1] = [$order[2], "texto_numero"];
        $this->arrayUsers[2] = [$order[3], "porcentaje"];
        $this->arrayUsers[3] = [$order[4], "select_texto"];
        $this->arrayUsers[4] = [$order[5], "date"];
        $this->arrayUsers[5] = [$order[6], "date"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][6] == "completo") {
            $sql = "update date_cursos set curso_ejercido='{$order[1]}', descripcion='{$order[2]}', nivel_porcentaje='{$order[3]}',";
            $sql = $sql . " lugar='{$order[4]}', fecha_inicio='{$order[5]}', fecha_fin='{$order[6]}' where id_dcurso={$order[7]}";
            $this->data = $this->con->consultaSimple($sql);
        }
        return json_encode($response);
    }
    public function buscarCurso($valor)
    {
        $sql = "select id_dcurso, curso_ejercido, descripcion, nivel_porcentaje, lugar, fecha_inicio, fecha_fin from date_cursos where id_dcurso={$valor}";
        $this->data = $this->con->consultaRetorno($sql);
        $row = $this->data->fetch_array(MYSQLI_ASSOC);
        return json_encode($row);
    }
    /* Datos Laboral */
    public function newLaboral()
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['cargo']) ? $_POST['cargo'] : "";
        $order[2] = isset($_POST['lugar']) ? $_POST['lugar'] : "";
        $order[3] = isset($_POST['fInicio']) ? $_POST['fInicio'] : "";
        $order[4] = isset($_POST['fTermino']) ? $_POST['fTermino'] : "";
        $order[5] = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        $order[6] = isset($_POST['function']) ? $_POST['function'] : "";
        $this->arrayUsers[0] = [$order[1], "texto_numero"];
        $this->arrayUsers[1] = [$order[2], "select_texto"];
        $this->arrayUsers[2] = [$order[3], "date"];
        $this->arrayUsers[3] = [$order[4], "date"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][4] == "completo") {
            $user = $this->sessionUser();
            $sql = "INSERT INTO date_laboral(experiencia, lugar, fecha_inicio, fecha_fin, id_cv)";
            $sql = $sql . " VALUES('{$order[1]}','{$order[2]}','{$order[3]}','{$order[4]}', '$user')";
            $this->data = $this->con->consultaSimple($sql);
        }
        return json_encode($response);
    }
    public function updataLaboral()
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['cargo']) ? $_POST['cargo'] : "";
        $order[2] = isset($_POST['lugar']) ? $_POST['lugar'] : "";
        $order[3] = isset($_POST['fInicio']) ? $_POST['fInicio'] : "";
        $order[4] = isset($_POST['fTermino']) ? $_POST['fTermino'] : "";
        $order[5] = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        $order[6] = isset($_POST['function']) ? $_POST['function'] : "";
        $this->arrayUsers[0] = [$order[1], "texto_numero"];
        $this->arrayUsers[1] = [$order[2], "select_texto"];
        $this->arrayUsers[2] = [$order[3], "date"];
        $this->arrayUsers[3] = [$order[4], "date"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][4] == "completo") {
            $sql = "update date_laboral set experiencia='{$order[1]}', lugar='{$order[2]}', fecha_inicio='{$order[3]}',";
            $sql = $sql . " fecha_fin='{$order[4]}' where id_experiencia={$order[5]}";
            $this->data = $this->con->consultaSimple($sql);
        }
        return json_encode($response);
    }
    public function buscarLaboral($valor)
    {
        $sql = "select id_experiencia, experiencia, lugar, fecha_inicio, fecha_fin from date_laboral where id_experiencia={$valor}";
        $this->data = $this->con->consultaRetorno($sql);
        $row = $this->data->fetch_array(MYSQLI_ASSOC);
        return json_encode($row);
    }
    /* alumnos */
    public function searchUsers()
    {
        $order=[];
        $response=[];$x=0;
        $option=""; $opnCurso="";
        $order[1] = isset($_POST['opciones']) ? $_POST['opciones'] : "";
        $order[2] = isset($_POST['bUserDni']) ? $_POST['bUserDni'] : "";
        $order[3] = isset($_POST['bUserName']) ? $_POST['bUserName'] : "";
        $order[4] = isset($_POST['bUserSurname']) ? $_POST['bUserSurname'] : "";
        $order[5] = isset($_POST['bUserMail']) ? $_POST['bUserMail'] : "";
        $order[6] = isset($_POST['bUserCellp']) ? $_POST['bUserCellp'] : "";
        $order[7] = isset($_POST['bUserCursos']) ? $_POST['bUserCursos'] : "";
        if($order[1]=="a1"){
            $option=" where alu.dni={$order[2]}";
        } elseif($order[1]=="a2"){
            $option=" where alu.nombres='{$order[3]}' and ap_paterno='{$order[4]}'";
        } elseif($order[1]=="a4"){
            $option=" where alu.correo='{$order[5]}'";
        } elseif($order[1]=="a5"){
            $option=" where alu.celular={$order[6]}";
        }
        if($order[1]=="a6" && $order[7]!=0){
            $opnCurso=" where cual.id_curso={$order[7]}";
        }elseif ($order[1]!="a6" && $order[7]!=0) {
            $opnCurso=" and cual.id_curso={$order[7]}";
        }
        $sql="select alu.dni, alu.nombres, alu.ap_paterno, alu.ap_materno, alu.correo, alu.celular, cu.titulo from alumnos alu inner join cursos_alumnos cual on alu.id_alumnos=cual.id_alumno join cursos cu on cu.id_cursos=cual.id_curso".$option.$opnCurso;
        $this->data=$this->con->consultaRetorno($sql);
        if ($this->data->num_rows > 0) {
            while ($row = $this->data->fetch_array(MYSQLI_NUM)) {
                $response['row'][$x][1]=$row[0];
                $response['row'][$x][2]=$row[1];
                $response['row'][$x][3]=$row[2];
                $response['row'][$x][4]=$row[3];
                $response['row'][$x][7]=$row[4];
                $response['row'][$x][8]=$row[5];
                $response['row'][$x][11]=$row[6];
                $x++;
            }
        } else{
            $response['row']=false;
        }      
        return json_encode($response);
    }
    /* Activar nuevo curso */
    public function newCourse()
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['curso_ac_titulo']) ? $_POST['curso_ac_titulo'] : "";
        $order[2] = isset($_POST['curso_ac_detalle']) ? $_POST['curso_ac_detalle'] : "";
        $order[3] = isset($_POST['curso_ac_Local']) ? $_POST['curso_ac_Local'] : "";
        $order[4] = isset($_POST['curso_ac_nivel1']) ? $_POST['curso_ac_nivel1'] : "";
        $order[5] = isset($_POST['curso_ac_link1']) ? $_POST['curso_ac_link1'] : "";
        $order[6] = isset($_POST['curso_ac_inicio1']) ? $_POST['curso_ac_inicio1'] : "";
        $order[7] = isset($_POST['curso_ac_termino1']) ? $_POST['curso_ac_termino1'] : "";
        $order[8] = isset($_POST['num_Temas']) ? $_POST['num_Temas'] : "";
        $order[9] = isset($_POST['curso_ac_Tema1']) ? $_POST['curso_ac_Tema1'] : "";
        $order[10] = isset($_POST['curso_ac_Tema2']) ? $_POST['curso_ac_Tema2'] : "";
        $order[11] = isset($_POST['curso_ac_Tema3']) ? $_POST['curso_ac_Tema3'] : "";
        $order[12] = isset($_POST['curso_ac_Tema4']) ? $_POST['curso_ac_Tema4'] : "";
        $order[13] = isset($_POST['curso_ac_Tema5']) ? $_POST['curso_ac_Tema5'] : "";
        $this->arrayUsers[0] = [$order[1], "texto_numero"];
        $this->arrayUsers[1] = [$order[2], "select_texto"];
        $this->arrayUsers[2] = [$order[3], "select_numero"];
        $this->arrayUsers[3] = [$order[4], "numero"];
        $this->arrayUsers[4] = [$order[5], "link"];
        $this->arrayUsers[5] = [$order[6], "date"];
        $this->arrayUsers[6] = [$order[7], "date"];
        $this->arrayUsers[7] = [$order[8], "select_numero"];
        $this->arrayUsers[8] = [$order[9], "select_numero"];
        $this->arrayUsers[9] = [$order[10], "select_null"];
        $this->arrayUsers[10] = [$order[11], "select_null"];
        $this->arrayUsers[11] = [$order[12], "select_null"];
        $this->arrayUsers[12] = [$order[13], "select_null"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][13] == "completo") {
            $sql="insert into cursos(titulo, descripcion, nivel, link, disponivilidad, fecha_inicio, fecha_fin, id_local)";
            $sql=$sql." values('{$order[1]}', '{$order[2]}', '{$order[4]}', '{$order[5]}', 'V',  '{$order[6]}', '{$order[7]}', '{$order[3]}')";
            $this->data = $this->con->consultaRetorno($sql);
            /* temas */
            if ($this->data) {
                $sql="select max(id_cursos) as curso from cursos";
                $this->data = $this->con->consultaRetorno($sql);
                $ultimo=$this->data->fetch_array(MYSQLI_NUM);
                $sql="insert into detalles_curso_cursos(id_curso, id_decurso)  values";                    
                for ($i=0; $i < $order[8]; $i++) {
                    if ($i>0) {
                        $sql=$sql.", ('{$ultimo[0]}','{$order[9+$i]}')";
                    }else {
                        $sql=$sql."('{$ultimo[0]}','{$order[9+$i]}')";
                    }
                }
                $this->data = $this->con->consultaRetorno($sql);
                $response['detalles'][$i]=$this->data;
            }
        }
        return json_encode($response);
    }
    public function updateCourse(int $code)
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['curso_ac_titulo']) ? $_POST['curso_ac_titulo'] : "";
        $order[2] = isset($_POST['curso_ac_detalle']) ? $_POST['curso_ac_detalle'] : "";
        $order[3] = isset($_POST['curso_ac_Local']) ? $_POST['curso_ac_Local'] : "";
        $order[4] = isset($_POST['curso_ac_nivel1']) ? $_POST['curso_ac_nivel1'] : "";
        $order[5] = isset($_POST['curso_ac_link1']) ? $_POST['curso_ac_link1'] : "";
        $order[6] = isset($_POST['curso_ac_inicio1']) ? $_POST['curso_ac_inicio1'] : "";
        $order[7] = isset($_POST['curso_ac_termino1']) ? $_POST['curso_ac_termino1'] : "";
        $order[8] = isset($_POST['num_Temas']) ? $_POST['num_Temas'] : "";
        $order[9] = isset($_POST['curso_ac_Tema1']) ? $_POST['curso_ac_Tema1'] : "";
        $order[10] = isset($_POST['curso_ac_Tema2']) ? $_POST['curso_ac_Tema2'] : "";
        $order[11] = isset($_POST['curso_ac_Tema3']) ? $_POST['curso_ac_Tema3'] : "";
        $order[12] = isset($_POST['curso_ac_Tema4']) ? $_POST['curso_ac_Tema4'] : "";
        $order[13] = isset($_POST['curso_ac_Tema5']) ? $_POST['curso_ac_Tema5'] : "";
        $this->arrayUsers[0] = [$order[1], "texto_numero"];
        $this->arrayUsers[1] = [$order[2], "select_texto"];
        $this->arrayUsers[2] = [$order[3], "select_numero"];
        $this->arrayUsers[3] = [$order[4], "numero"];
        $this->arrayUsers[4] = [$order[5], "link"];
        $this->arrayUsers[5] = [$order[6], "date"];
        $this->arrayUsers[6] = [$order[7], "date"];
        $this->arrayUsers[7] = [$order[8], "select_numero"];
        $this->arrayUsers[8] = [$order[9], "select_numero"];
        $this->arrayUsers[9] = [$order[10], "select_null"];
        $this->arrayUsers[10] = [$order[11], "select_null"];
        $this->arrayUsers[11] = [$order[12], "select_null"];
        $this->arrayUsers[12] = [$order[13], "select_null"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][13] == "completo") {
            $sql = "update cursos set titulo='{$order[1]}', descripcion='{$order[2]}', nivel='{$order[4]}', link='{$order[5]}',";
            $sql = $sql . " fecha_inicio='{$order[6]}', fecha_fin='{$order[7]}', id_local='{$order[3]}' where id_cursos={$code}";
            $this->data = $this->con->consultaSimple($sql);
            /* Temas principales */
            $sql = "select id_decurso from detalles_curso_cursos where id_curso={$code}";
            $this->data = $this->con->consultaRetorno($sql);
            $x=0; $temas=[];      
            while ($row=$this->data->fetch_array(MYSQLI_ASSOC)) {
                $temas[$x]=$row['id_decurso'];
              $x++;      
            }
            if ($order[8]>count($temas)) {
                if($order[8+$order[8]]!=0) {
                    $sql="insert into detalles_curso_cursos(id_curso, id_decurso ) values('{$code}','{$order[8+$order[8]]}')";                       
                    $this->con->consultaSimple($sql);
                }           
                $response['temas']=true;
            }else if($order[8]<=count($temas)){
                for ($i=0; $i < count($temas); $i++) {
                    if($order[9+$i]!=$temas[$i] && $order[9+$i]!=0) {
                        $sql="update detalles_curso_cursos set id_decurso='{$order[9+$i]}' where id_curso={$code} and id_decurso={$temas[$i]} limit 1";
                        $this->con->consultaSimple($sql);
                    }else if($order[9+$i]==0) { 
                        $sql="DELETE FROM detalles_curso_cursos WHERE id_curso={$code} and id_decurso={$temas[$i]} LIMIT 1";                       
                        $this->con->consultaSimple($sql);
                    }
                }
                $response['temas']=false;           
            }

        }
        return json_encode($response);
    }
    public function buscarCourse(string $valor)
    {
        $response = [];
        $this->arrayUsers[0] = [$valor, "texto_numero"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][1]=="completo") {
            $sql = "select * from cursos where titulo='{$valor}'";
            $this->data = $this->con->consultaRetorno($sql);
            $response['row'] = $this->data->fetch_array(MYSQLI_ASSOC);
            /* Temas principales */
            $sql = "select id_decurso from detalles_curso_cursos where id_curso={$response['row']['id_cursos']}";
            $this->data = $this->con->consultaRetorno($sql);
            $i=0;      
            while ($row=$this->data->fetch_array(MYSQLI_ASSOC)) {
                $response['rowDetail'][$i]=$row['id_decurso'];
              $i++;      
            }        
        }
        return json_encode($response);
    }
    public function availabilityCourse(int $code, string $action)
    {
        $sql="";        
        if ($action=="courseActive") {
            $sql="update cursos set disponivilidad='V' where id_cursos='{$code}'";
        }else {
            $sql="update cursos set disponivilidad='F' where id_cursos='{$code}'";
        }
        $this->con->consultaSimple($sql);
    }
    /* datos evaluaciones */
    public function newEvaluacion()
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['evaluacion_curso']) ? $_POST['evaluacion_curso'] : "";
        $order[2] = isset($_POST['evaluacion_titulo']) ? $_POST['evaluacion_titulo'] : "";
        $order[3] = isset($_POST['evaluacion_descripcion']) ? $_POST['evaluacion_descripcion'] : "";
        $order[4] = isset($_POST['evaluacion_estado']) ? $_POST['evaluacion_estado'] : "";
        $order[5] = isset($_POST['evaluacion_rango']) ? $_POST['evaluacion_rango'] : "";
        $order[6] = isset($_POST['evaluacion_fecha']) ? $_POST['evaluacion_fecha'] : "";
        $this->arrayUsers[0] = [$order[1], "select_numero"];
        $this->arrayUsers[1] = [$order[2], "texto"];
        $this->arrayUsers[2] = [$order[3], "select_texto"];
        $this->arrayUsers[3] = [$order[4], "select_texto"];
        $this->arrayUsers[4] = [$order[5], "select_numero"];
        $this->arrayUsers[5] = [$order[6], "date"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][6] == "completo") {
            $sql = "INSERT INTO evaluaciones(fecha, titulo, descripcion, id_curso, id_rango, pendiente)";
            $sql = $sql . " VALUES('{$order[6]}','{$order[2]}','{$order[3]}','{$order[1]}', '{$order[5]}', '{$order[4]}')";
            $this->data = $this->con->consultaSimple($sql);
        }
        return json_encode($response);
    }
    public function updataEvaluacion(int $valor)
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['evaluacion_curso']) ? $_POST['evaluacion_curso'] : "";
        $order[2] = isset($_POST['evaluacion_titulo']) ? $_POST['evaluacion_titulo'] : "";
        $order[3] = isset($_POST['evaluacion_descripcion']) ? $_POST['evaluacion_descripcion'] : "";
        $order[4] = isset($_POST['evaluacion_estado']) ? $_POST['evaluacion_estado'] : "";
        $order[5] = isset($_POST['evaluacion_rango']) ? $_POST['evaluacion_rango'] : "";
        $order[6] = isset($_POST['evaluacion_fecha']) ? $_POST['evaluacion_fecha'] : "";
        $order[7] = $valor;
        $this->arrayUsers[0] = [$order[1], "select_numero"];
        $this->arrayUsers[1] = [$order[2], "texto"];
        $this->arrayUsers[2] = [$order[3], "select_texto"];
        $this->arrayUsers[3] = [$order[4], "select_texto"];
        $this->arrayUsers[4] = [$order[5], "select_numero"];
        $this->arrayUsers[5] = [$order[6], "date"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][6] == "completo") {
            $sql="update evaluaciones set fecha='{$order[6]}', titulo='{$order[2]}', descripcion='{$order[3]}', id_curso='{$order[1]}', id_rango='{$order[5]}', pendiente='{$order[4]}' where id_nota={$order[7]}";
            $this->data = $this->con->consultaSimple($sql);
        }
        return json_encode($response);

    }
    public function buscarEvaluaciones(int $valor1, string $valor2)
    {
        $order = [];
        $response = [];
        $order[1] = $valor1;
        $order[2] = $valor1;
        $this->arrayUsers[0] = [$order[1], "numero"];
        $this->arrayUsers[1] = [$order[2], "select_texto"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][2]=="completo") {
            $sql = "select * from evaluaciones where id_curso='{$valor1}' and titulo='{$valor2}'";
            $this->data = $this->con->consultaRetorno($sql);
            $response['row'] = $this->data->fetch_array(MYSQLI_ASSOC);
        }
        return json_encode($response);
    }
    /* Notas */
    public function newStudentsReview()
    {
        $order = [];
        $order['items'][0] = isset($_POST['review']) ? $_POST['review'] : "";
        $order['items'][1] = isset($_POST['number']) ? $_POST['number'] : "";
        $order['items'][2] = date('Y-m-d');
        $sql="insert into evaluaciones_alumnos(id_nota, id_alumno, nota_numero, resena, fecha_nota) values";
        for ($i=0; $i < $order['items'][1]; $i++) { 
            $order['review'][$i][1] = isset($_POST['alumno'.$i]) ? $_POST['alumno'.$i] : "";
            $order['review'][$i][2] = isset($_POST['nota'.$i]) ? $_POST['nota'.$i] : "";
            $order['review'][$i][3] = isset($_POST['reseña'.$i]) ? $_POST['reseña'.$i] : "";
            if ($i==0) {
                $sql=$sql."('{$order['items'][0]}', '{$order['review'][$i][1]}', '{$order['review'][$i][2]}', '{$order['review'][$i][3]}', '{$order['items'][2]}')";
            } else {
                $sql=$sql.", ('{$order['items'][0]}', '{$order['review'][$i][1]}', '{$order['review'][$i][2]}', '{$order['review'][$i][3]}', '{$order['items'][2]}')";
            }            
        }
        $this->con->consultaSimple($sql);
        /* poner completo a las evaluaciones */
        $sql="update evaluaciones set pendiente='F' where id_nota='{$order['items'][0]}' limit 1";
        $this->con->consultaSimple($sql);
    }
    public function updataReview(int $test, int $student)
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['nota']) ? $_POST['nota'] : "";
        $order[2] = isset($_POST['reseña']) ? $_POST['reseña'] : "";
        $this->arrayUsers[0] = [$test, "numero"];
        $this->arrayUsers[1] = [$order[1], "numero"];
        $this->arrayUsers[2] = [$order[2], "select_texto"];
        $this->arrayUsers[3] = [$student, "numero"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][4]=="completo") {
            $sql="update evaluaciones_alumnos set nota_numero='{$order[1]}', resena='{$order[2]}' where id_nota={$test} and id_alumno={$student}";
            $response['repuesta'] = $this->con->consultaRetorno($sql);
        }
        return json_encode($response);
    }
    public function buscarTest(int $test, int $student)
    {
        $order = [];
        $response = [];
        $order[1] = isset($_POST['nota']) ? $_POST['nota'] : "";
        $order[2] = isset($_POST['reseña']) ? $_POST['reseña'] : "";
        $this->arrayUsers[0] = [$test, "numero"];
        $this->arrayUsers[1] = [$student, "numero"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][2]=="completo") {
            $sql="select * from evaluaciones_alumnos where id_nota={$test} and id_alumno={$student}";
             $this->data = $this->con->consultaRetorno($sql);
             $response['response'] = $this->data->fetch_array(MYSQLI_NUM);
        }
        return json_encode($response);
    }
    public function buscarStudentsXTest(int $var)
    {
        $response = [];
        $this->arrayUsers[0] = [$var, "numero"];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][1]=="completo") {
            $sql="select alm.id_alumnos, alm.nombres, alm.ap_paterno, alm.ap_materno from evaluaciones as test";
            $sql = $sql." join cursos_alumnos as clm on clm.id_curso=test.id_curso join alumnos as alm on alm.id_alumnos=clm.id_alumno";
            $sql = $sql." where test.id_nota={$var}";
            $this->data = $this->con->consultaRetorno($sql);
            $i=0;      
            while ($row=$this->data->fetch_array(MYSQLI_ASSOC)) {
                $response['row'][$i][1]=$row['id_alumnos'];
                $response['row'][$i][2]=$row['nombres'];
                $response['row'][$i][3]=$row['ap_paterno'];
                $response['row'][$i][4]=$row['ap_materno'];
              $i++;      
            }        
        }
        return json_encode($response);
    }    
    /* borrar datos del docente */
    public function deleteDataMt()
    {
        $code = isset($_POST['socialCode']) ? $_POST['socialCode'] : "";
        $table = isset($_POST['table']) ? $_POST['table'] : "";
        $sql = "";
        if ($table == "social") {
            $sql = "DELETE FROM redes_sociales WHERE id_rsocial={$code} LIMIT 1";
        } elseif ($table == "cursos") {
            $sql = "DELETE FROM date_cursos WHERE id_dcurso={$code} LIMIT 1";
        } elseif ($table == "laboral") {
            $sql = "DELETE FROM date_laboral WHERE id_experiencia={$code} LIMIT 1";
        }
        $this->con->consultaSimple($sql);
    }
    /* borrar datos con el administrador */
    public function deleteDataAdm(int $code , string $table)
    {
        $sql = "";
        $response = [];
        if($table == "deleteTest"){
            $sql = "select count(nota_numero) from evaluaciones_alumnos where id_nota={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $y=$this->data->fetch_array(MYSQLI_NUM);
            if ($y[0]==0) {
                $sql = "DELETE FROM evaluaciones WHERE id_nota={$code} LIMIT 1";
                $this->con->consultaSimple($sql);              
                $response['valid'] = false;
            }else {
                $response['valid'] = true;
            }
        }else if($table == "deleteSchool"){
            $sql = "select count(titulo) from cursos where id_local={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $y=$this->data->fetch_array(MYSQLI_NUM);
            if ($y[0]==0) {
                $sql = "DELETE FROM institutos WHERE id_local={$code} LIMIT 1";
                $this->con->consultaSimple($sql);              
                $response['valid'] = false;
            }else {
                $response['valid'] = true;
            }
        }else if($table == "deleteTeme"){
            $sql = "SELECT count(id_curso) FROM detalles_curso_cursos WHERE id_decurso={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $y=$this->data->fetch_array(MYSQLI_NUM);
            if ($y[0]==0) {
                $sql = "DELETE FROM detalle_curso WHERE id_decurso={$code} LIMIT 1";
                $this->con->consultaSimple($sql);              
                $response['valid'] = false;
            }else {
                $response['valid'] = true;
            }
        }else if($table == "deleteCurse"){
            /* students */
            $sql = "SELECT count(id_alumno) FROM cursos_alumnos WHERE id_curso={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $students=$this->data->fetch_array(MYSQLI_NUM);
            /* temes */
            $sql = "SELECT count(id_decurso) FROM detalles_curso_cursos WHERE id_curso={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $temes=$this->data->fetch_array(MYSQLI_NUM);
            /* test */
            $sql = "select count(titulo) from evaluaciones where id_curso={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $test=$this->data->fetch_array(MYSQLI_NUM);
            if ($students[0]==0 && $temes[0]==0 && $test[0]==0) {
                $sql = "DELETE FROM cursos WHERE id_cursos={$code} LIMIT 1";
                $this->con->consultaSimple($sql);             
                $response['valid'] = false;
            }else {
                $response['valid'] = true;
                $response['section'][1] = $students[0];
                $response['section'][2] = $temes[0];
                $response['section'][3] = $test[0];
            }
        }else if($table == "deleteStudent"){
            /* cursos */
            $sql = "SELECT count(id_curso) FROM cursos_alumnos WHERE id_alumno={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $curse=$this->data->fetch_array(MYSQLI_NUM);
            /* test */
            $sql = "select count(nota_numero) from evaluaciones_alumnos where id_alumno={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $test=$this->data->fetch_array(MYSQLI_NUM);
            /* mail */
            $sql = "select id_correo from segurityalumn where id_alumno={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $mail=$this->data->fetch_array(MYSQLI_NUM);
            if ($curse[0]==0 && $test[0]==0) {
                if ($mail[0]!="" || $mail[0]!=null) {
                    /* conexion */
                    $sql = "DELETE FROM segurityalumn WHERE id_alumno={$code} LIMIT 1";
                    $this->con->consultaSimple($sql);             
    
                    /* mail pass */
                    $sql = "DELETE FROM correo_ingreso WHERE id_correo={$code} LIMIT 1";
                    $this->con->consultaSimple($sql);             
                }
                /* students */
                $sql = "DELETE FROM alumnos WHERE id_alumnos={$code} LIMIT 1";
                $this->con->consultaSimple($sql);             
                $response['valid'] = false;
            }else {
                $response['valid'] = true;
                $response['section'][1] = $curse[0];
                $response['section'][3] = $test[0];
            }
        }
        return json_encode($response);
    }
    /* Vaciar secciones con el administrador */
    public function emptyDataAdm(int $code, string $table)
    {
        $sql = "";
        $response = [];
        if($table == "emptyTest"){
            $sql = "select count(nota_numero) from evaluaciones_alumnos where id_nota={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $y=$this->data->fetch_array(MYSQLI_NUM);
            if ($y[0]==0) {
                $response['valid'] = false;
            }else {
                $sql = "DELETE FROM evaluaciones_alumnos WHERE id_nota={$code}";
                $this->con->consultaSimple($sql);
                $sql = "UPDATE evaluaciones SET pendiente='v' WHERE id_nota={$code}";
                $this->con->consultaSimple($sql);
                $response['valid'] = true;
            }
        }else if($table == "emptyTemes"){
            $sql = "SELECT count(id_curso) FROM detalles_curso_cursos WHERE id_curso={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $y=$this->data->fetch_array(MYSQLI_NUM);
            if ($y[0]==0) {
                $response['valid'] = false;
            }else {
                $sql = "DELETE FROM detalles_curso_cursos WHERE id_curso={$code}";
                $this->con->consultaSimple($sql);              
                $response['valid'] = true;
            }
        }else if($table == "emptyCurse"){
            /* students */
            $sql = "SELECT count(id_alumno) FROM cursos_alumnos WHERE id_curso={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $students=$this->data->fetch_array(MYSQLI_NUM);
            /* test */
            $sql = "select count(titulo) from evaluaciones where id_curso={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $test=$this->data->fetch_array(MYSQLI_NUM);
            if ($students[0]==0 || $test[0]>0) {
                $response['valid'] = false;
            }else {              
                /* students curse */
                $sql = "DELETE FROM cursos_alumnos WHERE id_curso={$code}";
                $this->con->consultaSimple($sql);
                $response['valid'] = true;
            }
        }else if($table == "emptyTestStudent"){
            $sql = "select count(nota_numero) from evaluaciones_alumnos where id_alumno={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $y=$this->data->fetch_array(MYSQLI_NUM);
            if ($y[0]==0) {
                $response['valid'] = false;
            }else {
                $sql = "DELETE FROM evaluaciones_alumnos WHERE id_alumno={$code}";
                $this->con->consultaSimple($sql);
                $response['valid'] = true;
            }
        }else if($table == "emptyCurseStudent"){
            /* cursos */
            $sql = "select count(id_curso) from cursos_alumnos where id_alumno={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $y=$this->data->fetch_array(MYSQLI_NUM);
            /* test */
            $sql = "select count(nota_numero) from evaluaciones_alumnos where id_alumno={$code}";
            $this->data=$this->con->consultaRetorno($sql);
            $test=$this->data->fetch_array(MYSQLI_NUM);
            if ($y[0]==0 || $test[0]==0) {
                $sql = "DELETE FROM cursos_alumnos WHERE id_alumno={$code}";
                $this->con->consultaSimple($sql);
                $response['valid'] = true;
            }else {
                $response['valid'] = false;
            }
        }
        return json_encode($response);
    }
    /* buscar session user */
    private function sessionUser()
    {
        $sql = "select id_cv from cv_docente where DNI={$this->session[0]}";
        $this->data = $this->con->consultaRetorno($sql);
        $row = $this->data->fetch_array(MYSQLI_ASSOC);
        return $row['id_cv'];
    }
}

/* Verificacion de funciones */
if ($_POST['function'] == "editMister") {
    /* datos mister */
    $classMister = new userAdmin();
    echo $classMister->editData();
} else if ($_POST['function'] == "Admin") {
    $classMister = new userAdmin();
    echo $classMister->updataPassqord($_POST["userAdmin"]);
} else if ($_POST['function'] == "socialNuevo") {
    /* redes sociales mister */
    $classMister = new userAdmin();
    echo $classMister->newSocial();
} else if ($_POST['function'] == "socialEditar") {
    $classMister = new userAdmin();
    echo $classMister->updataSocial();
} else if ($_POST['function'] == "socialB") {
    $classMister = new userAdmin();
    echo $classMister->buscarSocial($_POST['socialBuscar']);
} else if ($_POST['function'] == "cursoNuevo") {
    /* Cursos mister */
    $classMister = new userAdmin();
    echo $classMister->newCurso();
} else if ($_POST['function'] == "cursoEditar") {
    $classMister = new userAdmin();
    echo $classMister->updataCurso();
} else if ($_POST['function'] == "cursosB") {
    $classMister = new userAdmin();
    echo $classMister->buscarCurso($_POST['cursoBuscar']);
} else if ($_POST['function'] == "laboralNuevo") {
    /* Laboral mister */
    $classMister = new userAdmin();
    echo $classMister->newLaboral();
} else if ($_POST['function'] == "laboralEditar") {
    $classMister = new userAdmin();
    echo $classMister->updataLaboral();
} else if ($_POST['function'] == "laboralB") {
    $classMister = new userAdmin();
    echo $classMister->buscarLaboral($_POST['laboralBuscar']);
} else if ($_POST['function'] == "searchStudent") {
    /* alumnos */    
    $classMister = new userAdmin();
    echo $classMister->searchUsers();
} else if ($_POST['function'] == "courseNew") {
    /* activar nuevo curso */    
    $classMister = new userAdmin();
    echo $classMister->newCourse();
} else if ($_POST['function'] == "courseEdit") {
    $classMister = new userAdmin();
    echo $classMister->updateCourse($_POST['curso_code']);
} else if ($_POST['function'] == "courseB") {
    $classMister = new userAdmin();
    echo $classMister->buscarCourse($_POST['courseBuscar']);
} else if ($_POST['function'] == "courseActive" || $_POST['function'] == "courseDisabled") {
    $classMister = new userAdmin();
    echo $classMister->availabilityCourse($_POST['courseCode'], $_POST['function']);
} else if ($_POST['function'] == "testNew") {
    /* Evaluaciones */
    $classMister = new userAdmin();
    echo $classMister->newEvaluacion();
} else if ($_POST['function'] == "testEdit") {
    $classMister = new userAdmin();
    echo $classMister->updataEvaluacion($_POST['test_code']);
} else if ($_POST['function'] == "testB") {
    $classMister = new userAdmin();
    echo $classMister->buscarEvaluaciones($_POST['testCursoBuscar'], $_POST['TestTitleBuscar']);
} else if ($_POST['function'] == "reviewNew") {
    /* Notas */
    $classMister = new userAdmin();
    echo $classMister->newStudentsReview();
} else if ($_POST['function'] == "reviewEdit") {
    $classMister = new userAdmin();
    echo $classMister->updataReview($_POST['review'], $_POST['alumno']);
} else if ($_POST['function'] == "reviewBTest") {
    $classMister = new userAdmin();
    echo $classMister->buscarTest($_POST['review'], $_POST['alumno']);
} else if ($_POST['function'] == "reviewB") {
    $classMister = new userAdmin();
    echo $classMister->buscarStudentsXTest($_POST['reviewBuscar']);
} else if ($_POST['function'] == "misterDataDt") {
    $classMister = new userAdmin();
    echo $classMister->deleteDataMt();
} else if ($_POST['function'] == "adminDelete") {
    $classMister = new userAdmin();
    echo $classMister->deleteDataAdm($_POST['valCode'], $_POST['table']);
} else if ($_POST['function'] == "adminEmpty") {
    $classMister = new userAdmin();
    echo $classMister->emptyDataAdm($_POST['valCode'], $_POST['table']);
}
