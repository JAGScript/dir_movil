<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$nombre = strtoupper($_POST['nombre']);
	$descripcion = strtoupper($_POST['descripcion']);
	$horarios = strtoupper($_POST['horarios']);
	$fechainicio = strtoupper($_POST['fechainicio']);
	$fechafin = strtoupper($_POST['fechafin']);
	$imagen = $_POST['imagen'];
	$link = '';
	$sinopsis = $_POST['sinopsis'];
	
	try{
		$insert = "INSERT INTO cartelera VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$ins = $gbd -> prepare($insert);
		$ins -> execute(array('NULL',$nombre,$descripcion,$horarios,$imagen,$sinopsis,$link,$fechainicio,$fechafin,1));
	
		echo 'ok';
	}catch(PDOException $e){
		print_r($e);
	}
?>