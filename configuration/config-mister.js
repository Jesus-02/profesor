/* data to register */
let order=[];
let regist;
/* nombre de articulo */
let link='';
/* ocultar inputs buscar */
$('form[name=form_buscar1] input').hide();
/* ocultar articulos */
$('section article').hide();
$('section article:First').show();

/* ocultar menu desplegable */
$('aside div.list-goup-flush').hide();
$('aside a span i').hide();
$('aside a span i.bi-caret-down-fill').show();


/* menu desplagable */
var mnRegistrar=document.getElementById('mn-registrar');
var mnConfiguracion=document.getElementById('mn-configuracion');
var contRegistrar=0, contConfiguracion=0;
/* Menu lista registrar */
function optRegistrar() {
  if (contRegistrar==0) {
    /* active */
    $('aside a.list-group-item').removeClass('active');
    $(this).addClass('active');

    /* iconos */
    $('aside a#mn-registrar span i').hide();
    $('aside a#mn-registrar span i.bi-caret-up-fill').show();
    /* lista */
    $('aside div[name=mn_registrar_list]').show();
    contRegistrar=1;
  } else {
    /* active */
    $(this).removeClass('active');
    /* iconos */
    $('aside a#mn-registrar span i').hide();
    $('aside a#mn-registrar span i.bi-caret-down-fill').show();
    /* lista */
    $('aside div[name=mn_registrar_list]').hide();
    contRegistrar=0;
  }
}
/* menu lista de configuracion */
function optConfiguracion() {
  if (contConfiguracion==0) {
    /* active */
    $('aside a.list-group-item').removeClass('active');
    $(this).addClass('active');

    /* iconos */
    $('aside a#mn-configuracion span i').hide();
    $('aside a#mn-configuracion span i.bi-caret-up-fill').show();
    /* lista */
    $('aside div[name=mn_configuracion_list]').show();
    contConfiguracion=1;
  } else {
    /* active */
    $(this).removeClass('active');
    /* iconos */
    $('aside a#mn-configuracion span i').hide();
    $('aside a#mn-configuracion span i.bi-caret-down-fill').show();
    /* lista */
    $('aside div[name=mn_configuracion_list]').hide();
    contConfiguracion=0;
  }
}
mnRegistrar.addEventListener('click', optRegistrar, false);
mnConfiguracion.addEventListener('click', optConfiguracion, false);
/* Visualizar articulos */
$('aside .list-group a').click(function() {
link = $(this).attr('href');
  if (link!='#' && link!='#close') {
    /* active */
    $('aside a.list-group-item').removeClass('active');
    $(this).addClass('active');

    $('section article').hide();
    $(link).show();
  }else if(link=='#close'){
    /**
     * no funciona $.post()
     * Para cerrar la session
     */
    $.ajax({
      type: 'POST',
      url:'../system_data/general.php',
      data: 'function=close'
     }).done(function() {
      window.location.href = '/profesor1/index.php';
    });  
  }
});
/* Visualizar inputs buscar alumnos */
$('select[name=buscar_alumnos1]').on('click',function() {
  var valor = $(this).val();
  var valorId = $(this).attr('id');
  if ("table_alumnos-b1Opciones" == valorId) {
    mostrarInputs(valor);
  } else {
    alert('Error de codigo '+valorId);
  }
});
/* Elegir tipos de fecha con select para inputs */
function mostrarInputs(valor) {
  if ("a0" == valor) {
    $(link+' form[name=form_buscar1] input').hide();
    $(link+' form[name=form_buscar1] select[name=a6]').hide();
    $(link+' form[name=form_buscar1] input').val('');
  } else if ("a1" == valor) {
    $(link+' form[name=form_buscar1] input').hide();
    $(link+' form[name=form_buscar1] input').val('');
    $(link+' form[name=form_buscar1] input[name=a1]').show();
    $(link+' form[name=form_buscar1] select[name=a6]').show();
  } else if ("a2" == valor) {
    $(link+' form[name=form_buscar1] input').hide();
    $(link+' form[name=form_buscar1] input').val('');
    $(link+' form[name=form_buscar1] input[name=a2]').show();
    $(link+' form[name=form_buscar1] input[name=a3]').show();
    $(link+' form[name=form_buscar1] select[name=a6]').show();
  } else if ("a4" == valor) {
    $(link+' form[name=form_buscar1] input').hide();
    $(link+' form[name=form_buscar1] input').val('');
    $(link+' form[name=form_buscar1] input[name=a4]').show();
    $(link+' form[name=form_buscar1] select[name=a6]').show();
  } else if ("a5" == valor) {
    $(link+' form[name=form_buscar1] input').hide();
    $(link+' form[name=form_buscar1] input').val('');
    $(link+' form[name=form_buscar1] input[name=a5]').show();
    $(link+' form[name=form_buscar1] select[name=a6]').show();
  } else if ("a6" == valor) {
    $(link+' form[name=form_buscar1] input').hide();
    $(link+' form[name=form_buscar1] input').val('');
    $(link+' form[name=form_buscar1] input[name=a6]').show();
  } else {
    alert('Error de valor '+valor);
  }
}
