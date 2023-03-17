<?php namespace userAdmin;
require_once "conexion.php";
require_once "validacion_datos.php";
use models\conexion;
use register\validation;
class estudentAdmin{
    private $con; /* conexion */
    private $session=[]; /* session */
    private $data; /*  consulta privada */
    private $validate; /* class requery */
    private $arrayUsers=[]; /* validacion de datos */

    public function __construct(){
        $this->con = new conexion();
        $this->validate = new validation();
        session_start();
        $this->session=[$_SESSION['user'], $_SESSION['type']];
    }

    public function editData(int $code){
        $order = [];
        $response = [];
        $order['name'] = isset($_POST['alumno_dp_name1']) ? $_POST['alumno_dp_name1'] : "";
        $order['surNameP'] = isset($_POST['alumno_dp_surName1']) ? $_POST['alumno_dp_surName1'] : "";
        $order['surNameM'] = isset($_POST['alumno_dp_surName2']) ? $_POST['alumno_dp_surName2'] : "";
        $order['gender'] = isset($_POST['alumno_dp_genero1']) ? $_POST['alumno_dp_genero1'] : "";
        $order['years'] = isset($_POST['alumno_dp_edad']) ? $_POST['alumno_dp_edad'] : "";
        $order['mail'] = isset($_POST['alumno_dp_correo1']) ? $_POST['alumno_dp_correo1'] : "";
        $order['cellphone'] = isset($_POST['alumno_dp_cellphone1']) ? $_POST['alumno_dp_cellphone1'] : "";
        $this->arrayUsers[0] = [$code, 'telefono'];
        $this->arrayUsers[1] = [$order['name'], 'texto'];
        $this->arrayUsers[2] = [$order['surNameP'], 'texto'];
        $this->arrayUsers[3] = [$order['surNameM'], 'texto'];
        $this->arrayUsers[4] = [$order['gender'], 'select_genero'];
        $this->arrayUsers[5] = [$order['years'], 'presio_decimal'];
        $this->arrayUsers[6] = [$order['mail'], 'correo'];
        $this->arrayUsers[7] = [$order['cellphone'], 'celular'];
        $response['test'] = $this->validate->value_date($this->arrayUsers);
        if ($response['test'][8] == "validar") {
            $response['test'];
        } else {
            $sql = "UPDATE alumnos SET nombres='{$order['name']}', ap_paterno = '{$order['surNameP']}', ap_materno = '{$order['surNameM']}', genero = '{$order['gender']}', edad = '{$order['years']}', correo = '{$order['mail']}', celular = '{$order['cellphone']}' WHERE dni = {$this->session[0]}";
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
            $sql = "SELECT dt.id_alumnos, ci.id_correo, ci.pass01 FROM alumnos AS dt JOIN segurityalumn AS sm ON dt.id_alumnos=sm.id_alumno JOIN correo_ingreso AS ci ON ci.id_correo=sm.id_correo WHERE dni={$user}";
            $this->data=$this->con->consultaRetorno($sql);
            if ($this->data->num_rows > 0) {
                $row = $this->data->fetch_array(MYSQLI_NUM);
                if (password_verify($order[1], $row[2])) {
                    $encript = password_hash($order[2], PASSWORD_DEFAULT, ['cost' => 5]);
                    $sql="UPDATE correo_ingreso SET pass01='{$encript}' WHERE id_correo={$row[1]}";
                    $this->con->consultaSimple($sql);
                }else{
                    $response['segurity']="password";
                }
            }else {
                /* password correo */
                $encript = password_hash($order[2], PASSWORD_DEFAULT, ['cost' => 5]);
                $sql3 = "INSERT INTO correo_ingreso(pass01) VALUES('$encript')";
                $this->data = $this->con->consultaRetorno($sql3);
                $correo=$this->data;
                /* buscar code de usuario */
                $sql = "select id_alumnos from alumnos as aln join cursos_alumnos as csal on aln.id_alumnos=csal.id_alumno where aln.dni={$user}";
                $this->data = $this->con->consultaRetorno($sql);
                $dataUser = $this->data->fetch_array(MYSQLI_NUM);
                $codeUser = $dataUser[0];
                /* conexion password */
                $countPass = $this->contarPass();
                $sql4 = "INSERT INTO segurityAlumn(id_alumno, id_correo) values('$codeUser','$countPass')";
                $this->data = $this->con->consultaRetorno($sql4);
                $segurity=$this->data;
                if ($correo==false || $segurity==false) {
                    $response['segurity']="newPassword";
                }
            }
        }
        return json_encode($response);
    }

    public function updateStudent(){
        $order=[]; 
        $response=[];
        $order['identidad'] = isset($_POST['dni']) ? $_POST['dni'] : "";        
        $order['name2'] = isset($_POST['names']) ? $_POST['names'] : "";        
        $order['surNameP'] = isset($_POST['surNamef']) ? $_POST['surNamef'] : "";        
        $order['surNameM1'] = isset($_POST['surNameM']) ? $_POST['surNameM'] : "";        
        $order['genero1'] = isset($_POST['genero']) ? $_POST['genero'] : "";        
        $order['edad1'] = isset($_POST['edad']) ? $_POST['edad'] : "";        
        $order['correo'] = isset($_POST['mail']) ? $_POST['mail'] : "";        
        $order['cellphone1'] = isset($_POST['cellphone']) ? $_POST['cellphone'] : "";        
        $order['curso'] = isset($_POST['cursoCode']) ? $_POST['cursoCode'] : "";        
        $order['alumnoCode'] = isset($_POST['alumnoCode']) ? $_POST['alumnoCode'] : "";        
        $this->arrayUsers[0] = [$order['identidad'], 'telefono'];
        $this->arrayUsers[1] = [$order['name2'], 'texto'];
        $this->arrayUsers[2] = [$order['surNameP'], 'texto'];
        $this->arrayUsers[3] = [$order['surNameM1'], 'texto'];
        $this->arrayUsers[4] = [$order['genero1'], 'select_genero'];
        $this->arrayUsers[5] = [$order['edad1'], 'presio_decimal'];
        $this->arrayUsers[6] = [$order['correo'], 'correo'];
        $this->arrayUsers[7] = [$order['cellphone1'], 'celular'];
        $this->arrayUsers[8] = [$order['curso'], 'select_numero'];
        $response['test']=$this->validate->value_date($this->arrayUsers);
        
        /* test */
        $sql = "select count(nota_numero) from evaluaciones_alumnos where id_alumno={$order['alumnoCode']}";
        $this->data=$this->con->consultaRetorno($sql);
        $test=$this->data->fetch_array(MYSQLI_NUM);        
        
        if ($response['test'][9]=="completo" && $test[0]==0) {
            /* ordenar datos alumno */
            $sql="update alumnos set nombres='{$order['name2']}', ap_paterno='{$order['surNameP']}', ap_materno='{$order['surNameM1']}', genero='{$order['genero1']}',";
            $sql=$sql." edad='{$order['edad1']}', correo='{$order['correo']}', celular='{$order['cellphone1']}' where dni={$order['identidad']}";
            if($this->con->consultaRetorno($sql)){
                $sql="update cursos_alumnos set id_curso='{$order['curso']}' where id_alumno='{$order['alumnoCode']}' limit 1";
                $this->con->consultaRetorno($sql);
            }
        }else if($test[0]>0) {
            $response['test'][10]=true;
        }
        return json_encode($response);
    }

    public function search(int $valor){
        $responseSh=[];
        $this->arrayUsers[0]=[$valor,"telefono"];
        $responseSh['test']=$this->validate->value_date($this->arrayUsers);
        if ($responseSh['test'][1]=="completo") {
            $sql="select * from alumnos as aln join cursos_alumnos as csal on aln.id_alumnos=csal.id_alumno where aln.dni={$valor} order by aln.fecha_registro desc";
            $this->data = $this->con->consultaRetorno($sql);
            $responseSh['row'] = $this->data->fetch_array(MYSQLI_ASSOC);
        }
        return json_encode($responseSh);
    }
        /* funciones requeridas */
    private function contarPass()
    {
        $sql = "SELECT count(id_correo) AS 'pass' FROM correo_ingreso";
        $datosConsult = $this->con->consultaRetorno($sql);
        $row = mysqli_fetch_assoc($datosConsult);
        return $row['pass'];
    }        
}

if ($_POST['function']=="editStudentAdmin") {
    $classAlum= new estudentAdmin();
    echo $classAlum->editData($_POST['alumnoCode']);
}else if ($_POST['function']=="Admin") {
    $classAlum= new estudentAdmin();
    echo $classAlum->updataPassqord($_POST['userAdmin']);
}else if ($_POST['function']=="studentB") {
    $classAlum= new estudentAdmin();
    echo $classAlum->search($_POST['studentBuscar']);
}else if ($_POST['function']=="editStudent") {
    $classAlum= new estudentAdmin();
    echo $classAlum->updateStudent();
}

// $classAlum= new estudentAdmin();
// $valor = $classAlum->search(72333333);
// print_r($valor);
?>