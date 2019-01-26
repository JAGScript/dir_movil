<?php 
	$select = "SELECT * FROM vias WHERE activo = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array(1));
?>
<link rel="stylesheet" type="text/css" href="css/pop-up-mapas.css"/>
<div class="row" style="margin-bottom:50px;">
	<div class="col-md-12">
		<div class="well" style="text-align:center;">
			<h4>
				<strong>VIAS DE EVACUACION DEL CENTRO COMERCIAL</strong>
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
			<div class="col-md-6 col-md-6">
				<div style="width:100%; position:relative; cursor:pointer;" onclick="open_mapa('.$row['id'].')">
					<a class="thumbnail">
						<img src="subpages/vias/'.$row['img'].'" alt="'.$row['nombre'].'">
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
<script>
function open_mapa(data){
	$.post('subpages/sistema/vias/ajax/infomapas.php',{
		data : data
	}).done(function(response){
		$('#img_info').html(response);
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
</script>