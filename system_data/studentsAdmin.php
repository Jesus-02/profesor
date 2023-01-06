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
        $response=[];
        $this->arrayUsers[0]=[$valor,"telefono"];
        $response['test']=$this->validate->value_date($this->arrayUsers);
        if ($response['test'][1]=="completo") {
            $sql="select * from alumnos as aln join cursos_alumnos as csal on aln.id_alumnos=csal.id_alumno where aln.dni={$valor} order by aln.fecha_registro desc";
            $this->data = $this->con->consultaRetorno($sql);
            $response['row'] = $this->data->fetch_array(MYSQLI_ASSOC);
        }
        return json_encode($response);
    }
        
}

if ($_POST['function']=="studentB") {
    $classAlum= new estudentAdmin();
    echo $classAlum->search($_POST['studentBuscar']);
}else if ($_POST['function']=="editStudent") {
    $classAlum= new estudentAdmin();
    echo $classAlum->updateStudent();
}
    
// $valor = $classAlum->search("11111111");
// print_r($valor);
?>