<?php 
	$select = "SELECT * FROM categoria WHERE activo = ? ORDER BY nombre ASC";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array(1));
	
	$select1 = "SELECT * FROM cartelera WHERE activo = ?";
	$stmt1 = $gbd -> prepare($select1);
	$stmt1 -> execute(array(1));
?>
<script>
jQuery(function ($) {
	var slider = $('.mis-stage').miSlider({
		//  La altura del escenario en px. Opciones: entero false o true. false = altura se calcula utilizando alturas de deslizamiento máximas. Predeterminado: false
		//stageHeight: 380,
		//  Número de diapositivas visibles a la vez. Opciones: entero falso o positivo. falso = Ajustar tantos como sea posible. Por defecto: 1
		slidesOnStage: false,
		//  La ubicación de la diapositiva actual en el escenario. Opciones: 'left', 'right', 'center'. Predeterminado: 'left'
		slidePosition: 'center',
		//  La diapositiva para comenzar. Opciones: 'beg', 'mid', 'end' o número de diapositiva que comienzan en 1 - '1', '2', '3', etc. Defualt: 'beg'
		slideStart: 'mid',
		//  El factor de escala relativo porcentual de la diapositiva actual: otras diapositivas están reducidas. Opciones: número positivo 100 o superior. 100 = Sin escala. Por defecto: 100
		slideScaling: 150,
		//  El desplazamiento vertical del centro de deslizamiento como un porcentaje de la altura de deslizamiento. Opciones: número positivo o negativo. Neg value = up. Valor Pos = abajo. 0 = Sin compensación. Predeterminado: 0
		offsetV: -5,
		//  Centrado el contenido de la diapositiva verticalmente - Boolean. Predeterminado: falso
		centerV: true,
		//  Opacidad de los botones de navegación anterior y siguiente cuando no está en transición. Opciones: Número entre 0 y 1. 0 (transparente) - 1 (opaco). Valor predeterminado: .5
		navButtonsOpacity: 5
	});
});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="well well-lg" style="text-align:center;"><h4><strong>Encuentra el local que buscas por niveles o por la inicial del nombre del local...</strong><h4></div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-xs-6 col-md-3" style="cursor:pointer;">
				<a onclick="localxnivel(1)" class="thumbnail">
					<img src="img/nivel_1.jpg" alt="fb0848">
				</a>
			</div>
			<div class="col-xs-6 col-md-3" style="cursor:pointer;">
				<a onclick="localxnivel(2)" class="thumbnail">
					<img src="img/nivel_2.jpg" alt="00a1b5">
				</a>
			</div>
			<div class="col-xs-6 col-md-3" style="cursor:pointer;">
				<a onclick="localxnivel(3)" class="thumbnail">
					<img src="img/nivel_3.jpg" alt="ff9400">
				</a>
			</div>
			<div class="col-xs-6 col-md-3" style="cursor:pointer;">
				<a onclick="localxnivel(4)" class="thumbnail">
					<img src="img/nivel_4.jpg" alt="243841">
				</a>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style="text-align:center;">
		<nav>
			<ul class="pagination pagination-sm">
			<?php 
			for($i = 'A'; $i <= 'Z'; $i++){
				
				if($i == 'AA'){
					break;
				}else{
					if($i == $letra){
						$activo = 'active';
					}else{
						$activo = '';
					}
					
					$letra_search = "'$i'";
					
					echo '
					<li onclick="buscarlocal('.$letra_search.')" id="link'.$i.'" class="menulocales '.$activo.'"><a>'.$i.'</a></li>
					';
				}
			}
			?>
			</ul>
		</nav>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="well well-lg" style="text-align:center;"><h4><strong>Tenemos todas esta opciones para que disfrutes del Centro Comercial...</strong></h4></div>
	</div>
</div>
<div class="row">
	<div id="wrapper">
		<figure>
			<div class="mis-stage">
				<ol class="mis-slider">
				<?php
				$count = 1;
				while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
					
					if($count == 1){
						$label = 'default';
						$color = '#777';
					}else if($count == 2){
						$label = 'primary';
						$color = '#337ab7';
					}else if($count == 3){
						$label = 'success';
						$color = '#5cb85c';
					}else if($count == 4){
						$label = 'info';
						$color = '#5bc0de';
					}else if($count == 5){
						$label = 'warning';
						$color = '#f0ad4e';
					}else if($count == 6){
						$label = 'danger';
						$color = '#d9534f';
					}
					
					echo '
					<li class="mis-slide">
						<a onclick="locales('.$row['id'].')" class="mis-container">
							<figure>
								<img src="subpages/categorias/'.$row['img'].'" alt="'.$row['nombre'].'" style="border:1px solid '.$color.'; width:75%;">
								<figcaption><h2><span class="label label-'.$label.'">'.$row['nombre'].'</span></h2></figcaption>
							</figure>
						</a>
					</li>
					';
					
					if($count == 6){
						$count = 0;
					}
					$count++;
				}
				?>	
				</ol>
			</div>
		</figure>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="well" style="text-align:center;"><h4><strong>Disfrutas de los estrenos y tus películas favoritas en MULTICINES</strong><h4></div>
	</div>
</div>
<style>
.multi-item-carousel{
  .carousel-inner{
    > .item{
      transition: 500ms ease-in-out left;
    }
    .active{
      &.left{
        left:-33%;
      }
      &.right{
        left:33%;
      }
    }
    .next{
      left: 33%;
    }
    .prev{
      left: -33%;
    }
    @media all and (transform-3d), (-webkit-transform-3d) {
      > .item{
        /*transition: 500ms ease-in-out left;
        transition: 500ms ease-in-out all;*/
        backface-visibility: visible;
        transform: none!important;*/
      }
    }
  }
  .carousel-control{
    &.left, &.right{
      background-image: none;
    }
	
  }
}
</style>
<div class="row" style="margin-bottom:25px;">
	<div class="col-md-10 col-md-push-1">
		<div class="carousel slide multi-item-carousel" style="background:#313b31 url('../img/bodybackground.png') repeat-y scroll 50% 0;" id="theCarousel">
			<ol class="carousel-indicators">
			<?php 
			for($i = 0; $i < $numrows; $i++){
				if($i == 0){
					echo '<li data-target="#theCarousel" data-slide-to="'.$i.'" class="active"></li>';
				}else{
					echo '<li data-target="#theCarousel" data-slide-to="'.$i.'"></li>';
				}
			}
			
			?>
			</ol>
			<div class="carousel-inner">
				<?php 
				$count = 1;
				while($row1 = $stmt1 -> fetch(PDO::FETCH_ASSOC)){
					if($count == 1){
						echo '
						<div class="item active" style="text-align:center;">
							<div class="col-xs-4">
								<a style="cursor:pointer;" onclick="open_movie('.$row1['id'].')" title="'.$row1['nombre'].'">
									<img src="subpages/cartelera/'.$row1['img'].'" width="207" height="267" alt="'.$row1['nombre'].'" border="0" />
								</a>
							</div>
						</div>
						';
					}else{
						echo '
						<div class="item" style="text-align:center;">
							<div class="col-xs-4">
								<a style="cursor:pointer;" onclick="open_movie('.$row1['id'].')" title="'.$row1['nombre'].'">
									<img src="subpages/cartelera/'.$row1['img'].'" width="207" height="267" alt="'.$row1['nombre'].'" border="0" />
								</a>
							</div>
						</div>
						';
					}
					$count++;
				}
				?>
			</div>
			<a class="left carousel-control" href="#theCarousel" data-slide="prev">
				<i class="glyphicon glyphicon-chevron-left"></i>
			</a>
			<a class="right carousel-control" href="#theCarousel" data-slide="next">
				<i class="glyphicon glyphicon-chevron-right"></i>
			</a>
		</div>
	</div>
</div>
<div class="modal fade" id="movies" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content" style="background:#313b31 url('img/bodybackground.png') repeat-y scroll 50% 0;">
			<div class="modal-header" style="border-bottom:0px;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Información de Películas</h4>
			</div>
			<div class="modal-body" style="text-align:center; color:#fff;">
				<img id="wait_movie" src="img/loading.gif" style="display:none;"/>
				<img id="imagen_movie" style="width:450px; box-shadow:5px 5px 3px #222;"/>
				<h2>Película:</h2>
				<h2 id="pelicula"></h2>
				<h4>Descripción:</h4>
				<h4 id="descripcion"></h4>
				<h4>Horarios Disponibles:</h4>
				<h4 id="horarios"></h4>
			</div>
			<div class="modal-footer" style="border-top:0px;">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12">
		<div class="well" style="text-align:center;"><h4><strong>Saber más sobre el Centro Comercial Condado Shopping</strong><h4></div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-xs-6 col-md-3" style="cursor:pointer;">
				<div style="width:100%; position:relative;">
					<a href="?modulo=eve_view" class="thumbnail">
						<img src="img/eventos.png" alt="Calendario de Eventos">
					</a>
					<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%; padding-left:15px;">
						<h4>CALENDARIO DE EVENTOS</h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3" style="cursor:pointer;">
				<div style="width:100%; position:relative;">
					<a href="?modulo=map_view" class="thumbnail">
						<img src="img/mapas.png" alt="...">
					</a>
					<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%; padding-left:15px;">
						<h4>MAPAS DEL C.C.</h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3" style="cursor:pointer;">
				<div style="width:100%; position:relative;" onclick="info_general()">
					<a class="thumbnail">
						<img src="img/info.png" alt="...">
					</a>
					<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%; padding-left:15px;">
						<h4>INFORMACION GENERAL</h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3" style="cursor:pointer;">
				<div style="width:100%; position:relative;">
					<a href="?modulo=via_view" class="thumbnail">
						<img src="img/vias.png" alt="...">
					</a>
					<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%; padding-left:15px;">
						<h4>VIAS DE EVACUACION</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-lg" id="info_general" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">INFORMACION GENERAL CONDADO SHOPPING</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>CONTÁCTANOS</strong></h3>
					</div>
					<div class="panel-body">
						<h4><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Av. Mariscal Sucre y Avenida John F. Kennedy, Quito</strong></h4>
						<h4><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>&nbsp;&nbsp;<strong>(593) 2 380 2400</strong></h4>
						<h4><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;&nbsp;<strong>info@condadoshopping.com</strong></h4>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>HORARIOS DE ATENCIÓN</strong></h3>
					</div>
					<div class="panel-body">
						<h4><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Lunes a Jueves de 10:00 am - 20:30 pm</strong></h4>
						<h4><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Viernes y Sábados de 10:00 am - 21:30 pm</strong></h4>
						<h4><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Domingos de 10:00 am - 20:00 pm</strong></h4>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>LÍNEAS DE BUSES</strong></h3>
					</div>
					<div class="panel-body">
						<h4><span class="glyphicon glyphicon-road" aria-hidden="true"></span>&nbsp;&nbsp;<strong>CATAR - Carcelén Bajo</strong></h4>
						<h4><span class="glyphicon glyphicon-road" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Mitad del Mundo</strong></h4>
						<h4><span class="glyphicon glyphicon-road" aria-hidden="true"></span>&nbsp;&nbsp;<strong>San Carlos - Condado</strong></h4>
						<h4><span class="glyphicon glyphicon-road" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Metrobus</strong></h4>
					</div>
				</div>
				<div class="alert alert-info" role="alert" style="text-align:center;"><strong>Bancos, Municipio, CNT y Multicines varian en sus horarios. Favor contactarse directamente con estos locales para mayor información.</strong></div>
				<div class="table-responsive">
					<table class="table" style="background-color:#313b31; border-radius:5px; color:#fff">
						<tr style="text-align:center;">
							<td style="vertical-align:middle;">
								<h4><strong>FACEBOOK</strong></h4>
								<img src="img/facebook.png" />
							</td>
							<td style="vertical-align:middle;">
								<h4><strong>TWITTER</strong></h4>
								<img src="img/twitter.png" />
							</td>
							<td style="vertical-align:middle;">
								<h4><strong>PINTEREST</strong></h4>
								<img src="img/pinterest.png" />
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>
var count_emo = setInterval(function(){ action_emo() }, 4000);
var contador_eventos = 1;

$(document).ready(function() {
	
	var ventana_alto = $(window).height();
	
	var alto_content = $('#front').height();
	var alto_emo = $('#position_logo_emo').height();
	
	var medio = parseInt(alto_emo) / parseInt(2);
	
	var uno = parseInt(ventana_alto) / parseInt(2);
	uno = parseInt(uno) + parseInt(300);
	$('#position_logo_emo').css('margin-bottom',uno+'px');
	
	$('#emo_logo').tooltip('show');
	
	//$('#liquid1').liquidcarousel({height:200, duration:100, hidearrows:false});
});

function action_emo(){
	if(contador_eventos == 1){
		$('#emo_logo').addClass('emo_logo_move');
		$('#emo_logo').tooltip('show');
		setTimeout(function(){ $('#emo_logo').removeClass('emo_logo_move'); }, 1500);
	}else if(contador_eventos == 2){
		$('#position_logo_emo').css({'width':'100%;'});
		$('#emo_logo').addClass('emo_slide');
		$('#emo_logo').tooltip('hide');
		setTimeout(function(){ $('#emo_logo').removeClass('emo_slide'); }, 3500);
		contador_eventos = 0;
	}
	contador_eventos++;
}

function open_teclado(){
	$('#teclado').fadeIn('show');
}

function open_movie(data){
	$('#wait_movie').fadeIn('slow');
	$.post('subpages/sistema/cartelera/ajax/datos_movie.php',{
		data : data
	}).done(function(response){
		var rsp = response.split('|');
		$('#pelicula').html('<strong>'+rsp[0]+'</strong>');
		$('#descripcion').html('<strong>'+rsp[1]+'</strong>');
		$('#horarios').html('<strong>'+rsp[2]+'</strong>');
		$('#imagen_movie').prop('src','subpages/cartelera/'+rsp[3]);
		$('#wait_movie').fadeOut('slow');
	});
	$('#movies').modal('show');
}

function locales(data){
	window.location = '?modulo=loc_view&data='+data;
}

function buscarlocal(letra){
	window.location = '?modulo=loc_view_letter&data='+letra;
}

function localxnivel(nivel){
	window.location = '?modulo=loc_view_nivel&data='+nivel;
}

function info_general(){
	$('#info_general').modal('show');
}

$('.multi-item-carousel').carousel({
	interval: 5000
});

$('.multi-item-carousel .item').each(function(){
	var next = $(this).next();
	if (!next.length) {
		next = $(this).siblings(':first');
	}
	next.children(':first-child').clone().appendTo($(this));

	if (next.next().length>0) {
		next.next().children(':first-child').clone().appendTo($(this));
	} else {
		$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
	}
});
</script>