<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$nombre = strtoupper($_POST['nombre']);
	$imagen = $_POST['imagen'];
	
	try{
		$insert = "INSERT INTO categoria VALUES (?, ?, ?, ?)";
		$ins = $gbd -> prepare($insert);
		$ins -> execute(array('NULL',$nombre,$imagen,1));
	
		echo 'ok';
	}catch(PDOException $e){
		print_r($e);
	}
?>