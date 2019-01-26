<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$imagen = $_POST['imagen'];
	$nombre = strtoupper($_POST['nombre']);
	
	try{
		$insert = "INSERT INTO mapas VALUES (?, ?, ?, ?)";
		$ins = $gbd -> prepare($insert);
		$ins -> execute(array('NULL',$nombre,$imagen,1));
	
		echo 'ok';
	}catch(PDOException $e){
		print_r($e);
	}
?>