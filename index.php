<?php 
	ini_set('memory_limit','256M');
	error_reporting(E_ALL ^ E_NOTICE);
	date_default_timezone_set('America/Guayaquil');
	session_start();
	require_once('class/public.class.php');
	require_once('class/private.db.php');
	
	header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	$gbd = new DBConn();
	
	$init = new Init;
	
	$dia = date("l");
	$numdia = date("d");
	$mes = date("F");
	$anio = date("Y");
	
	if($dia == 'Monday'){
		$dia = 'Lunes';
	}else if($dia == 'Tuesday'){
		$dia = 'Martes';
	}else if($dia == 'Wednesday'){
		$dia = 'Miercoles';
	}else if($dia == 'Thursday'){
		$dia = 'Jueves';
	}else if($dia == 'Friday'){
		$dia = 'Viernes';
	}else if($dia == 'Saturday'){
		$dia = 'Sábado';
	}else if($dia == 'Sunday'){
		$dia = 'Domingo';
	}
	
	if($mes == 'January'){
		$mes = 'Enero';
	}else if($mes == 'February'){
		$mes = 'Febrero';
	}else if($mes == 'March'){
		$mes = 'Marzo';
	}else if($mes == 'April'){
		$mes = 'Abril';
	}else if($mes == 'May'){
		$mes = 'Mayo';
	}else if($mes == 'June'){
		$mes = 'Junio';
	}else if($mes == 'July'){
		$mes = 'Julio';
	}else if($mes == 'August'){
		$mes = 'Agosto';
	}else if($mes == 'September'){
		$mes = 'Septiembre';
	}else if($mes == 'October'){
		$mes = 'Octubre';
	}else if($mes == 'November'){
		$mes = 'Noviembre';
	}else if($mes == 'December'){
		$mes = 'Diciembre';
	}
	
	$hoy = $dia.','.$numdia.' de '.$mes.' del '.$anio;
	
	$fecha_query = date("Y-m-d");
	$fecha_hora_query = date("Y-m-d H:i:s");
	
	// echo md5('calderon%2018*segu');
	// echo md5('arevalo%2018*segu');
	// echo md5('nathan42015');
	
	$selectparam = "SELECT * FROM parametros";
	$stmtparam = $gbd -> prepare($selectparam);
	$stmtparam -> execute();
	$rowparam = $stmtparam -> fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta content="True" name="'HandheldFriendly" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		<title>CONDADO SHOPPING</title>
		<link rel="stylesheet" type="text/css" href="css/somethemes.css" />
		<script src="js/jquery.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
		<script src="js/jquery.datetimepicker.js"></script>
		
		<link type="text/css" rel="stylesheet" href="css/style_menu_principal.css" />
		
		<style>
		    @font-face {font-family:'Roboto';
                src:url('fonts/Roboto-Regular.ttf') format('truetype');
                src:url('fonts/Roboto-Regular.eot');
            }
		
			html, body{
			    
			    font-family: 'Roboto', sans-serif !important;
			    
				background: #ffffff;
				background: -moz-radial-gradient(center, ellipse cover, #ffffff 0%, #e1e0e0 100%);
				background: -webkit-radial-gradient(center, ellipse cover, #ffffff 0%,#e1e0e0 100%);
				background: radial-gradient(ellipse at center, #ffffff 0%,#e1e0e0 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e1e0e0',GradientType=1 );
			}
			
			ul.form {
				position:relative;
				background:#fff;
				margin:auto;
				padding:0;
				list-style: none;
				overflow:hidden;
				
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;	
				
				-webkit-box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.1);
				-moz-box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.1);
				box-shadow:  1px 1px 10px rgba(0, 0, 0, 0.1);	
			}

			.form li a {
				padding-left:20px;
				height:50px;
				line-height:50px;
				display:block;
				overflow:hidden;
				position:relative;
				text-decoration:none;
				text-transform:uppercase;
				font-size:12px;
				color:#686868;
				cursor:pointer;
				
				-webkit-transition:all 0.2s linear;
				-moz-transition:all 0.2s linear;
				-o-transition:all 0.2s linear;
				transition:all 0.2s linear;			
			}

			.form li a:hover {
				background:#3e4e68;
				color: #fff;
			}

			.form li a.profile {
				border-left:5px solid #008747;
			}

			.form li a.messages {
					border-left:5px solid #fecf54;
			}
				
			.form li a.settings {
					border-left:5px solid #cf2130;
			}

			.form li a.logout {
					border-left:5px solid #dde2d5;
			}	

			.form li:first-child a:hover, .form li:first-child a {
				-webkit-border-radius: 5px 5px 0 0;
				-moz-border-radius: 5px 5px 0 0;
				border-radius: 5px 5px 0 0;
			}

			.form li:last-child a:hover, .form li:last-child a {
				-webkit-border-radius: 0 0 5px 5px;
				-moz-border-radius: 0 0 5px 5px;
				border-radius: 0 0 5px 5px;
			}

			.form li a:hover i {
				color:#ea4f35;
			}
			
			.form li.selected a {
				background:#3e4e68;
				color:#fff;
			}
			
			textarea {
				resize: none;
			}
			
			.pie{
				background-color:#131313;
				margin-bottom:0px;
				margin-top:10%;
				color:#fff;
			}
			
			.mayus{
				text-transform: uppercase;
			}
			
			.menulocales{
				cursor:pointer;
			}
			
			#ui-datepicker-div{
				z-index:99 !important;
			}
			
			#emo_logo{
				width:150px;
				border-radius: 10%;
				margin-left:0;
				-webkit-border-radius:10%;
				box-shadow: 0px 0px 15px 15px #ec731e;
				-webkit-box-shadow: 0px 0px 15px 15px #ec731e;
			}
			
			.emo_logo_move{
				border-radius: 50% !important;
				-webkit-border-radius:50% !important;
				transition : all .6s ease-in-out;
				-webkit-transition: all .6s ease-in-out;
				transform: rotate(360deg);
				-webkit-transform: rotate(360deg);
			}
			
			.emo_slide{
				animation-duration: 3s;
				animation-name: slidein;
				-moz-animation-duration: 3s;
				-moz-animation-name: slidein;
				-webkit-animation-duration: 3s;
				-webkit-animation-name: slidein;
			}
			
			@-moz-keyframes slidein{
				from {
					margin-left:0%;
				}
				
				to{
					margin-left:100%;
				}
			}
			
			@-webkit-keyframes slidein{
				from {
					margin-left:0%;
				}
				
				to{
					margin-left:100%;
				}
			}
			
			@keyframes slidein{
				from {
					margin-left:0%;
				}
				
				to{
					margin-left:100%;
				}
			}
			
			.borde{
				border: 15px solid #ffffff; 
				box-shadow:10px; 
				box-shadow: 10px 10px 10px 1px rgba(0,0,0,0.68);
			}
			
			.fondo{
				background: #ffffff;
				background: -moz-radial-gradient(center, ellipse cover, #ffffff 0%, #e1e0e0 100%);
				background: -webkit-radial-gradient(center, ellipse cover, #ffffff 0%,#e1e0e0 100%);
				background: radial-gradient(ellipse at center, #ffffff 0%,#e1e0e0 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e1e0e0',GradientType=1 );
			}
		</style>
		<script>
            var logEvents = false;
            var evCache = new Array();
            var prevDiff = -1;
            function enableLog(ev) {
                logEvents = logEvents ? false : true;
            }
            function log(prefix, ev) {
                if (!logEvents) return;
                var o = document.getElementsByTagName('output')[0];
                var s = prefix + ": pointerID = " + ev.pointerId +
                            " ; pointerType = " + ev.pointerType +
                            " ; isPrimary = " + ev.isPrimary;
                o.innerHTML += s + " <br>";
            } 
            function clearLog(event) {
                var o = document.getElementsByTagName('output')[0];
                o.innerHTML = "";
            }
            function pointerdown_handler(ev) {
                evCache.push(ev);
                log("pointerDown", ev);
            }
            function pointermove_handler(ev) {
                log("pointerMove", ev);
                for (var i = 0; i < evCache.length; i++) {
                    if (ev.pointerId == evCache[i].pointerId) {
                        evCache[i] = ev;
                        break;
                    }
                }
            
                if (evCache.length == 2) {
                    var curDiff = Math.abs(evCache[0].clientX - evCache[1].clientX);
                    if (prevDiff > 0) {
                        if (curDiff > prevDiff) {
                            $("#eventoloco").html("zoomIn");
                            ev.preventDefault();
                        }
                        if (curDiff < prevDiff) {
                            $("#eventoloco").html("zoomOut");
                  
                            ev.preventDefault();
                        }
                    }
                    prevDiff = curDiff;
                }
            }
            function pointerup_handler(ev) {
                log(ev.type, ev);
                remove_event(ev);
                //ev.target.style.background = "white";
                if (evCache.length < 2) prevDiff = -1;
            }
            function remove_event(ev) {
                for (var i = 0; i < evCache.length; i++) {
                    if (evCache[i].pointerId == ev.pointerId) {
                        evCache.splice(i, 1);
                        break;
                    }
                }
            }
            function init() {
            
                var el=document.getElementById("target");
                el.onpointerdown = pointerdown_handler;
                el.onpointermove = pointermove_handler;
                el.onpointerup = pointerup_handler;
                el.onpointercancel = pointerup_handler;
                el.onpointerout = pointerup_handler;
                el.onpointerleave = pointerup_handler;
            }
        </script>
	</head>
	<body onload="init();" style="touch-action:none" id="target">
	    <?php 
	    if($_SESSION['autentica'] == ''){
	        echo '<input type="hidden" id="logged" value="0" />';
	    }else{
	        echo '<input type="hidden" id="logged" value="1" />';
	    }
	    ?>
		<div id="front_cabecera" style="border:15px solid #ffffff; box-shadow:10px; box-shadow: 10px 10px 10px 1px rgba(0,0,0,0.68);">
			<img src="img/marco1.png" style="position:absolute; width:250px; z-index:39; margin-left:38%; margin-top:-15px;"/>
			<div class="row" id="contenido" style="padding-top:100px;">
				<?php if($_SESSION['autentica'] == md5('ADM_DIRECTORIO')){ ?>
				<div class="col-md-2">
					<div class="row" style="text-align:center;">
						<img src="img/logo_2.png" style="width:100px;"/>
					</div>
					<ul class="form">
						<li><a class="profile" onclick="window.location='?modulo=admin_home';"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;Inicio</a></li>
						<li><a class="messages"  onclick="window.location='?modulo=loc_lista';"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>&nbsp;&nbsp;Locales</a></li>
						<li><a class="settings"  onclick="window.location='?modulo=cat_lista';"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp;&nbsp;Categorías</a></li>
						<li><a class="logout"  onclick="window.location='?modulo=anu_lista';"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>&nbsp;&nbsp; Anuncios</a></li>
						<li><a class="profile"  onclick="window.location='?modulo=car_lista';"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp;&nbsp;Cartelera</a></li>
						<li><a class="messages"  onclick="window.location='?modulo=eve_lista';"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>&nbsp;&nbsp;Eventos</a></li>
						<li><a class="settings"  onclick="window.location='?modulo=map_lista';"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp;&nbsp;Mapas</a></li>
						<li><a class="profile"  onclick="window.location='?modulo=via_lista';"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp;&nbsp;Vías Evacuación</a></li>
						<li><a class="messages"  onclick="window.location='?modulo=par_lista';"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp;&nbsp;Parametros</a></li>
						<li><a class="logout"  onclick="window.location='subpages/sistema/ajax/logout.php';"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;Log Out</a></li>
					</ul>
				</div>
				<div class="col-md-10">
					<?php
						include($init -> subpagePath);
					?>
				</div>
				<?php }else{ ?>
				<div class="col-md-12">
					<?php
						include($init -> subpagePath);
					?>
				</div>
				<?php }?>
				<div class="row" id="scrollTop" style="position:fixed; bottom:0; right:25px; margin-bottom:25px;">
					<img src="img/scrollTop.png" style="width:75px; cursor:pointer;" onclick="scrollTop()" />
				</div>
			</div>
		</div>
		<?php if($_SESSION['autentica'] != md5('ADM_DIRECTORIO')){ ?>
		<!--<div class="row" id="position_logo_emo" style="position:fixed; bottom:0;">
			<img src="img/logo_gif.gif" id="emo_logo" data-placement="right" title="Hola! Bienvenido al Condado Shopping"/>
		</div>-->
		
		<div id="publicidad" style="display:none;">
			<?php 
			$select = "SELECT * FROM anuncios WHERE activo = ?";
			$stmt = $gbd -> prepare($select);
			$stmt -> execute(array(1));
			$numrows = $stmt -> rowCount();
			?>
			<div id="carousel" class="carousel slide" data-ride="carousel" style="background-color:#000; height:1919px;">
				<ol class="carousel-indicators">
				<?php 
				for($i = 0; $i < $numrows; $i++){
					if($i == 0){
						echo '<li data-target="#carousel" data-slide-to="'.$i.'" class="active"></li>';
					}else{
						echo '<li data-target="#carousel" data-slide-to="'.$i.'"></li>';
					}
				}
				?>
				</ol>

				<div class="carousel-inner" role="listbox">
					<?php 
					$count = 1;
					while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
						if($count == 1){
							if($row['descripcion'] == 'imagen'){
								echo '
								<div class="item active" style="text-align:center;" onclick="salirPublicidad()">
									<img src="subpages/anuncios/'.$row['img'].'" style="width:100%; height:1910px;">
								</div>
								';
							}else{
								echo '
								<div class="item active" style="text-align:center;" onclick="salirPublicidad()">
									<video style="width:100%; height:100%;">
										<source src="subpages/anuncios/'.$row['img'].'" type="video/mp4">
									</video>
								</div>		
								';
							}
						}else{
							if($row['descripcion'] == 'video'){
								echo '
								<div class="item" style="text-align:center;" onclick="salirPublicidad()">
									<video style="width:100%; autoplay height:100%;">
										<source src="subpages/anuncios/'.$row['img'].'" type="video/mp4">
									</video>
								</div>	
								';
							}else{
								echo '
								<div class="item" style="text-align:center;" onclick="salirPublicidad()">
									<img src="subpages/anuncios/'.$row['img'].'" style="width:100%; height:1910px;">
								</div>
								';
							}
						}
						$count++;
					}
					?>	
				</div>
				<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		
		<?php }?>
	</body>
</html>
<div class="modal fade" id="vacio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Alerta!</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert">Los campos estan <strong>vacíos</strong>, llenelos para continuar.</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="guardado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Alerta!</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info" role="alert">La información ingresada se ha <strong>guardado</strong> con éxito.</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="window.location='';">Aceptar</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$( function(){
	$( "#emo_logo" ).draggable();
});

$('#carousel').on('slid.bs.carousel', function (e) {
   let elemento = $('#carousel .item.active video').first();
   if (elemento.prop("tagName") == "VIDEO") {
     elemento.get(0).play();

   }
});

$('#carousel').bind('slide.bs.carousel', function (e) {  
   let elemento = $('#carousel .item.active video').first();
   if (elemento.prop("tagName") == "VIDEO") {
     elemento.get(0).pause();
   }
});

$(document).ready(function(){
	var ventana_alto = $(window).height();
	var alto_content = $('#contenido').height();
	
	var alto_footer = $('.pie_pagina').height();
	
	var tamano = parseInt(alto_content) + parseInt(100);
	
	
	if(alto_content < 1900){
		$('#front_cabecera').css('height',ventana_alto+'px');
	}else{
		
		$('#front_cabecera').css('height',tamano+'px');
	}
	
	$('#carousel').carousel({
		interval: 120000
    });
	
	$('#scrollTop').click(function (){
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});
	
    $(document).bind("contextmenu",function(e){
        return false;
    });

});




$("body").mousemove(function(){
	segundos = 0;
	clearInterval(intervalo);
	intervalo = setInterval(cantidadSegundos, 1000);
});

$(function() {
    $(window).scroll(function() {
        segundos = 0;
    	clearInterval(intervalo);
    	intervalo = setInterval(cantidadSegundos, 1000);
    });
});

var segundos = 0;
var intervalo = 0;
function cantidadSegundos(){
	var URLactual = window.location.href;
	var logged = $('#logged').val();
	if(logged == 1){
	    
	}else if(logged == 0){
    	segundos ++;
    	if(URLactual == 'http://www.autorizacionsmo.com/dir4/?modulo=eve_view'){
    		if (segundos >= 60){
    			$('#front_cabecera').fadeOut('slow');
    			$('#publicidad').delay(600).fadeIn('slow');
    			$('.modal').modal('hide');
    
    		}
    	}else{
    		if (segundos >= 10){
    			$('#front_cabecera').fadeOut('slow');
    			$('#publicidad').delay(600).fadeIn('slow');
    			$('.modal').modal('hide');
    
    		}
    	}
	}
}

function salirPublicidad(){
	segundos = 0;
	window.location = '?modulo=inicio';
}

$.datepicker.regional['es'] = {
	closeText: 'Cerrar',
	prevText: '<Ant',
	nextText: 'Sig>',
	currentText: 'Hoy',
	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	weekHeader: 'Sm',
	dateFormat: 'yy-mm-dd',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: '',
	minDate: 0
};
$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
	$(".datepicker").datepicker();
});

function mayus(value,t){
	var valor = value.toUpperCase();
	$(t).val(valor);
}

function justInt(e,value,t){
    if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105 || e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 37 || e.keyCode == 39 || e.keyCode == 13)){
        return;
	}else{
		$(t).val('');
        e.preventDefault();
	}
}

function justDouble(e,value,t){
    if(e.keyCode >= 48 && e.keyCode <= 57 || '.'){
        return;
	}else{
		$(t).val('');
        e.preventDefault();
	}
}
	
function justText(e,value,t){
	if(e.keyCode >= 65 && e.keyCode <= 90 || e.keyCode == 37 || e.keyCode == 39 || e.keyCode == 8 || e.keyCode == 46 || e.keyCode == 9 || e.which == 0 || e.keyCode == 32){
		return;
	}else{
		e.preventDefault();
	}
}	

function validarMail(value,t){
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(value) ){
		$(t).val('');
		$('#errormail').modal('show');
	}
}

$('.signos').keydown(function(event){
	if(event.keyCode == 60 || event.keyCode == 62 || event.keyCode == 42 || event.keyCode == 92 || event.keyCode == 91 || event.keyCode == 93 || event.keyCode == 123 || event.keyCode == 125 || event.keyCode == 124 || event.altKey){
		event.preventDefault();
	}else{
		return;
		// alert('alt');
	}
});

function ValidarDocumento(numero,t){
	if((numero[0] == 'p')||(numero[0] == 'P')){
		pasaporte(numero,t);
	}else if((numero[0] >= 0) || (numero[0] <= 9)){
		ValidarCedula(numero,t);
	}else{
		$(t).val('');
    	$('#errorcedula').modal('show');
    }
}

function pasaporte(numero,t){
	if(numero.length<3||numero.length>13){
		console.log('Pasaporte incorrecto');
		$(t).val('');
      	$('#errorcedula').modal('show');
		return false;
	}else{
		if(numero[0]=='p'||numero[0]=='P'){
			return true;
		}else{
			console.log('Pasaporte incorrecto');
			$(t).val('');
			$('#errorcedula').modal('show');
			return false;
		}
	}
}

function ValidarCedula(valor,t){
	var numero = valor;
	var suma = 0;
	var residuo = 0;
	var pri = false;
	var pub = false;
	var nat = false;
	var numeroProvincias = 24;
	var modulo = 11;

	var ok=1;
	
	d1 = numero.substr(0,1);
	d2 = numero.substr(1,1);
	d3 = numero.substr(2,1);
	d4 = numero.substr(3,1);
	d5 = numero.substr(4,1);
	d6 = numero.substr(5,1);
	d7 = numero.substr(6,1);
	d8 = numero.substr(7,1);
	d9 = numero.substr(8,1);
	d10 = numero.substr(9,1);

	if (d3==7 || d3==8){
		$(t).val('');
		$('#errorcedula').modal('show');
		return false;
	}

	if (d3 < 6){
		nat = true;
		p1 = d1 * 2; if (p1 >= 10) p1 -= 9;
		p2 = d2 * 1; if (p2 >= 10) p2 -= 9;
		p3 = d3 * 2; if (p3 >= 10) p3 -= 9;
		p4 = d4 * 1; if (p4 >= 10) p4 -= 9;
		p5 = d5 * 2; if (p5 >= 10) p5 -= 9;
		p6 = d6 * 1; if (p6 >= 10) p6 -= 9;
		p7 = d7 * 2; if (p7 >= 10) p7 -= 9;
		p8 = d8 * 1; if (p8 >= 10) p8 -= 9;
		p9 = d9 * 2; if (p9 >= 10) p9 -= 9;
		modulo = 10;
	}

	else if(d3 == 6){
		pub = true;
		p1 = d1 * 3;
		p2 = d2 * 2;
		p3 = d3 * 7;
		p4 = d4 * 6;
		p5 = d5 * 5;
		p6 = d6 * 4;
		p7 = d7 * 3;
		p8 = d8 * 2;
		p9 = 0;
	}

	else if(d3 == 9) {
		pri = true;
		p1 = d1 * 4;
		p2 = d2 * 3;
		p3 = d3 * 2;
		p4 = d4 * 7;
		p5 = d5 * 6;
		p6 = d6 * 5;
		p7 = d7 * 4;
		p8 = d8 * 3;
		p9 = d9 * 2;
	}

	suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
	residuo = suma % modulo;

	digitoVerificador = residuo==0 ? 0: modulo - residuo;

	if (pub==true){
		if (digitoVerificador != d9){
			$(t).val('');
			$('#errorcedula').modal('show');
			return false;
		}
		if ( numero.substr(9,4) != '0001' ){
			$(t).val('');
			$('#errorcedula').modal('show');
			return false;
		}
	}
	else if(pri == true){
		if (digitoVerificador != d10){
			$(t).val('');
			$('#errorcedula').modal('show');
			return false;
		}
		if ( numero.substr(10,3) != '001' ){
			$(t).val('');
			$('#errorcedula').modal('show');
			return false;
		}
	}

	else if(nat == true){
		if (digitoVerificador != d10){
			$(t).val('');
			$('#errorcedula').modal('show');
			return false;
		}
		if (numero.length >10 && numero.substr(10,3) != '001' ){
			$(t).val('');
			$('#errorcedula').modal('show');
			return false;
		}
	}
	return true;
}
</script>