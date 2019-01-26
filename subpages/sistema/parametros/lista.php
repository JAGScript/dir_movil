<?php 
	include('subpages/sistema/ajax/seguridad.php');
	
	$select = "SELECT * FROM parametros";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute();
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	$id = $row['id'];
?>
<div class="row">
	<div class="col-md-12" style="text-align:center;">
		<h2><span class="label label-warning">Parametros</span></h2>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12">
		<div class="col-md-8 col-md-push-2">
			<div class="col-md-12">
				<h4><strong>Nombre del Nivel:</strong></h4>
				<input type="text" class="form-control mayus" id="nombre" value="<?php echo $row['nombre'];?>" placeholder="Ingrese el nombre del nivel..." />
			</div>
			<div class="col-md-12">
				<h4><strong>Descripción:</strong></h4>
				<input type="text" class="form-control mayus" id="descripcion" value="<?php echo $row['des'];?>" placeholder="Detalle ubicación..." />
			</div>
			<div class="col-md-12">
				<h4><strong>Color:</strong></h4>
				<input type="text" class="form-control mayus" id="color" value="<?php echo $row['color'];?>" placeholder="Ingrese el color en Hexadecimal..." />
			</div>
			<div class="col-md-12 pull-right" style="margin-top:50px;">
				<button class="btn btn-default btn-lg" type="button" onclick="window.location='';">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					Cancelar
				</button>
				<button class="btn btn-primary btn-lg" id="btn_guardar" type="button" onclick="guardar(<?php echo $id;?>)">
					<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
					Guardar
				</button>
				<img src="img/loading.gif" id="wait" style="width:45px; display:none;"/>
			</div>
		</div>
	</div>
</div>
<script>
function guardar(data){
	var nombre = $('#nombre').val();
	var color = $('#color').val();
	var descripcion = $('#descripcion').val();
	$('#btn_guardar').fadeOut('slow');
	$('#wait').delay(600).fadeIn('slow');
	$.post('subpages/sistema/parametros/ajax/guardar.php',{
		data : data, nombre : nombre, descripcion : descripcion, color : color
	}).done(function(response){
		$('#wait').fadeOut('slow');
		$('#guardado').modal('show');
	});
}
</script>