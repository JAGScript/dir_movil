<?php 
	require_once('../../../../class/private.db.php');
	
	$gbd = new DBConn();
	
	$id = $_POST['data'];
	
	try{
		$select = "SELECT * FROM mapas WHERE id = ?";
		$stmt = $gbd -> prepare($select);
		$stmt -> execute(array($id));
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		
		$nombre_piso = 'Nivel'.$id;
		$mapa = 'mapa'.$id;
		$img = $row['img'];
		
		$select1 = "SELECT * FROM local WHERE piso_id = ?";
		$stmt1 = $gbd -> prepare($select1);
		$stmt1 -> execute(array($id));
		
		$content = '
			<div style="position:absolute; top:0; left:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:50%; padding-left:15px;">
				<h3><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span>&nbsp;<strong> Selecciona un local para ver su información</strong></h3>
			</div>
			<div style="position:absolute; top:0; right:0;">
				<button type="button" class="btn btn-danger btn-lg" onclick="btn_close_map()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			</div>
			<img src="subpages/mapas/'.$img.'" id="'.$mapa.'" usemap="#'.$nombre_piso.'" style="border-radius:5px; border:1px solid #ccc; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); width:1015px;"/>
			<map id="'.$nombre_piso.'" name="'.$nombre_piso.'">
		';
		
		while($row1 = $stmt1 -> fetch(PDO::FETCH_ASSOC)){
			$content .= '
				<area alt="Pulsar para acceder a '.$row1['nombre'].'" title="'.$row1['nombre'].'" shape="poly" coords="'.$row1['coordenadas'].'" onclick="info_local('.$row1['id'].')" ></area>
			';
		}
		$content .= '</map>';
		
		echo $content.'|'.$mapa;
		
	}catch(PDOException $e){
		print_r($e);
	}
?>