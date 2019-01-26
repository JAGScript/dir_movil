<?php 
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$id = $_POST['data'];
	
	$select = "SELECT * FROM local WHERE id = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array($id));
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	
	$ruta = $row['ruta'];
	$piso = $row['piso_id'];
	
	// if($ruta == ''){
		// $ruta = 'trabajando.png';
	// }else{
		// $ruta = $ruta;
	// }
	
	// <img id="ruta" style="width:850px;"/>
	
	if($piso == 1){
		echo '
		<div style="position:relative;">
			<img src="subpages/ruta/rutaN1.png" />
			<img style="position:absolute; top:0; left:35px;" src="subpages/ruta/'.$ruta.'" />
		</div>
		';
	}else if($piso == 2){
		echo '
		<div style="position:relative;">
			<img src="subpages/ruta/rutaN2.png" />
			<img style="position:absolute; top:0; left:35px;" src="subpages/ruta/'.$ruta.'" />
		</div>
		';
	}else if($piso == 3){
		echo '
		<div style="position:relative;">
			<img src="subpages/ruta/rutaN3.png" />
			<img style="position:absolute; top:0; left:35px;" src="subpages/ruta/'.$ruta.'" />
		</div>
		';
	}else if($piso == 4){
		echo '
		<div style="position:relative;">
			<img src="subpages/ruta/rutaN4.png" />
			<img style="position:absolute; top:0; left:35px;" src="subpages/ruta/'.$ruta.'" />
		</div>
		';
	}
	
	// echo '
	// <div style="position:relative;">
		// <img src="subpages/ruta/rutaN3.png" />
		// <img style="position:absolute;" src="subpages/ruta/ruta_taty2.gif" />
	// </div>
	// ';
	
	// echo $ruta;
	
?>