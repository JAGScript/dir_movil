<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$id = $_POST['data'];
	$nombre = strtoupper($_POST['nombre']);
	$des = strtoupper($_POST['descripcion']);
	$color = strtoupper($_POST['color']);
	
	try{
		if($id == ''){
			$insert = "INSERT INTO parametros VALUES (?, ?, ?, ?, ?)";
			$ins = $gbd -> prepare($insert);
			$ins -> execute(array('NULL',$nombre,$des,$color,1));
		}else{
			$update = "UPDATE parametros SET nombre = ?, des = ?, color = ? WHERE id = ?";
			$upd = $gbd -> prepare($update);
			$upd -> execute(array($nombre,$des,$color,$id));
		}
	
		echo 'ok';
	}catch(PDOException $e){
		print_r($e);
	}
?>