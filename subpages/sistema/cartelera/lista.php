<?php 
	include('subpages/sistema/ajax/seguridad.php');
	
	$select = "SELECT * FROM cartelera";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute();
?>
<div class="row">
	<div class="col-md-12" style="text-align:center;">
		<h2><span class="label label-warning">Cartelera</span></h2>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12" style="text-align:right;">
		<button class="btn btn-primary" type="button" onclick="window.location='?modulo=car_nuevo';">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			Nuevo
		</button>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-3"></div>
	<div class="col-md-2" style="text-align:right;">
		<h4>Buscar por:</h4>
	</div>
	<div class="col-md-2" style="text-align:right;">
		<select class="form-control" id="buscador">
			<option value="0">Seleccione...</option>
			<option value="1">Película</option>
		</select>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12">
		<div class="table-responsive" id="datos">
			<table class="table table-hover">
				<tr style="text-align:center;">
					<td><strong>#</strong></td>
					<td><strong>Película</strong></td>
					<td><strong>Descripción</strong></td>
					<td><strong>Horarios</strong></td>
					<td><strong>Imagen</strong></td>
					<td><strong>Estado</strong></td>
					<td><strong>Editar</strong></td>
					<td><strong>Eliminar</strong></td>
				</tr>
				<?php 
				$count = 1;
				while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
					if($row['activo'] = 1){
						$estado = 'Activo';
						$color = '#f0ad4e';
					}else if($row['activo'] = 0){
						$estado = 'Inactivo';
						$color = '#d9534f';
					}
					echo '
					<tr style="text-align:center;">
						<td style="vertical-align:middle;">'.$count.'</td>
						<td style="vertical-align:middle;">'.$row['nombre'].'</td>
						<td style="vertical-align:middle;">'.$row['descripcion'].'</td>
						<td style="vertical-align:middle;">'.$row['horario'].'</td>
						<td><img src="subpages/cartelera/'.$row['img'].'" style="max-width:100px;"/></td>
						<td style="vertical-align:middle;">'.$estado.'</td>
						<td style="vertical-align:middle;">
							<button type="button" class="btn btn-primary" onclick="editar('.$row['id'].')">
								<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
							</button>
						</td>
						<td style="vertical-align:middle;">
							<button type="button" class="btn btn-danger" onclick="eliminar()">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button>
						</td>
					</tr>
					';
					
					$count++;
				}
				?>
			</table>
		</div>
	</div>
</div>
<script>
function editar(data){
    window.location = '?modulo=car_editar&data='+data;
}
</script>