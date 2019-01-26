<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$descripcion = str_replace('á','Á',$descripcion);
	$descripcion = str_replace('é','É',$descripcion);
	$descripcion = str_replace('í','Í',$descripcion);
	$descripcion = str_replace('ó','Ó',$descripcion);
	$descripcion = str_replace('ú','Ú',$descripcion);
	$descripcion = str_replace('ñ','Ñ',$descripcion);
	$numero = $_POST['numero'];
	$nivel = $_POST['nivel'];
	$coords = $_POST['coords'];
	$id = $_POST['data'];
	
	try{
		$insert = "UPDATE local SET nombre = ?, descricpion = ? WHERE id = ?";
		$ins = $gbd -> prepare($insert);
		$ins -> execute(array($nombre,$descripcion,$id));
		
		echo 'ok';
		
	}catch(PDOException $e){
		print_r($e);
	}
?>