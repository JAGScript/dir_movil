<?php 
	$select = "SELECT * FROM mapas WHERE activo = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array(1));
?>
<script src="js/jquery.mapimages.js"></script>
<link rel="stylesheet" type="text/css" href="css/pop-up-mapas.css"/>
<div class="row" style="margin-bottom:50px;">
	<div class="col-md-12">
		<div class="well" style="text-align:center;">
			<h4>
				<strong>MAPAS DEL CENTRO COMERCIAL</strong>
				<button type="button" class="btn btn-primary btn-lg pull-right" onclick="window.location='?modulo=inicio';">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<strong>Volver</strong>
				</button>
			<h4>
		</div>
	</div>
</div>
<div class="row" style="margin-top:20%;">
	<div class="col-md-12">
		<?php 
		while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
			echo '
			<div class="col-xs-6 col-md-6">
				<div style="width:100%; position:relative; cursor:pointer;" onclick="open_mapa('.$row['id'].')">
					<a class="thumbnail">
						<img src="subpages/mapas/'.$row['img'].'" alt="'.$row['nombre'].'">
					</a>
					<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%; padding-left:15px;">
						<h4>'.$row['nombre'].'</h4>
					</div>
					<div style="position:absolute; top:0; right:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:50%; padding-left:15px;">
						<span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span>&nbsp;<strong> Presiona para abrir</strong>
					</div>
				</div>
			</div>
			';
		}
		?>
	</div>
</div>
<div class="contenedor-super">
	<div class="ventana-content mapa-zoomout">
		<div id="img_info" style="position:relative;">
			
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-lg" id="local_mas" tabindex="-1" role="dialog" aria-labelledby="local_nombre" style="margin-top:40%;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="background:#313b31 url('img/bodybackground.png') repeat-y scroll 50% 0;">
			<div class="modal-header" style="border-bottom:0px;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="local_nombre" style="color:#fff;"></h4>
			</div>
			<div class="modal-body" style="text-align:center; color:#fff;">
				<img id="wait_local" src="img/loading.gif" style="display:none;"/>
				<div class="table-responsive">
					<table class="table">
						<tr>
							<td rowspan="4" style="text-align:center; vertical-align:middle; border-top:0px;">
								<img id="img_local" style="width:300px; background-color:#fff; border-radius:50%;"/>
							</td>
							<td style="border-top:0px;">
								<h4>Local:</h4>
							</td>
							<td style="border-top:0px;">
								<h4 id="nombre_local"></h4>
							</td>
						</tr>
						<tr>
							<td style="border-top:0px;">
								<h4>Descripción:</h4>
							</td>
							<td style="border-top:0px;">
								<strong id="des_local"></strong>
							</td>
						</tr>
						<tr>
							<td style="border-top:0px;">
								<h4>Número de Local:</h4>
							</td>
							<td style="border-top:0px;">
								<h4 id="numero_local"></h4>
							</td>
						</tr>
						<tr>
							<td style="border-top:0px;">
								<h4>Ubicación:</h4>
							</td>
							<td style="border-top:0px;">
								<h4 id="ubicacion_local"></h4>
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
$(document).ready(function() {
	
	
	
});

function open_mapa(data){
	$.post('subpages/sistema/mapas/ajax/infomapas.php',{
		data : data
	}).done(function(response){
		var respuesta = response.split('|');
		$('#img_info').html(respuesta[0]);
		$('#'+respuesta[1]).rwdImageMaps();
		$('.contenedor-super').fadeIn(function() {
			
			window.setTimeout(function(){
				$('.ventana-content.mapa-zoomout').addClass('ventana-content-visible');
			}, 100);
			
		});
		
	});
}

function btn_close_map(){
	$('.contenedor-super').fadeOut().end().find('.ventana-content').removeClass('ventana-content-visible');
}

function info_local(data){
	$('#wait_local').fadeIn('slow');
	$.post('subpages/sistema/locales/ajax/info_local.php',{
		data : data
	}).done(function(response){
		var rsp = response.split('|');
		$('#img_local').prop('src','subpages/local/'+rsp[0]);
		$('#nombre_local').html('<strong>'+rsp[1]+'</strong>');
		$('#des_local').html(rsp[2]);
		$('#numero_local').html('<strong>'+rsp[3]+'</strong>');
		$('#ubicacion_local').html('<strong>Nivel '+rsp[4]+'</strong>');
		$('#local_nombre').html('<strong>'+rsp[1]+'</strong>');
		$('#wait_local').fadeOut('slow');
	});
	$('#local_mas').modal('show');
}
</script>