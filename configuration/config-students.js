/* Nombre de articulo */
let link="";
/* ocultar articulos */
$('section article').hide();
$('section article:first').show();
// $('section article#tareas').show();

/* ocultar menu desplegable */
$('aside div.list-goup-flush').hide();
$('aside a span i').hide();
$('aside a span i.bi-caret-down-fill').show();

$('aside .list-group a').click(function() {
  link = $(this).attr('href');
  if (link!='#') {
    /* active */
    $('aside a.list-group-item').removeClass('active');
    $(this).addClass('active');

    $('section article').hide();
    $(link).show();
  }else{
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
