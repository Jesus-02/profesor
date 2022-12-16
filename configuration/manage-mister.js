/* Indispensable para popers */
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
/* botones para formularios datos */
$(link+' form div[name=opn-vertical] button').on('click',function() {
  let nameA = $(this).attr('name');
  let formA= $(link+' form').attr('name');
  let elementos = document.querySelectorAll(`${link} form .form-control`);
  if (nameA=="editar") {
    if (link=="#alumnos") {
      updateStudents(elementos,"update");    
    }else if (link=="#cursos") {
      updateArticleC(elementos,"update");    
    }else if (link=="#institutos") {
      updateSchool(elementos,"update");      
    }else if (link=="#activar-curso") {
      updateActivateCourse(elementos,"update");      
    }else if (link=="#evaluaciones") {
      updateTest(elementos,"update");      
    }else if (link=="#notas") {
      updateReview(elementos,"update");
    }
  }else if (nameA=="editar1") {
    if (link=='#evaluaciones') {
      $(link+' form select:first').attr('disabled',false);
      $(link+' form input.form-control:first').attr('disabled',false);
      $(link+' form .form-control:first').focus();

      $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
      $(link+' form button[name=buscar]').removeClass('visually-hidden');
      $(link+' form button[name=cancelar]').removeClass('visually-hidden');
      $(link+' form button[name=editar]').removeClass('visually-hidden');  
      $(link+' form button[name=editar]').attr('disabled',true);
      $(link+' form button[name=buscar]').attr('disabled',false);
    }else if (link=="#notas") {
      updateReview(elementos,"searchUpdate");

    }else if (link=="#alumnos" || link=="#cursos" || link=="#institutos" || link=="#activar-curso"){
      $(link+' form .form-control:first').attr('disabled',false);
      $(link+' form .form-control:first').focus();

      $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
      $(link+' form button[name=buscar]').removeClass('visually-hidden');
      $(link+' form button[name=cancelar]').removeClass('visually-hidden');
      $(link+' form button[name=editar]').removeClass('visually-hidden');  
      $(link+' form button[name=editar]').attr('disabled',true);
      $(link+' form button[name=buscar]').attr('disabled',false);  
    }    

  }else if (nameA=="nuevo1") {
    if (link=="#alumnos") {
      let confirm = window.confirm("Al registrarse el alumno por este medio automaticamente está aseptando los terminos establesidos");
      if (confirm) {
        $(link+' form .form-control').attr('disabled',false);
    
        $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
        $(link+' form button[name=cancelar]').removeClass('visually-hidden');
        $(link+' form button[name=nuevo]').removeClass('visually-hidden');      
        }  
    }else if (link=="#notas"){
      $(link+' form .form-control:first').attr('disabled',false);
      $(link+' form .form-control:first').focus();

      $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
      $(link+' form button[name=buscar]').removeClass('visually-hidden');
      $(link+' form button[name=cancelar]').removeClass('visually-hidden');
      $(link+' form button[name=editar1]').removeClass('visually-hidden');
      $(link+' form button[name=nuevo]').removeClass('visually-hidden');

      $(link+' form button[name=editar1]').attr('disabled',true);
      $(link+' form button[name=nuevo]').attr('disabled',true);
    }else{
      $(link+' form .form-control').attr('disabled',false);
  
      $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
      $(link+' form button[name=cancelar]').removeClass('visually-hidden');
      $(link+' form button[name=nuevo]').removeClass('visually-hidden');      
    }
  }else if (nameA=="nuevo") {
    if (link=="#alumnos") {
      updateStudents(elementos,"new");    
    }else if (link=="#cursos") {
      updateArticleC(elementos,"new");    
    }else if (link=="#institutos") {
      updateSchool(elementos,"new");      
    }else if (link=="#activar-curso") {
      updateActivateCourse(elementos,"new");      
    }else if (link=="#evaluaciones") {
      updateTest(elementos,"new");      
    }else if (link=="#notas") {
      updateReview(elementos,"new");
    }
  }else if (nameA=="buscar") {
    if (link=="#alumnos") {      
      updateStudents(elementos,"search");      
    }else if (link=="#cursos") {
      updateArticleC(elementos,"search");      
    }else if (link=="#institutos") {
      updateSchool(elementos,"search");      
    }else if (link=="#activar-curso") {
      updateActivateCourse(elementos,"search");      
    }else if (link=="#evaluaciones") {
      updateTest(elementos,"search");      
    }else if (link=="#notas") {
      updateReview(elementos,"search");
    }
  }else if (nameA=="cancelar") {
    $(link+' form[name='+formA+'] .form-control').attr('disabled',true);    
    $(link+' form[name='+formA+'] .form-control-plaintext').val('');
    $(link+' form[name='+formA+'] .form-control').val('');    
    $(link+' form[name='+formA+'] select').val('0');
    $(link+' form[name='+formA+'] .form-control').removeClass('is-invalid');    
    $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
    $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
    $(link+' form button[name=listar]').removeClass('visually-hidden');
    if (link=="#activar-curso") {
      document.querySelector("#activar-curso form div[name=temas]").classList.add("visually-hidden");
    }
    if (link=="#notas") {
      $('#notas_pd_alumno1 optgroup option').remove();
      localStorage.removeItem("Evaluacion");
      $(link+' form button[name=editar1]').addClass('visually-hidden');
      $(link+' form button[name=editar1]').attr('disabled',false);
    }else{
      $(link+' form button[name=editar1]').removeClass('visually-hidden');
    }

  }else if (nameA=="listar") {
    $(link+" div div.table-responsive").load(" "+link+" div div.table-responsive");    
  }else {
    alert("Error en el boton: "+nameA);
  }
});
/**
 * formularios
 * formulario alumno
 */
function updateStudents(params, action) {
  if (action=="search") {
    $.ajax({
      type: 'POST',
      url:'../system_data/studentsAdmin.php',
      data: `studentBuscar=${params[0].value}&function=studentB`,
      dataType: 'JSON',
      success: response=>{
        if(response['row']!=null){
          document.querySelector(link+' form#datos_alumnos #alumno_code').value=response['row']['id_alumnos'];
          params[0].value = response['row']['dni'];
          params[1].value = response['row']['nombres'];
          params[2].value = response['row']['ap_paterno'];
          params[3].value = response['row']['ap_materno'];
          params[4].value = response['row']['genero'];
          params[5].value = response['row']['edad'];
          params[6].value = response['row']['correo'];
          params[7].value = response['row']['celular'];
          params[8].value = response['row']['id_curso'];
          /* botones para formularios datos */
          $(link+' form input').attr('disabled',false);
          $(link+' form select').attr('disabled',false);
          $(link+' form#datos_alumnos .form-control').removeClass('is-invalid');
          $(link+' form button[name=editar]').attr('disabled',false);
          $(link+' form button[name=buscar]').attr('disabled',true);    
        }else{
          alert("Alumno no encontrado");
          $(link+' form input:first').addClass('is-invalid');
        }
      }
    });
  }else if (action=="update") {
    let code = document.getElementById("alumno_code").value;
    let regist=`dni=${params[0].value}&names=${params[1].value}&surNamef=${params[2].value}&surNameM=${params[3].value}`;
    regist=regist+`&genero=${params[4].value}&edad=${params[5].value}&mail=${params[6].value}&cellphone=${params[7].value}`;
    regist=regist+`&cursoCode=${params[8].value}&alumnoCode=${code}&function=editStudent`;
    $.ajax({
      type: 'POST',
      url:'../system_data/studentsAdmin.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][9]=="validar"){
          let x=0;
          document.querySelectorAll("#alumnos form#datos_alumnos .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Alumno registrado");
          /* botones para formularios datos */
          $(link+' form#datos_alumnos input').attr('disabled',true);    
          $(link+' form#datos_alumnos select').attr('disabled',true);
          $(link+' form#datos_alumnos input').val('');    
          $(link+' form#datos_alumnos select').val('0');
          $(link+' form#datos_alumnos .form-control').removeClass('is-invalid');

          $(link+' form#datos_alumnos div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form#datos_alumnos button[name=editar1]').removeClass('visually-hidden');
          $(link+' form#datos_alumnos button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form#datos_alumnos button[name=listar]').removeClass('visually-hidden');

        }
      }
    });
  }else if (action=="new") {
    let regist=`user_r1Dni=${params[0].value}&user_r1name=${params[1].value}&user_r1surNameP=${params[2].value}&user_r1surNameM=${params[3].value}`;
    regist=regist+`&user_r1genero1=${params[4].value}&user_r1edad=${params[5].value}&user_r1correo=${params[6].value}`;
    regist=regist+`&user_r1cellPhone1=${params[7].value}&user_r1curso1=${params[8].value}&user_r1terminos1=true&function=registerAlum`;
    $.ajax({
      type: 'POST',
      url:'../system_data/general.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(['validacion'][10]=="validar"){
          let x=0;
          document.querySelectorAll("#alumnos form#datos_alumnos .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Alumno registrado");
          /* botones para formularios datos */
          $(link+' form#datos_alumnos .form-control').attr('disabled',true);    
          $(link+' form#datos_alumnos input').val('');    
          $(link+' form#datos_alumnos select').val('0');
          $(link+' form#datos_alumnos .form-control').removeClass('is-invalid');
          $(link+' form#datos_alumnos div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form#datos_alumnos button[name=editar1]').removeClass('visually-hidden');
          $(link+' form#datos_alumnos button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form#datos_alumnos button[name=listar]').removeClass('visually-hidden');
      
        }
      }
    });
  }
}
/* formulario Institutos */
function updateSchool(params, action) {
  if (action=="search") {
    $.ajax({
      type: 'POST',
      url:'../system_data/data_institute.php',
      data: `schoolBuscar=${params[0].value}&function=schoolB`,
      dataType: 'JSON',
      success: response=>{
        if(response['row']!=null){
          params[0].value = response['row']['instituto'];
          params[1].value = response['row']['av_local'];
          $(link+' form input:first').val(response['row']['id_local']);
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',false);
          $(link+' form .form-control').removeClass('is-invalid');
          $(link+' form button[name=editar]').attr('disabled',false);
          $(link+' form button[name=buscar]').attr('disabled',true);    
        }else{
          alert("Instituto no encontrado");
          $(link+' form input.form-control:first').addClass('is-invalid');
        }
      }
    });
  }else if (action=="update") {
    let codeData=document.getElementById('school_code');
    let regist=`instituto_Name=${params[0].value}&indtituto_Address=${params[1].value}&school_code=${codeData.value}&function=schoolEdit`;
    $.ajax({
      type: 'POST',
      url:'../system_data/data_institute.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][2]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Instituto registrado");
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);
          codeData.value="";   
          $(link+' form .form-control').val('');    
          $(link+' form select').val('0');
          $(link+' form .form-control').removeClass('is-invalid');

          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=editar1]').removeClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');

        }
      }
    });
  }else if (action=="new") {
    let regist=`instituto_Name=${params[0].value}&indtituto_Address=${params[1].value}&function=registerSchool`;
    $.ajax({
      type: 'POST',
      url:'../system_data/data_institute.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][2]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Instituto registrado");
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);    
          $(link+' form .form-control').val('');    
          $(link+' form select').val('0');
          $(link+' form .form-control').removeClass('is-invalid');

          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=editar1]').removeClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');
      
        }
      }
    });
  }
}

/* formulario Activar nuevos cursos */
document.querySelector("select#num_Temas").addEventListener("click", ()=>{
  let valor = document.getElementById('num_Temas').value;
  let x=0;
  document.querySelector("#activar-curso form div[name=temas]").classList.remove("visually-hidden");
  document.querySelectorAll("#activar-curso form div[name=temas] select").forEach(element=>{
    if (valor==0) {
      element.classList.add("visually-hidden");
      element.value=0;
    }else if(valor>x && valor!=0){
      element.classList.remove("visually-hidden");
    }else if (valor<=x && valor!=0) {
      element.classList.add("visually-hidden");
      element.value=0;
    }
    x++;
  });  
});
function updateActivateCourse(params, action) {
  if (action=="search") {
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: `courseBuscar=${params[0].value}&function=courseB`,
      dataType: 'JSON',
      success: response=>{
        if(response['row']!=null){
          params[1].value = response['row']['descripcion'];
          params[2].value = response['row']['id_local'];
          params[3].value = response['row']['nivel'];
          params[4].value = response['row']['link'];
          params[5].value = response['row']['fecha_inicio'];
          params[6].value = response['row']['fecha_fin'];
          $(link+' form input:first').val(response['row']['id_cursos']);
          /* formularios datos */
          $(link+' form .form-control').attr('disabled',false);
          $(link+' form .form-control').removeClass('is-invalid');          
          if (response['rowDetail'].length>0 || response['rowDetail']!=null) {
            document.querySelector("#activar-curso form div[name=temas]").classList.remove("visually-hidden");
            let x=0;
            document.querySelectorAll("#activar-curso form div[name=temas] .form-control").forEach(element=>{
              if (response['rowDetail'][x]>0) {
                element.disabled=false;
                element.classList.remove("visually-hidden");
                element.value = response['rowDetail'][x];                
              } else {
                element.value=0;
                element.classList.add("visually-hidden");                                
              }
              x++;
            });
            params[7].value = response['rowDetail'].length;
          }
          /* botones para formularios datos */
          $(link+' form button[name=editar]').attr('disabled',false);
          $(link+' form button[name=buscar]').attr('disabled',true);    
        }else if (response['test'][1]=="validar") {
          $(link+' form input:first').addClass('is-invalid');          
        }else{
          alert("Tema no encontrado");
        }
      }
    });
  }else if (action=="update") {
    let codeData=document.getElementById('curso_code');
    let regist=`curso_ac_titulo=${params[0].value}&curso_ac_detalle=${params[1].value}&curso_ac_Local=${params[2].value}`;
    regist=regist+`&curso_ac_nivel1=${params[3].value}&curso_ac_link1=${params[4].value}&curso_ac_inicio1=${params[5].value}`;
    regist=regist+`&curso_ac_termino1=${params[6].value}&num_Temas=${params[7].value}&curso_ac_Tema1=${params[8].value}`; 
    regist=regist+`&curso_ac_Tema2=${params[9].value}&curso_ac_Tema3=${params[10].value}&curso_ac_Tema4=${params[11].value}`;
    regist=regist+`&curso_ac_Tema5=${params[12].value}&curso_code=${codeData.value}&function=courseEdit`;
  $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][13]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          if (response['temas']) {
            alert("Añadiste un nuevo tema");            
          }else{
            alert("Datos del curso cambiado");
          }
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);
          codeData.value="";   
          $(link+' form .form-control').val('');    
          $(link+' form select').val('0');
          $(link+' form .form-control').removeClass('is-invalid');
          document.querySelector("#activar-curso form div[name=temas]").classList.add("visually-hidden");
          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=editar1]').removeClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');

        }
      }
    });
  }else if (action=="new") {
    let regist=`curso_ac_titulo=${params[0].value}&curso_ac_detalle=${params[1].value}&curso_ac_Local=${params[2].value}`;
    regist=regist+`&curso_ac_nivel1=${params[3].value}&curso_ac_link1=${params[4].value}&curso_ac_inicio1=${params[5].value}`;
    regist=regist+`&curso_ac_termino1=${params[6].value}&num_Temas=${params[7].value}&curso_ac_Tema1=${params[8].value}`; 
    regist=regist+`&curso_ac_Tema2=${params[9].value}&curso_ac_Tema3=${params[10].value}&curso_ac_Tema4=${params[11].value}`;
    regist=regist+`&curso_ac_Tema5=${params[12].value}&function=courseNew`;
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][13]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Nuevo curso registrado");
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);
          $(link+' form .form-control').val('');    
          $(link+' form select').val('0');
          $(link+' form .form-control').removeClass('is-invalid');
          document.querySelector("#activar-curso form div[name=temas]").classList.add("visually-hidden");
          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=editar1]').removeClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');

        }
      }
    });
  }
}
/* formulario Temas de los cursos */
function updateArticleC(params, action) {
  if (action=="search") {
    $.ajax({
      type: 'POST',
      url:'../system_data/data_Cursos.php',
      data: `articleCBuscar=${params[0].value}&function=articleCB`,
      dataType: 'JSON',
      success: response=>{
        if(response['row']!=null){
          params[0].value = response['row']['curso'];
          params[1].value = response['row']['detalle'];
          $(link+' form input.form-control:first').val(response['row']['id_decurso']);
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',false);
          $(link+' form .form-control').removeClass('is-invalid');
          $(link+' form button[name=editar]').attr('disabled',false);
          $(link+' form button[name=buscar]').attr('disabled',true);    
        }else{
          alert("Tema no encontrado");
          $(link+' form input:first').addClass('is-invalid');
        }
      }
    });
  }else if (action=="update") {
    let codeData=document.getElementById('laboral_code');
    let regist=`nuevo_cs_name1=${params[0].value}&nuevo_cs_detalle1=${params[1].value}&laboral_code=${codeData.value}&function=editArticle`;
    $.ajax({
      type: 'POST',
      url:'../system_data/data_Cursos.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][2]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Tema registrado");
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);
          codeData.value="";   
          $(link+' form .form-control').val('');    
          $(link+' form select').val('0');
          $(link+' form .form-control').removeClass('is-invalid');

          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=editar1]').removeClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');

        }
      }
    });
  }else if (action=="new") {
    let regist=`nuevo_cs_name1=${params[0].value}&nuevo_cs_detalle1=${params[1].value}&function=registerArticle`;
    $.ajax({
      type: 'POST',
      url:'../system_data/data_Cursos.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][2]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Tema registrado");
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);    
          $(link+' form .form-control').val('');    
          $(link+' form select').val('0');
          $(link+' form .form-control').removeClass('is-invalid');

          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=editar1]').removeClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');
      
        }
      }
    });
  }
}
/* formulario evaluaciones de los cursos */
function updateTest(params, action) {
  if (action=="search") {
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: `testCursoBuscar=${params[0].value}&TestTitleBuscar=${params[1].value}&function=testB`,
      dataType: 'JSON',
      success: response=>{
        if(response['row']!=null){
          params[2].value = response['row']['descripcion'];
          params[3].value = response['row']['pendiente'];
          params[4].value = response['row']['id_rango'];
          params[5].value = response['row']['fecha'];
          $(link+' form input:first').val(response['row']['id_nota']);
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',false);
          $(link+' form .form-control').removeClass('is-invalid');
          $(link+' form button[name=editar]').attr('disabled',false);
          $(link+' form button[name=buscar]').attr('disabled',true);    
        }else{
          alert("Evaluacion no encontrada");
          document.querySelector(link+' form #evaluaciones_pd_curso1').classList.add('is-invalid');
          document.querySelector(link+' form #evaluaciones_pd_titulo1').classList.add('is-invalid');
        }
      }
    });
  }else if (action=="update") {
    let codeData=document.getElementById('evaluacion_code');
    let regist=`evaluacion_curso=${params[0].value}&evaluacion_titulo=${params[1].value}&evaluacion_descripcion=${params[2].value}`;
    regist=regist+`&evaluacion_estado=${params[3].value}&evaluacion_rango=${params[4].value}&evaluacion_fecha=${params[5].value}&test_code=${codeData.value}&function=testEdit`;
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][6]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Instituto registrado");
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);
          codeData.value="";   
          $(link+' form .form-control').val('');    
          $(link+' form select').val('0');
          $(link+' form .form-control').removeClass('is-invalid');

          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=editar1]').removeClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');

        }
      }
    });
  }else if (action=="new") {
    let regist=`evaluacion_curso=${params[0].value}&evaluacion_titulo=${params[1].value}&evaluacion_descripcion=${params[2].value}`;
    regist=regist+`&evaluacion_estado=${params[3].value}&evaluacion_rango=${params[4].value}&evaluacion_fecha=${params[5].value}&function=testNew`;
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][2]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          alert("Instituto registrado");
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);    
          $(link+' form .form-control').val('');    
          $(link+' form select').val('0');
          $(link+' form .form-control').removeClass('is-invalid');

          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=editar1]').removeClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');
      
        }
      }
    });
  }
}
/* formulario notas de los cursos */
function updateReview(params, action){
  if (action=="search") {
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: `reviewBuscar=${params[0].value}&function=reviewB`,
      dataType: 'JSON',
      success: response=>{
        if(response['row']!=null){
          let element="";
          let local=[];
          for (let index = 0; index < response['row'].length; index++) {
            element = element+`<option value='${response['row'][index][1]}'>${response['row'][index][2]} ${response['row'][index][3]}</option>`;            
            local[index]=[response['row'][index][1],"0","null"];
          }
          $('#notas_pd_alumno1 optgroup').append(element);
          localStorage.setItem("Evaluacion",JSON.stringify(local));          
          /* botones para formularios datos */
          $('#notas form .form-control').attr('disabled',false);
          $('#notas form select#notas_pd_evaluacion1').attr('disabled',true);
          $('#notas form button[name=buscar]').addClass('visually-hidden');
          $('#notas form button[name=editar1]').attr('disabled',false);
          $('#notas form button[name=nuevo]').attr('disabled',false);     
        }else{
          alert("Evaluacion no encontrada");
          document.querySelector('#notas form select#notas_pd_evaluacion1').classList.add('is-invalid');
        }
      }
    });
  }else if (action=="searchUpdate") {
    let regist =`alumno=${params[3].value}&review=${params[0].value}&function=reviewBTest`; 
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][2]=="validar" && response['test'][0]==1){
          params[3].classList.add('is-invalid');
          params[0].classList.remove('is-invalid');
        }else if(response['test'][2]=="validar" && response['test'][1]==1){
          params[3].classList.remove('is-invalid');
          params[0].classList.add('is-invalid');
        }else{
          params[1].value = response['response'][2];
          params[2].value = response['response'][3];
          /* botones para formularios datos */
          $('#notas form #notas_pd_alumno1').removeClass('is-invalid');
          $('#notas form #notas_pd_alumno1').attr('disabled',true);
          params[0].classList.remove('is-invalid');          
          localStorage.removeItem("Evaluacion");
      
          $('#notas form div[name=opn-vertical] button').addClass('visually-hidden');
          $('#notas form button[name=cancelar]').removeClass('visually-hidden');
          $('#notas form button[name=editar]').removeClass('visually-hidden');  
          $('#notas form button[name=editar]').attr('disabled',false);        
        }
      }
    });

  }else if (action=="update") {
    let regist =`alumno=${params[3].value}&review=${params[0].value}&nota=${params[1].value}&reseña=${params[2].value}&function=reviewEdit`; 
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
        if(response['test'][4]=="validar"){
          let x=0;
          document.querySelectorAll(link+" form .form-control").forEach(element => {
            if (response['test'][x]==1) {
              element.classList.add('is-invalid');
            }else{
              element.classList.remove('is-invalid');
            }
            x++;
          });
        }else{
          /* botones para formularios datos */
          $(link+' form .form-control').attr('disabled',true);    
          $(link+' form input').val('');    
          $(link+' form select').val('0');
          $(link+' form textarea').val('');
          $(link+' form .form-control').removeClass('is-invalid');
          $('#notas_pd_alumno1 optgroup option').remove();
      
          $(link+' form div[name=opn-vertical] button').addClass('visually-hidden');
          $(link+' form button[name=nuevo1]').removeClass('visually-hidden');
          $(link+' form button[name=listar]').removeClass('visually-hidden');
        }
      }
    });

  }else if (action=="new"){    
    /* nota del localStorage */
    const itemStr = localStorage.getItem("Evaluacion");
    const itemData = JSON.parse(itemStr);
    let alumno = document.getElementById('notas_pd_alumno1'); 
    let nota = document.getElementById('notas_pd_nota1'); 
    let reseña = document.getElementById('notas_pd_reseña1');
    let count = 0;
    let regist="";
    /* verificar alumnos sin notas */
    for (let xy = 0; xy < itemData.length; xy++) {
      if (itemData[xy][1].includes('0') && itemData[xy][0]==alumno.value) {
        count=xy;
      }    
    }    
    /* Añadir notas */
    if (alumno.value!=0 && nota.value!="" && reseña.value!="") {
      itemData[count][1] = nota.value;          
      itemData[count][2] = reseña.value;          
      localStorage.setItem("Evaluacion",JSON.stringify(itemData));
      if (count < itemData.length-1) {
        alert("Nota añadida");
        nota.value="";
        reseña.value="";
        $("#notas_pd_alumno1 option:selected").attr("disabled",true);
        if (count==0) {
          $('#notas form button[name=editar1]').addClass('visually-hidden');
        }  
      }else if (count == itemData.length-1){
        /* Todas las notas añadidas */
        let confirm=window.confirm("¿Estas seguro de querer registrar las notas?");
        if (confirm) {
          for (let x = 0; x < itemData.length; x++) {
            if (x==0) {
              regist=`alumno${x}=${itemData[x][0]}&nota${x}=${itemData[x][1]}&reseña${x}=${itemData[x][2]}`;              
            } else {
              regist=`${regist}&alumno${x}=${itemData[x][0]}&nota${x}=${itemData[x][1]}&reseña${x}=${itemData[x][2]}`;
            }
          }     
          $.ajax({
            type: 'POST',
            url:'../system_data/misterAdmin.php',
            data: `${regist}&number=${itemData.length}&review=${params[0].value}&function=reviewNew`
          }).done(()=>{
            $('#notas form .form-control').attr('disabled',true);    
            $('#notas form .form-control').val('');    
            $('#notas form select').val('0');
            $('#notas form .form-control').removeClass('is-invalid');
            $('#notas_pd_alumno1 optgroup option').remove();
            localStorage.removeItem("Evaluacion");
            /* botones para formularios datos */  
            $('#notas form div[name=opn-vertical] button').addClass('visually-hidden');
            $('#notas form button[name=nuevo1]').removeClass('visually-hidden');
            $('#notas form button[name=listar]').removeClass('visually-hidden');       
            
          });
        }
      }  
    }/* Validacion */
  }
}
/**
 * Cursos disponibles 
 */
function activeCourse(code, x) {
  let confirm = window.confirm("¿Estas seguro de querer cambiar la disponivilidad del curso?");
  if(confirm){
    if (x) {
      $.ajax({
        type: 'POST',
        url:'../system_data/misterAdmin.php',
        data: `courseCode=${code}&function=courseActive`,
      }).done(()=>{
        $("#cursosActivos .recarga").load(" #cursosActivos .recarga");
       });
    }else {
      $.ajax({
        type: 'POST',
        url:'../system_data/misterAdmin.php',
        data: `courseCode=${code}&function=courseDisabled`,
      }).done(()=>{
        $("#cursosActivos .recarga").load(" #cursosActivos .recarga");
       });
    }
  }
}

/* CV */
/* botones formulario datos personales */
$('#datos_personales button').click(function() {
  let nameM = $(this).attr('name');
  if (nameM=="mEditar") {
    $(this).addClass('visually-hidden');
    $('#datos_personales input[type=text]').attr('disabled',false);
    $('#datos_personales input[type=number]').attr('disabled',false);
    $('#datos_personales button[name=mPass]').addClass('visually-hidden');
    $('#datos_personales button[name=mCancelar]').removeClass('visually-hidden');
    $('#datos_personales button[name=mGuardar]').removeClass('visually-hidden');    
  } else if (nameM=="mCancelar"){
    $(this).addClass('visually-hidden');
    $('#datos_personales input[type=text]').attr('disabled',true);
    $('#datos_personales input[type=number]').attr('disabled',true);
    $('#datos_personales button[name=mGuardar]').addClass('visually-hidden');
    $('#datos_personales button[name=mEditar]').removeClass('visually-hidden');    
    $('#datos_personales button[name=mPass]').removeClass('visually-hidden');
  } else if (nameM=="mGuardar"){
    let confirm = window.confirm('¿Estas seguro de querer cambiar tus datos?');
    if (confirm) {
      order[1] = document.getElementById('editar_dp_name1').value;
      order[2] = document.getElementById('editar_dp_surName1').value;
      order[3] = document.getElementById('editar_dp_surName2').value;
      order[4] = document.getElementById('editar_dp_phone1').value;
      order[5] = document.getElementById('editar_dp_cellphone1').value;      
      regist=`editar_dp_name1=${order[1]}&editar_dp_surName1=${order[2]}&editar_dp_surName2=${order[3]}&editar_dp_phone1=${order[4]}&editar_dp_cellphone1=${order[5]}&function=editMister`;
      $.ajax({
        type: 'POST',
        url: '../system_data/misterAdmin.php',
        data: regist,
        dataType: 'JSON',
        success: response=>{
          if (response['test'][5]=="validar") {
            let x=0;
            let formData= document.querySelectorAll("form#datos_personales .form-control");
            formData.forEach(element => {
              if (response['test'][x]==1) {
                element.classList.add('is-invalid');
              }else{
                element.classList.remove('is-invalid');
              }
              x++;
            });  
          }else if(response['error'][1]==true){
            alert('Guardado');
            $(this).addClass('visually-hidden');
            $('#datos_personales input[type=text]').attr('disabled',true);
            $('#datos_personales input[type=number]').attr('disabled',true);
            $('#datos_personales button[name=mCancelar]').addClass('visually-hidden');
            $('#datos_personales button[name=mEditar]').removeClass('visually-hidden');
            /* validate */
            $('#datos_personales input[type=text]').removeClass('is-invalid');
            $('#datos_personales input[type=number]').removeClass('is-invalid');
            $('#datos_personales button[name=mPass]').removeClass('visually-hidden');
          }else if(response['error'][1]==false){
            alert('Guardado error de sinytaxis');
            console.log(response);
          }        
        }
      });      
    }
  }
});
/* redes sociales mister */
$("#modalSocial button[name=guardar]").on('click',()=>{
    let order=[], regist;
    order[1]=document.getElementById('social_Function').value;
    order[2]=document.getElementById('social_Name').value;
    order[3]=document.getElementById('social_Correo').value;
    order[4]=document.getElementById('social_Link').value;
    order[5]=document.getElementById('social_edit').value;
    regist= `social=${order[2]}&mail=${order[3]}&url=${order[4]}&codigo=${order[5]}&function=${order[1]}`;
    $.ajax({
        type: 'POST',
        url: '../system_data/misterAdmin.php',
        data: regist,
        dataType: 'JSON',
        success: response=>{
            if (response['test'][3]=="validar") {
                let x=0;
                document.querySelectorAll('#modalSocial .modal-body .form-control').forEach(element=>{
                    if (response['test'][x]==1) {
                       element.classList.add('is-invalid'); 
                    } else {
                        element.classList.remove('is-invalid');
                    }
                    x++;
                });                
                console.log(response['test']);
            }else{
                $('#modalSocial .modal-body .form-control').removeClass('is-invalid');
                window.location.reload();
            }
        }
    });
});
/* Cursos mister */
$("#modalCursos button[name=guardar]").on('click',()=>{
  let order=[], regist;
  order[1]=document.getElementById('cursos_Function').value;
  order[2]=document.getElementById('cursos_name').value;
  order[3]=document.getElementById('cursos_descripcion').value;
  order[4]=document.getElementById('cursos_nPorcentaje').value;
  order[5]=document.getElementById('cursos_lugar').value;
  order[6]=document.getElementById('cursos_inicio').value;
  order[7]=document.getElementById('cursos_termino').value;
  order[8]=document.getElementById('cursos_edit').value;
  regist= `curso=${order[2]}&descripcion=${order[3]}&nPorcentaje=${order[4]}&lugar=${order[5]}&fInicio=${order[6]}&fTermino=${order[7]}&codigo=${order[8]}&function=${order[1]}`;
  $.ajax({
      type: 'POST',
      url: '../system_data/misterAdmin.php',
      data: regist,
      dataType: 'JSON',
      success: response=>{
          if (response['test'][6]=="validar") {
              let x=0;
              document.querySelectorAll('#modalCursos .modal-body .form-control').forEach(element=>{
                  if (response['test'][x]==1) {
                     element.classList.add('is-invalid'); 
                  } else {
                      element.classList.remove('is-invalid');
                  }
                  x++;
              });                
              console.log(response['test']);
          }else{
              $('#modalCursos .modal-body .form-control').removeClass('is-invalid');
              window.location.reload();
          }
      }
  });
});
/* laboral mister */
$("#modalLaboral button[name=guardar]").on('click',()=>{
  let order=[], regist;
  order[1]=document.getElementById('laboral_Function').value;
  order[2]=document.getElementById('laboral_cargo').value;
  order[3]=document.getElementById('laboral_lugar').value;
  order[4]=document.getElementById('laboral_inicio').value;
  order[5]=document.getElementById('laboral_termino').value;
  order[6]=document.getElementById('laboral_edit').value;
  regist= `cargo=${order[2]}&lugar=${order[3]}&fInicio=${order[4]}&fTermino=${order[5]}&codigo=${order[6]}&function=${order[1]}`;
  $.ajax({
    type: 'POST',
    url: '../system_data/misterAdmin.php',
    data: regist,
    dataType: 'JSON',
    success: response=>{
          if (response['test'][4]=="validar") {
              let x=0;
              document.querySelectorAll('#modalLaboral .modal-body .form-control').forEach(element=>{
                  if (response['test'][x]==1) {
                     element.classList.add('is-invalid'); 
                  } else {
                      element.classList.remove('is-invalid');
                  }
                  x++;
              });                
          }else{
              $('#modalLaboral .modal-body .form-control').removeClass('is-invalid');
              window.location.reload();
          }
      }
  });
});
/* contraseña mister */
document.querySelector("#modalPassword button[name=save]").addEventListener("click",()=>{
  let items=[]
  let x=0
  document.querySelectorAll("#modalPassword .modal-body input").forEach(element=>{
    items[x]=element.value
    x++
  })
  let regist = `userAdmin=${items[0]}&pass=${items[1]}&newPass=${items[2]}&passConfirm=${items[3]}&function=Admin`
  $.ajax({
    type: 'POST',
    url: '../system_data/misterAdmin.php',
    data: regist,
    dataType: 'JSON',
    success: response=>{
      if (response['test'][1]==1 || $response['segurity']=="password") {
        $('#modalPassword .modal-body .form-control').removeClass('is-invalid')
        document.getElementById("pass_currently").classList.add("is-invalid")
      }else if (response['test'][2]==1) {
        $('#modalPassword .modal-body .form-control').removeClass('is-invalid')
        document.getElementById("pass_new").classList.add("is-invalid")
      }else if (response['test'][3]==1 || $response['segurity']=="confirm") {
        $('#modalPassword .modal-body .form-control').removeClass('is-invalid')
        document.getElementById("pass_confirm").classList.add("is-invalid")
      } else {
        $('#modalPassword .modal-body .form-control').removeClass('is-invalid')
        window.location.reload()
      }
    }
  })
})
/* Borrar data cv docente */
function deleteData(params,modal) {
  let mensaje=window.confirm("Estas seguro de querer borrar esta fila");
  if (mensaje) {
    let code="";
    if (modal=="modalSocial") {
      code="social";
    }else if (modal=="modalCursos") {
      code="cursos";
    }else if (modal=="modalLaboral") {
      code="laboral";
    }
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: `socialCode=${params}&table=${code}&function=misterDataDt`
    }).done(()=>{
      window.location.reload();
     });      
  }
}
/* Cargar modal a editar */
function editData(params, modal) {
  if (modal=="modalSocial") {
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: `socialBuscar=${params}&function=socialB`,
      dataType: 'JSON',
      success: response=>{
        document.getElementById('social_Function').value = "socialEditar";
        document.getElementById('social_Name').value = response['nombre'];
        document.getElementById('social_Correo').value = response['correo'];
        document.getElementById('social_Link').value = response['link'];
        document.getElementById('social_edit').value = response['id_rsocial'];
      }
    });    
  }else if (modal=="modalCursos") {
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: `cursoBuscar=${params}&function=cursosB`,
      dataType: 'JSON',
      success: response=>{
        document.getElementById('cursos_Function').value = "cursoEditar";
        document.getElementById('cursos_name').value = response['curso_ejercido'];
        document.getElementById('cursos_descripcion').value = response['descripcion'];
        document.getElementById('cursos_nPorcentaje').value = response['nivel_porcentaje'];
        document.getElementById('cursos_lugar').value = response['lugar'];
        document.getElementById('cursos_inicio').value = response['fecha_inicio'];
        document.getElementById('cursos_termino').value = response['fecha_fin'];
        document.getElementById('cursos_edit').value = response['id_dcurso'];
      }
    });    
  }else if (modal=="modalLaboral") {
    $.ajax({
      type: 'POST',
      url:'../system_data/misterAdmin.php',
      data: `laboralBuscar=${params}&function=laboralB`,
      dataType: 'JSON',
      success: response=>{
        document.getElementById('laboral_Function').value = "laboralEditar";
        document.getElementById('laboral_cargo').value = response['experiencia'];
        document.getElementById('laboral_lugar').value = response['lugar'];
        document.getElementById('laboral_inicio').value = response['fecha_inicio'];
        document.getElementById('laboral_termino').value = response['fecha_fin'];
        document.getElementById('laboral_edit').value = response['id_experiencia'];
      }
    });    
  }
}
/* reset moals cv */
function reset(x,y) {
  $("#"+x+" input[type=text]").val('');
  $("#"+x+" input[type=number]").val('');
  $("#"+x+" input[type=date]").val('');
  $("#"+x+" textarea").val('');
  $("#"+x+" input[type=text]:first").val(y);
}
