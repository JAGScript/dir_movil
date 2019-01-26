<?php 
	include('subpages/sistema/ajax/seguridad.php');
	
	$id = $_GET['data'];
	
	$select = "SELECT * FROM local WHERE id = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array($id));
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
?>
<script src="js/ajaxupload.js"></script>
<div class="row">
	<div class="col-md-12" style="text-align:center;">
		<h2><span class="label label-primary">Editar Local</span></h2>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12" style="text-align:right;">
		<button class="btn btn-primary" type="button" onclick="window.location='?modulo=loc_lista';">
			<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			Lista de Locales
		</button>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4><strong>Nombre del Local:</strong></h4>
		<input type="text" class="form-control mayus" id="nombre" placeholder="Ingrese nombre del local..." value="<?php echo $row['nombre'];?>" />
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4><strong>Descripción:</strong></h4>
		<textarea class="form-control mayus" rows="5" id="descripcion" placeholder="Ingrese una descripción del Local"><?php echo $row['descricpion'];?></textarea>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4><strong>Coords:</strong></h4>
		<textarea class="form-control mayus" rows="3" id="coords" placeholder="Coordenadas del Local"><?php echo $row['coordenadas'];?></textarea>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<div class="col-md-6">
			<h4><strong>Número de Local:</strong></h4>
			<input type="text" class="form-control mayus" id="numero" placeholder="Ingrese número del local..." value="<?php echo $row['numero'];?>" />
		</div>
		<div class="col-md-6">
			<h4><strong>Ubicación:</strong></h4>
			<select class="form-control" id="nivel">
				<option value="0">Seleccione...</option>
				<option value="1">Nivel 1</option>
				<option value="2">Nivel 2</option>
				<option value="3">Nivel 3</option>
				<option value="4">Nivel 4</option>
			</select>
		</div>
	</div>
</div>
<div class="row" style="margin-top:50px;">
	<div class="col-md-12" style="text-align:right;">
		<button class="btn btn-default btn-lg" type="button" onclick="window.location='';">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			Cancelar
		</button>
		<button class="btn btn-primary btn-lg" id="btn_guardar" type="button" onclick="guardar('<?php echo $id;?>')">
			<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
			Guardar
		</button>
		<img src="img/loading.gif" id="wait" style="width:45px; display:none;"/>
	</div>
</div>
<script>
function guardar(data){
	var nombre = $('#nombre').val();
	var descripcion = $('#descripcion').val();
	var coords = $('#coords').val();
	var numero = $('#numero').val();
	var nivel = $('#nivel').val();
	
	if((nombre == '') || (descripcion == '') || (numero == '') || (nivel == '')){
		$('#vacio').modal('show');
	}else{
		$('#btn_guardar').fadeOut('slow');
		$('#wait').delay(600).fadeIn('slow');
		$.post('subpages/sistema/locales/ajax/edicion.php',{
			nombre : nombre, descripcion : descripcion, numero : numero, nivel : nivel, coords : coords, data : data
		}).done(function(response){
			$('#wait').fadeOut('slow');
			$('#guardado').modal('show');
		});
	}
}
</script>