<?php 
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$data = $_POST['data'];
	
	$select = "SELECT * FROM cartelera WHERE id = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array($data));
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	
	$nombre = $row['nombre'];
	$descripcion = $row['descripcion'];
	$horarios = $row['horario'];
	$imagen = $row['img'];
	$sinopsis = $row['sinopsis'];
	$link = $row['link'];
	
	echo $nombre.'|'.$descripcion.'|'.$horarios.'|'.$imagen.'|'.$sinopsis.'|'.$link;
?>