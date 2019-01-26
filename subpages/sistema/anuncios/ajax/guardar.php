<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$fechainicio = $_POST['fechainicio'];
	$fechafin = $_POST['fechafin'];
	$imagen = $_POST['imagen'];
	$des = $_POST['des'];
	
	try{
		$insert = "INSERT INTO anuncios VALUES (?, ?, ?, ?, ?, ?)";
		$ins = $gbd -> prepare($insert);
		$ins -> execute(array('NULL',$imagen,$fechainicio,$fechafin,$des,1));
	
		echo 'ok';
		
		// print_r($_POST);
	}catch(PDOException $e){
		print_r($e);
	}
?>