<?php 
	session_start();
	require_once('../../../class/private.db.php');
	date_default_timezone_set('America/Guayaquil');
	
	$gbd = new DBConn();
	
	$user = $_POST['login'];
	$pass = $_POST['pass'];
	$pass = md5($pass);
	
	$select = "SELECT * FROM usuario WHERE login = ? AND pass = ? AND activo = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array($user,$pass,1));
	$numrows = $stmt -> rowCount();
	
	if($numrows == 1){
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$_SESSION['nombre'] = $row['nombre'];
		$_SESSION['cedula'] = $row['cedula'];
		$_SESSION['correo'] = $row['correo'];
		$_SESSION['id'] = $row['id'];
		$_SESSION['autentica'] = md5('ADM_DIRECTORIO');
		
		echo 'ok';
	}else{
		echo 'error';
	}
?>