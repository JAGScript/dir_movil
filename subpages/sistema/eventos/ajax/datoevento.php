<?php 
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$id = $_POST['data'];
	
	$select = "SELECT * FROM eventos WHERE id = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array($id));
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	
	$img = $row['img'];
	$video = $row['video'];
	$nombre = $row['nombre'];
	$des = $row['descripcion'];
	
	if($video == ''){
		$video_tag = '<img src="subpages/eventos/'.$img.'"/>';
	}else{
		$video_tag = '
		<iframe class="tscplayer_inline" height="480" width="640" name="tsc_player" src="subpages/eventos/'.$video.'" scrolling="no" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		';
	}

	
	
	echo $img.'|'.$nombre.'|'.$des.'|'.$video_tag;
?>