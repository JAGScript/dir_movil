<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$fechainicio = $_POST['fechainicio'];
	$fechafin = $_POST['fechafin'];
	$imagen = $_POST['imagen'];
	$video = $_POST['video'];
	$nombre = strtoupper($_POST['nombre']);
	$descripcion = strtoupper($_POST['descripcion']);
	
	try{
		$insert = "INSERT INTO eventos VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$ins = $gbd -> prepare($insert);
		$ins -> execute(array('NULL',$imagen,$video,$nombre,$descripcion,$fechainicio,$fechafin,1));
	
		echo 'ok';
	}catch(PDOException $e){
		print_r($e);
	}
?>