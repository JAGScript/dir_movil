<?php 
	$select = "SELECT CONCAT(anio,'-',mes) as fecha FROM eventos GROUP BY mes ORDER BY fecha DESC";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute();
	
	$content = 'La campaña entro en vigencia el 24 de enero del 2018 en la cual por cada 25 dólares de consumo en el centro comercial reciben 1 cupón para participar en el sorteo de un crucero por Europa para dos personas que parte desde Venecia. Se realizaron actividades desde el 12 al 14 de febrero haciendo énfasis en la temática de San Valentín. El sorteo del crucero se realizó el 14 de febrero de 2018..';
	
	$insert = "UPDATE eventos SET descripcion = ? WHERE id = ?";
	$ins = $gbd -> prepare($insert);
	$ins -> execute(array($content,7));
?>
<div class="row" style="margin-bottom:50px;">
	<div class="col-md-12">
		<div class="well" style="text-align:center;">
			<h4>
				<strong>EVENTOS  DEL CENTRO COMERCIAL</strong>
				<button type="button" class="btn btn-primary btn-lg pull-right" onclick="window.location='?modulo=inicio';">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<strong>Volver</strong>
				</button>
			<h4>
		</div>
	</div>
</div>
<?php
	while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
		$mes = explode('-',$row['fecha']);
		if($mes[1] == '01'){
			$nom_mes = 'Enero '.$mes[0];
		}else if($mes[1] == '02'){
			$nom_mes = 'Febrero '.$mes[0];
		}else if($mes[1] == '03'){
			$nom_mes = 'Marzo '.$mes[0];
		}else if($mes[1] == '04'){
			$nom_mes = 'Abril '.$mes[0];
		}else if($mes[1] == '05'){
			$nom_mes = 'Mayo '.$mes[0];
		}else if($mes[1] == '06'){
			$nom_mes = 'Junio '.$mes[0];
		}else if($mes[1] == '07'){
			$nom_mes = 'Julio '.$mes[0];
		}else if($mes[1] == '08'){
			$nom_mes = 'Agosto '.$mes[0];
		}else if($mes[1] == '09'){
			$nom_mes = 'Septiembre '.$mes[0];
		}else if($mes[1] == '10'){
			$nom_mes = 'Octubre '.$mes[0];
		}else if($mes[1] == '11'){
			$nom_mes = 'Noviembre '.$mes[0];
		}else if($mes[1] == '12'){
			$nom_mes = 'Diciembre '.$mes[0];
		}
		echo '
		<div class="col-md-12">
			<div class="alert alert-info" role="alert">
				<h3><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><strong> '.$nom_mes.'</strong><h3>
			</div>
		</div>
		<div class="col-md-12">';
		
			$select1 = "SELECT * FROM eventos WHERE mes = ? ORDER BY dia ASC";
			$stmt1 = $gbd -> prepare($select1);
			$stmt1 -> execute(array($mes[1]));
			
			while($row1 = $stmt1 -> fetch(PDO::FETCH_ASSOC)){
				echo '
				<div class="col-xs-6 col-md-4">
					<div style="width:100%; position:relative; cursor:pointer;" onclick="open_eventos('.$row1['id'].')">
						<a class="thumbnail">
							<img src="subpages/eventos/'.$row1['img'].'" alt="'.$row1['nombre'].'" style="height:190px;">
						</a>
						<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%; padding-left:15px;">
							<h4>'.$row1['nombre'].'</h4>
						</div>
					</div>
				</div>
				';
			}
		echo '</div>';
	}
?>
<div class="modal fade bs-example-modal-lg" id="evento_mas" tabindex="-1" role="dialog" aria-labelledby="evento_nombre" style="margin-top:20%;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content borde fondo">
			<img src="img/marco1.png" style="position:absolute; width:200px; z-index:39; margin-left:38%; margin-top:-15px;"/>
			<div class="modal-header" style="border-bottom:0px; margin-top:75px;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="evento_nombre" style="text-align:center;"><strong>Detalle del Evento</strong></h4>
			</div>
			<div class="modal-body" style="text-align:center;">
				<img id="wait_local" src="img/loading.gif" style="display:none;"/>
				<div class="table-responsive">
					<table class="table">
						<tr>
							<td style="text-align:center; vertical-align:middle; border-top:0px;">
								<h4>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									 Evento: <span id="nombre_evento"></span>
								</h4>
							</td>
						</tr>
						<tr>
							<td style="text-align:center; vertical-align:middle; border-top:0px;">
								<img id="img_evento"/>
							</td>
						</tr>
						<tr>
							<td style="text-align:center; vertical-align:middle; border-top:0px;">
								<h4>
									<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
									 Descripción:
								</h4>
								<h4><strong id="des_evento"></strong></h4>
							</td>
						</tr>
						<tr>
							<td style="text-align:center; vertical-align:middle; border-top:0px;">
								<strong id="des_evento"></strong>
							</td>
						</tr>
						<tr>
							<td id="video_evento" style="text-align:center; vertical-align:middle; border-top:0px;">
								
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="modal-footer" style="border-top:0px;">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>
var count_emo = setInterval(function(){ action_emo() }, 4000);
var contador_eventos = 1;

$(document).ready(function(){
	$('.slide_eventos').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 3000,
	});
	
	//emoticon
	var ventana_alto = $(window).height();
	
	var alto_content = $('#front').height();
	var alto_emo = $('#position_logo_emo').height();
	
	var uno = parseInt(ventana_alto) - parseInt(alto_emo);
	//uno = parseInt(uno) - parseInt(medio);
	$('#position_logo_emo').css('margin-bottom',uno+'px');
	
	$('#emo_logo').tooltip('show');
	
});

function action_emo(){
	$('#emo_logo').addClass('emo_logo_move');
	$('#emo_logo').tooltip('show');
	setTimeout(function(){ $('#emo_logo').removeClass('emo_logo_move'); }, 1500);
}

function open_eventos(data){
	$.post('subpages/sistema/eventos/ajax/datoevento.php',{
		data : data
	}).done(function(response){
		var rsp = response.split('|');
		$('#img_evento').prop('src','subpages/eventos/'+rsp[0]);
		$('#video_evento').html(rsp[3]);
		$('#nombre_evento').html('<strong>'+rsp[1]+'</strong>');
		$('#des_evento').html(rsp[2]);
	});
	$('#evento_mas').modal('show');
}
</script>