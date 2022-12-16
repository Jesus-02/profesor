<?php

namespace register;

require_once "conexion.php";

use models\conexion;

require_once "validacion_datos.php";

use register\validation;

class registrar
{
    private $con; /*  conexion  */
    private $data; /*  consulta privada */
    private $arrayUsers = []; /* validacion de datos */
    public function __construct()
    {
        $this->con = new conexion();
    }
    public function login()
    {
        $respuesta = [];
        $user = isset($_POST['session']) ? $_POST['session'] : "";
        /* students */
        $sql1 = "SELECT id_alumnos, dni FROM alumnos WHERE dni={$user}";
        $consult = $this->con->consultaRetorno($sql1);
        $row1 = mysqli_fetch_assoc($consult);
        /* mister */
        $sql2 = "SELECT id_cv, DNI FROM cv_docente WHERE DNI={$user}";
        $consult2 = $this->con->consultaRetorno($sql2);
        $row2 = mysqli_fetch_assoc($consult2);
        if ($row1) {
            $respuesta[1] = true;
            $respuesta[2] = $row1['id_alumnos'];
            $respuesta[3] = $row1['dni'];
            $sql3 = "SELECT id_correo FROM segurityalumn WHERE id_alumno={$respuesta[2]}";
            $segurityTable = $this->con->consultaRetorno($sql3);
            $row3 = mysqli_fetch_assoc($segurityTable);
            session_start();
            $_SESSION['user'] = $respuesta[3];
            $_SESSION['type'] = "alumno";
            if ($row3) {
                $respuesta[4] = true;
            } else {
                $respuesta[4] = false;
            }
        } else if ($row2) {
            $respuesta[1] = true;
            $respuesta[2] = $row2['id_cv'];
            $respuesta[3] = $row2['DNI'];
            $sql3 = "SELECT id_correo FROM seguritymister WHERE id_cv={$respuesta[2]}";
            $segurityTable = $this->con->consultaRetorno($sql3);
            $row3 = mysqli_fetch_assoc($segurityTable);
            session_start();
            $_SESSION['user'] = $respuesta[3];
            $_SESSION['type'] = "mister";
            $respuesta[4] = true;
        } else {
            $respuesta[1] = false;
        }
        return json_encode($respuesta);
    }
    public function passUser()
    {
        session_start();
        $alumno1 = $_SESSION['user'];
        $type = $_SESSION['type'];
        $respuesta = [];
        $user = isset($_POST['log_r1pass']) ? $_POST['log_r1pass'] : "";
        if ($type == "alumno") {
            $sql1 = "select ci.pass01 from alumnos as a join segurityAlumn as sa on a.id_alumnos=sa.id_alumno join correo_ingreso as ci on ci.id_correo=sa.id_correo where a.dni='{$alumno1}';";
        } elseif ($type == "mister") {
            $sql1 = "SELECT ci.pass01 FROM cv_docente AS cd JOIN seguritymister AS sm ON cd.id_cv=sm.id_cv JOIN correo_ingreso AS ci ON ci.id_correo=sm.id_correo where cd.DNI='{$alumno1}';";
        }
        $consult = $this->con->consultaRetorno($sql1);
        $row1 = mysqli_fetch_assoc($consult);
        if (password_verify($user, $row1['pass01'])) {
            $respuesta['error'] = true;
            $respuesta['usuario'] = $type;
        } else {
            $respuesta['error'] = false;
        }

        return json_encode($respuesta);
    }
    public function closeSesion()
    {
        session_start();
        session_destroy();
    }
    /* registrar */
    public function alumnos()
    {
        $respuesta = [];
        $alumn = [];
        $alumn['dni1'] = isset($_POST['user_r1Dni']) ? $_POST['user_r1Dni'] : "";
        $alumn['names'] = isset($_POST['user_r1name']) ? $_POST['user_r1name'] : "";
        $alumn['namep'] = isset($_POST['user_r1surNameP']) ? $_POST['user_r1surNameP'] : "";
        $alumn['namem'] = isset($_POST['user_r1surNameM']) ? $_POST['user_r1surNameM'] : "";
        $alumn['genero'] = isset($_POST['user_r1genero1']) ? $_POST['user_r1genero1'] : "";
        $alumn['edad'] = isset($_POST['user_r1edad']) ? $_POST['user_r1edad'] : "";
        $alumn['email'] = isset($_POST['user_r1correo']) ? $_POST['user_r1correo'] : "";
        $alumn['cellpone'] = isset($_POST['user_r1cellPhone1']) ? $_POST['user_r1cellPhone1'] : "";
        $alumn['curso'] = isset($_POST['user_r1curso1']) ? $_POST['user_r1curso1'] : "";
        $alumn['terminos'] = isset($_POST['user_r1terminos1']) ? $_POST['user_r1terminos1'] : "";
        $alumn['dateRegist'] = date('Y-m-d');
        $this->arrayUsers[0] = [$alumn['dni1'], 'telefono'];
        $this->arrayUsers[1] = [$alumn['names'], 'texto'];
        $this->arrayUsers[2] = [$alumn['namep'], 'texto'];
        $this->arrayUsers[3] = [$alumn['namem'], 'texto'];
        $this->arrayUsers[4] = [$alumn['genero'], 'select_genero'];
        $this->arrayUsers[5] = [$alumn['edad'], 'presio_decimal'];
        $this->arrayUsers[6] = [$alumn['email'], 'correo'];
        $this->arrayUsers[7] = [$alumn['cellpone'], 'celular'];
        $this->arrayUsers[8] = [$alumn['curso'], 'select_numero'];
        $this->arrayUsers[9] = [$alumn['terminos'], 'bolean'];
        $validation = new validation();
        $respuesta['validacion'] = $validation->value_date($this->arrayUsers);
        $count = $this->contarAlumnos() + 1; /* contar alumnos para id */
        /* insertar datos persolales */
        if ($respuesta['validacion'][10] == 'validar') {
            $respuesta['validacion'];
        } else if ($respuesta['validacion'][10] == 'completo') {
            $sql1 = "INSERT INTO alumnos(dni, nombres, ap_paterno, ap_materno, genero, edad, correo, celular, fecha_registro)";
            $sql1 = $sql1 . " VALUES('{$alumn['dni1']}', '{$alumn['names']}', '{$alumn['namep']}', '{$alumn['namem']}', '{$alumn['genero']}', '{$alumn['edad']}', '{$alumn['email']}', '{$alumn['cellpone']}', '{$alumn['dateRegist']}' )";
            $this->data = $this->con->consultaRetorno($sql1);
            /* Insertar contraseña */
            if ($this->data) {
                $encript = password_hash($alumn['dni1'], PASSWORD_DEFAULT, ['cost' => 5]);
                $sql3 = "INSERT INTO correo_ingreso(pass01) VALUES('$encript')";
                $this->data = $this->con->consultaRetorno($sql3);
                $countPass = $this->contarPass();
                $sql4 = "INSERT INTO segurityAlumn(id_alumno, id_correo) values('$count','$countPass')";
                $this->data = $this->con->consultaRetorno($sql4);
            }
        }
        /* Insertar conexion a curso */
        if (!$this->data && $respuesta['validacion'][10] == 'completo') {
            $respuesta['error'] = 'contar alumnos: ' . $this->data->connect_error;
        } else if ($this->data && $respuesta['validacion'][10] == 'completo') {
            $sql2 = "INSERT INTO cursos_alumnos (id_curso, id_alumno) VALUES ('{$alumn['curso']}', '$count')";
            $this->con->consultaRetorno($sql2);
            $respuesta['error'] = '0 errores, Alumno enlasado';
            session_start();
            $_SESSION['user'] = $alumn['dni1'];
            $_SESSION['type'] = "alumno";
        } else {
            $respuesta['error'] = 'Enlace no registrado ';
        }
        /* Respuesta */
        return json_encode($respuesta);
    }
    /* funciones requeridas */
    private function contarAlumnos()
    {
        $sql = "SELECT count(id_alumnos) AS 'users' FROM alumnos";
        $datosConsult = $this->con->consultaRetorno($sql);
        $row = mysqli_fetch_assoc($datosConsult);
        return $row['users'];
    }
    private function contarPass()
    {
        $sql = "SELECT count(id_correo) AS 'pass' FROM correo_ingreso";
        $datosConsult = $this->con->consultaRetorno($sql);
        $row = mysqli_fetch_assoc($datosConsult);
        return $row['pass'];
    }
}
/* funcion a operar */
if ($_POST['function'] == "registerAlum") {
    $register1 = new registrar();
    echo $register1->alumnos();
} elseif ($_POST['function'] == "open") {
    $register1 = new registrar();
    echo $register1->login();
} elseif ($_POST['function'] == "close") {
    $register1 = new registrar();
    echo $register1->closeSesion();
} elseif ($_POST['function'] == "ingresar") {
    $register1 = new registrar();
    echo $register1->passUser();
}
// $register1 = new registrar();
// echo $register1->contarPass();
