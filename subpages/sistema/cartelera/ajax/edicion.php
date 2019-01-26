<?php 
	include('../../ajax/seguridad.php');
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$id = $_POST['data'];
	$nombre = strtoupper($_POST['nombre']);
	$descripcion = strtoupper($_POST['descripcion']);
	$horarios = strtoupper($_POST['horarios']);
	$fechainicio = strtoupper($_POST['fechainicio']);
	$fechafin = strtoupper($_POST['fechafin']);
	$sinopsis = $_POST['sinopsis'];
	$link = $_POST['link'];
	$imagen = $_POST['imagen'];
	$estado = $_POST['estado'];
	
	try{
		if($imagen == ''){
		    $update = "UPDATE cartelera SET nombre = ?, descripcion = ?, horario = ?, fechainicio = ?, fechafin = ?, activo = ?, sinopsis = ?, link = ? WHERE id = ?";
		    $upd = $gbd -> prepare($update);
		    $upd -> execute(array($nombre,$descripcion,$horarios,$fechainicio,$fechafin,$estado,$sinopsis,$link,$id));
		}else{
		    $update = "UPDATE cartelera SET nombre = ?, descripcion = ?, horario = ?, fechainicio = ?, fechafin = ?, img = ?, activo = ?, sinopsis = ?, link = ? WHERE id = ?";
		    $upd = $gbd -> prepare($update);
		    $upd -> execute(array($nombre,$descripcion,$horarios,$fechainicio,$fechafin,$imagen,$estado,$sinopsis,$link,$id));
		}
	
		echo 'ok';
	}catch(PDOException $e){
		print_r($e);
	}
?>