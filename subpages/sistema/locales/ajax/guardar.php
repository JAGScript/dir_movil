<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$nombre = strtoupper($_POST['nombre']);
	$imagen = $_POST['imagen'];
	$descripcion = strtoupper($_POST['descripcion']);
	$numero = strtoupper($_POST['numero']);
	$nivel = $_POST['nivel'];
	$coords = $_POST['coords'];
	$fachada = $_POST['fachada'];
	
	try{
		$insert = "INSERT INTO local VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$ins = $gbd -> prepare($insert);
		$ins -> execute(array('NULL',$nombre,$imagen,$fachada,$descripcion,$nivel,$numero,$coords,1));
		$local_id = $gbd -> lastInsertId();
		
		foreach(explode('@',$_POST['valores_on']) as $value){
			$rsp = explode('|',$value);
			
			$insert1 = "INSERT INTO categoria_local VALUES (?, ?, ?, ?)";
			$ins1 = $gbd -> prepare($insert1);
			$ins1 -> execute(array('NULL',$local_id,$rsp[1],1));
		}
		
		echo 'ok';
		
	}catch(PDOException $e){
		print_r($e);
	}
?>