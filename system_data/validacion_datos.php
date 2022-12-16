<?php namespace register;
class validation
{
  /* Validar datos */
  private function isValid($text){
    $pattern = "/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]+$/";
    return preg_match($pattern, $text);
  }
  public function value_date($valueArray) {
    $valor=[];
    // return $valueArray;
    for ($i = 0; $i <count($valueArray); $i++) {
      $date =$valueArray[$i][0];
      $n1 =$valueArray[$i][1];
      if ($n1=="texto") {
        if ($date==""  || $date=="undefinet"  || $this->isValid($date)!=true || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="texto2") {
        if ($date==""  || $date=="undefinet" || strlen($date)<3 || $this->isValid($date)!=true || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="texto_numero") {
        if ($date==""  || $date=="undefinet" || strpos($date,".") || strpos($date,"<") || strpos($date,">") || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="numero") {
        if ($date=="" || $date==0  || $date=="undefinet" || $this->isValid($date) || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="texto_numero_indispensable") {
        if ($date=="" || $date==0 || $date=="undefinet" || strpos($date,".") || strpos($date,"<") || strpos($date,">") || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="presio_entero") {
        if ($date=="" || $date==0  || $date=="undefinet" || $date>9999 || $this->isValid($date) || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="numero_entero_null") {
        if ($date=="" || $date=="undefinet" || $date>9999 || $this->isValid($date) || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="decimal_3") {
        if ($date==""  || $date=="undefinet" || $date>999 || $this->isValid($date) || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="presio_decimal") {
        if ($date==""  || $date=="undefinet" || $date>99 || $this->isValid($date) || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="porcentaje") {
        if ($date==""  || $date=="undefinet" || $date>100 || $this->isValid($date) || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="select_null") {
        if (strpos($date,"http://") || strpos($date,"<") || strpos($date,">")) {
          $valor[$i]=1;
        }
      }else if ($n1=="select_texto") {
        if ($date=="" || $date=="undefinet"  || strpos($date,"<") || strpos($date,">") || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="select_numero") {
        if ($date=="" || $date==0 || $date=="0"  || $date=="undefinet" || $date>9999999999 || strpos($date,"<") || strpos($date,">") || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="select_genero") {
        if ($date=="" || $date=="undefinet" || $this->isValid($date)!=true || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="select_civil") {
        if ($date==""  || $date=="undefinet" || $this->isValid($date)!=true || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="celular") {
        if ($date==""  || $date=="undefinet" || $date<100000000 || strlen($date)!=9 || $this->isValid($date) || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="telefono") {
        if ($date==""  || $date=="undefinet" || $date<10000000 || strlen($date)!=8 || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="nameCorreo") {
        if ($date==""  || $date=="undefinet" || strpos($date,"@")===false || strpos($date,"<") || strpos($date,">") || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="correo") {
        if ($date==""  || $date=="undefinet" || strpos($date,"@")===false || strpos($date,".")===false || strpos($date,"<") || strpos($date,">") || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="password") {
        if ($date==""  || $date=="undefinet" || strlen($date)<8 || strlen($date)>25 || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="link") {
        if ($date==""  || $date=="undefinet" || strpos($date,"<") || strpos($date,">") || strpos($date,"https://")===false) {
          $valor[$i]=1;
        }
      }else if ($n1=="date") {
        if ($date==""  || $date=="undefinet" || strpos($date,"-")==false || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="time") {
        if ($date==""  || $date=="undefinet" || strpos($date,":")===false || strpos($date,"http://")) {
          $valor[$i]=1;
        }
      }else if ($n1=="bolean") {
        if ($date!="true") {
          $valor[$i]=1;
        }
      }else {
        $valor[$i]="El array de validación de datos vacio";
      }
    }
    $x1="";
    if(count($valor)>0 && count($valor)<=count($valueArray)) {
      $x1=count($valueArray);
      $valor[$x1]="validar";
    }else if(count($valor)==0){
      $x1=count($valueArray);
      $valor[$x1]="completo";
    }
  return $valor;
  }
  
}/* class */
  
?>