<?php 
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$id = $_POST['data'];
	
	try{
		$select = "SELECT * FROM vias WHERE id = ?";
		$stmt = $gbd -> prepare($select);
		$stmt -> execute(array($id));
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		
		$nombre = $row['nombre'];
		$img = $row['img'];
		
		$content = '
			<div style="position:absolute; top:0; left:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:50%; padding-left:15px;">
				<h3><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;<strong> '.$nombre.'</strong></h3>
			</div>
			<div style="position:absolute; top:0; right:0;">
				<button type="button" class="btn btn-danger btn-lg" onclick="btn_close_map()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			</div>
			<img src="subpages/vias/'.$img.'" style="border-radius:5px; border:1px solid #ccc; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); width:1015px;"/>
		';
		
		echo $content;
		
	}catch(PDOException $e){
		print_r($e);
	}
?>