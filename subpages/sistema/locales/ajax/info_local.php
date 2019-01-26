<?php 
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$id = $_POST['data'];
	
	$select = "SELECT * FROM local WHERE id = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array($id));
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	
	$nombre = $row['nombre'];
	$logo = $row['logo'];
	$des = strtoupper($row['descricpion']);
	$piso = $row['piso_id'];
	$numero = $row['numero'];
	
	echo $logo.'|'.$nombre.'|'.$des.'|'.$numero.'|'.$piso;
	
?>