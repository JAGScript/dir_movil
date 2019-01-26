<?php 
	$nivel = $_GET['data'];
	
	$select = "SELECT * FROM local WHERE piso_id = ? GROUP BY nombre ORDER BY nombre ASC";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array($nivel));
?>
<div class="row">
	<div class="col-md-12">
		<div class="well" style="text-align:center;">
			<h4>
				<strong>Locales en el NIVEL <?php echo $nivel;?></strong>
				<button type="button" class="btn btn-primary btn-lg pull-right" onclick="window.location='?modulo=inicio';">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<strong>Volver</strong>
				</button>
			<h4>
		</div>
	</div>
</div>
<div class="row">
	<?php 
	while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
		echo '
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail" style="background-color:transparent;">
				<img src="subpages/local/'.$row['logo'].'" alt="'.$row['local'].'">
				<div class="caption">
					<span><strong>'.$row['nombre'].'</strong></span>
					<p>
						<a onclick="ruta('.$row['id'].')" class="btn btn-primary" role="button">
							<span class="glyphicon glyphicon-marker-map"></span>
							<strong>¿Cómo llegar?</strong>
						</a> 
						<a onclick="saber_mas('.$row['id'].')" class="btn btn-default" role="button">
							<span class="glyphicon glyphicon-info-sing"></span>
							<strong>Info!</strong>
						</a>
					</p>
				</div>
			</div>
		</div>
		';
	}
	?>
</div>
<div class="modal fade bs-example-modal-lg" id="local_mas" tabindex="-1" role="dialog" aria-labelledby="local_nombre">
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
<div class="modal fade bs-example-modal-lg" id="local_ruta" tabindex="-1" role="dialog" aria-labelledby="ruta_nombre">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="background:#313b31 url('img/bodybackground.png') repeat-y scroll 50% 0;">
			<div class="modal-header" style="border-bottom:0px;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="ruta_nombre" style="color:#fff;">RUTA</h4>
			</div>
			<div class="modal-body" style="text-align:center; color:#fff;">
				<img id="wait_ruta" src="img/loading.gif" style="display:none;"/>
				<div id="datos_ruta">
					
				</div>
			</div>
			<div class="modal-footer" style="border-top:0px;">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>
function buscarlocal(letra){
	window.location = '?modulo=loc_view_letter&data='+letra;
}

function saber_mas(data){
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

function ruta(data){
	$('#wait_ruta').fadeIn('slow');
	$.post('subpages/sistema/locales/ajax/info_local_ruta.php',{
		data : data
	}).done(function(response){
		$('#datos_ruta').html(response);
		$('#wait_ruta').fadeOut('slow');
	});
	$('#local_ruta').modal('show');
}
</script>