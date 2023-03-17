/* botones para formularios datos */
$('#datos_personales button').click(function(){    
  let order=[], regist;
  let nameM = $(this).attr('name');
  if (nameM=="mEditar") {
    $(this).addClass('visually-hidden');
    $('#datos_personales .form-control').attr('disabled',false);
    $('#datos_personales .form-control:first').attr('disabled',true);
    $('#datos_personales button[name=mPass]').addClass('visually-hidden');
    $('#datos_personales button[name=mCancelar]').removeClass('visually-hidden');
    $('#datos_personales button[name=mGuardar]').removeClass('visually-hidden');    
  } else if (nameM=="mCancelar"){
    $(this).addClass('visually-hidden');
    $('#datos_personales .form-control').attr('disabled',true);
    $('#datos_personales button[name=mGuardar]').addClass('visually-hidden');
    $('#datos_personales button[name=mEditar]').removeClass('visually-hidden');    
    $('#datos_personales button[name=mPass]').removeClass('visually-hidden');
  } else if (nameM=="mGuardar"){
    let confirm = window.confirm('¿Estas seguro de querer cambiar tus datos?');
    if (confirm) {
      order[0] = document.getElementById('alumno_dp_dni').value;
      order[1] = document.getElementById('alumno_dp_name1').value;
      order[2] = document.getElementById('alumno_dp_surName1').value;
      order[3] = document.getElementById('alumno_dp_surName2').value;
      order[4] = document.getElementById('alumno_dp_genero1').value;
      order[5] = document.getElementById('alumno_dp_edad').value;
      order[6] = document.getElementById('alumno_dp_correo1').value;
      order[7] = document.getElementById('alumno_dp_cellPhone1').value;      
      regist=`alumnoCode=${order[0]}&alumno_dp_name1=${order[1]}&alumno_dp_surName1=${order[2]}&alumno_dp_surName2=${order[3]}&alumno_dp_genero1=${order[4]}&alumno_dp_edad=${order[5]}&alumno_dp_correo1=${order[6]}&alumno_dp_cellphone1=${order[7]}&function=editStudentAdmin`;
      $.ajax({
        type: 'POST',
        url: '../system_data/studentsAdmin.php',
        data: regist,
        dataType: 'JSON',
        success: response=>{
          if (response['test'][8]=="validar") {
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
            $('#datos_personales .form-control').attr('disabled',true);
            $('#datos_personales button[name=mCancelar]').addClass('visually-hidden');
            $('#datos_personales button[name=mEditar]').removeClass('visually-hidden');
            /* validate */
            $('#datos_personales .form-control').removeClass('is-invalid');
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

/* contraseña mister */
document.querySelector("#modalPassword button[name=save]").addEventListener("click",()=>{
  let items=[];
  let x=0;
  document.querySelectorAll("#modalPassword .modal-body input").forEach(element=>{
    items[x]=element.value;
    x++
  });
  let regist = `userAdmin=${items[0]}&pass=${items[1]}&newPass=${items[2]}&passConfirm=${items[3]}&function=Admin`;
  $.ajax({
    type: 'POST',
    url: '../system_data/studentsAdmin.php',
    data: regist,
    dataType: 'JSON',
    success: response=>{
      if (response['test'][1]==1 || response['segurity']=="password") {
        $('#modalPassword .modal-body .form-control').removeClass('is-invalid');
        document.getElementById("pass_currently").classList.add("is-invalid");
      }else if (response['test'][2]==1) {
        $('#modalPassword .modal-body .form-control').removeClass('is-invalid');
        document.getElementById("pass_new").classList.add("is-invalid");
      }else if (response['test'][3]==1 || response['segurity']=="confirm") {
        $('#modalPassword .modal-body .form-control').removeClass('is-invalid');
        document.getElementById("pass_confirm").classList.add("is-invalid");
      }else if (response['segurity']=="newPassword") {
        console.log(response);
      }else {
        $('#modalPassword .modal-body .form-control').removeClass('is-invalid');
        window.location.reload();
      }
    }
  })
});
