/* carga del dom */
window.addEventListener('load',()=>{
  let url = window.location.href;
  if(url.includes('/profesor1/views/cv.php')) {
    document.querySelector('header .menu-navbar a[name=cv]').classList.add('active');
  } else if(url.includes('/profesor1/views/register.php')) {
    document.querySelector('header .menu-navbar a[name=register]').classList.add('active');
  }  else {
    document.querySelector('header .menu-navbar a[name=home]').classList.add('active');
  }
});
/* Init session */
$('form[name=sesion] button').on('click',function() {
  let userInit = document.getElementById('userInit').value;
  let locacion =  window.location.href;
  let urlViews = "";
  if (locacion.includes('views')) {
    urlViews="../system_data/general.php";
  } else {
    urlViews="system_data/general.php";    
  }

  $.ajax({
    type: 'POST',
    url: urlViews,
    data: 'session='+userInit+'&function='+'open',
    dataType: 'JSON',
    success: function (response) {
      if (response[1]==false) {
      }else if(response[1]==true && response[4]==true) {
        alert('encontro el usuario');
        window.location.href = "/profesor1/views/register.php";        
      }else if(response[1]==true && response[4]==false){
        alert('usuario no tiene contraseña');
        window.location.href = "/profesor1/views/students.php";
      }else{
        console.log(response);
      }
    }
  })
});

/* segurity */
$("#login_1 form[name=login_1] button[name=Ingresar]").on('click',()=>{
  let userPass = document.getElementById('log_r1pass').value;
  let confirm = window.confirm("¿Revisa bien tu contraseña?");
  let insert = 'log_r1pass='+userPass+'&function=ingresar';
  if (confirm) {
   $.ajax({
    type: 'POST',
    url:'../system_data/general.php',
    data: insert,
    dataType: 'json',
    success: function(response) {
      if (response['error']) {
        if (response['usuario']=="alumno") {
          window.location.href = "/profesor1/views/students.php"          
        }else{
          window.location.href = "/profesor1/views/mister.php"          
        }        
      } else {
        alert("Contraseña incorrecta");
        $('#log_r1pass').addClass('is-invalid');
      }
    }
   });
  }
});

/* cancelar session */
$("#login_1 form[name=login_1] button[name=cancelar]").on('click',()=>{
  let confirm = window.confirm("¿Desea cancelar la sesion?");
  if (confirm) {
   $.ajax({
    type: 'POST',
    url:'../system_data/general.php',
    data: 'function=close'
   }).done(function() {
    window.location.href = '/profesor1/index.php';
  });
  }
});

/* Registrar Alumnos */
$('#registrar_1 form button').on('click',function(){
  let registDni1 = document.getElementById('user_r1Dni').value;
  let registName1 = document.getElementById('user_r1name').value;
  let registPaternal1 = document.getElementById('user_r1surNameP').value;
  let registMaternal1 = document.getElementById('user_r1surNameM').value;
  let registGenero1 = document.getElementById('user_r1genero1').value;
  let registEdad1 = document.getElementById('user_r1edad').value;
  let registEmail1 = document.getElementById('user_r1correo').value;
  let registCell1 = document.getElementById('user_r1cellPhone1').value;
  let registCurso1 = document.getElementById('user_r1curso1').value;
  let registTerminos1 = document.getElementById('user_r1terminos1').checked;
  let confirm = window.confirm("¿Estas seguro de querer registrar tus datos?");
  if (!confirm) {
    window.location="../index.php";  
  } else {
    let insert ='user_r1Dni='+registDni1+'&user_r1name='+registName1+'&user_r1surNameP='+registPaternal1;
    insert = insert+'&user_r1surNameM='+registMaternal1+'&user_r1genero1='+registGenero1+'&user_r1edad='+registEdad1;
    insert = insert+'&user_r1correo='+registEmail1+'&user_r1cellPhone1='+registCell1+'&user_r1curso1='+registCurso1;
    insert = insert+'&user_r1terminos1='+registTerminos1+'&function='+"registerAlum";
    $.ajax({
      type: 'POST',
      url: '../system_data/general.php',
      data: insert,
      dataType: 'json',
      success: function (response) {
        /* Validacion */
        let x=0;
        let datas = document.querySelectorAll('#registrar_1 form[name=registrar_1] .form-control');
        //console.log(response);          
        if (response['validacion'][10]=='validar' && response['validacion'][9]==1){
          $('#user_r1terminos1').addClass('is-invalid');
        }else if (response['validacion'][10]=='validar') {
          $('#user_r1terminos1').removeClass('is-invalid');
          datas.forEach(element => {            
            if (response['validacion'][x]==1) {
              element.classList.add('is-invalid');              
            }else{
              element.classList.remove('is-invalid');
            }
            x++;            
          });            
        } else {
          window.alert('Alumno registrado');          
          window.location.href = '/profesor1/views/students.php';
        }        
      }
    });    
  }
});

/* dropdown administrativo session */
$('ul.session-admin li a').on('click',(evento)=>{
  if (evento.target.innerText=="Administrar mister") {
    window.location.href="http://localhost:85/profesor1/views/mister.php";
  }else if (evento.target.innerText=="Administrar alumno") {
    window.location.href="http://localhost:85/profesor1/views/students.php";    
  }else if (evento.target.innerText=="Cerrar session") {
    closeSession();
  }
});

/* funcion cerrar session */
function closeSession() {
  let link;
  let confirm = window.confirm("¿Estas seguro de cerrar la sesion?");
  if (confirm) {    
    if (window.location.href=="http://localhost:85/profesor1/") {
      link='system_data/general.php';
    } else {
      link='../system_data/general.php';
    }
   $.ajax({
    type: 'POST',
    url: link,
    data: 'function=close'
   }).done(function() {
    window.location.href = '/profesor1/index.php';
   });
  }
}