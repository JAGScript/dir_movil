<?php 
	$select = "SELECT * FROM categoria WHERE activo = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array(1));
	$count = $stmt -> rowCount();
?>
<div class="row" style="margin-bottom:50px;">
	<div class="col-md-12">
		<div class="well" style="text-align:center;">
			<h4>
				<strong>Hemos categorizado nuestros locales para una mejor búsqueda</strong>
				<button type="button" class="btn btn-primary btn-lg pull-right" onclick="window.location='?modulo=loc_menu';">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<strong>Volver</strong>
				</button>
			<h4>
		</div>
	</div>
</div>
<div class="row">
	<?php
	$num = 1;
	while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
		
		if($num == 1){
			$color = '#cebf45';
		}else if($num == 2){
			$color = '#cb8a43';
		}else if($num == 3){
			$color = '#5376a0';
		}else if($num == 4){
			$color = '#9fac68';
		}else if($num == 5){
			$color = '#bc3a82';
		}
		
		if($row['nombre'] == 'ENTRETENIMIENTO'){
			$left = '3px';
		}else{
			$left = '15px';
		}
		
		echo '
		<div class="col-md-3">
			<div onclick="categoria('.$row['id'].')" style="background-color:'.$color.'; color:#fff; border-radius:10px; border:1px solid '.$color.'; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); margin-bottom:20px;">
				<img src="img/bag_back.png" style="width:100%; opacity:0.3;"/>
				<div style="position:absolute; bottom:20px; background:rgba(0, 0, 0, 0.57); color:#fff; width:90.5%; padding-left:'.$left.'; border-bottom-right-radius:10px; border-bottom-left-radius:10px;">
					<h3><strong>'.$row['nombre'].'</strong></h3>
				</div>
			</div>
		</div>
		';
		if($num == 5){
			$num = 0;
		}
		$num++;
	}
	?>
	<div class="col-md-3">
		
	</div>
</div>
<script>
function categoria(data){
	window.location = '?modulo=loc_categoria&data='+data;
}
</script>