<div id="publicidad">
	<?php 
	
	
	require_once('../class/private.db.php');
	
	$gbd = new DBConn();
	
	$select = "SELECT * FROM anuncios WHERE activo = ?";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array(1));
	$numrows = $stmt -> rowCount();
	?>
	<div id="carousel" class="carousel slide" data-ride="carousel" style="background-color:#000; height:1919px;">
		<ol class="carousel-indicators">
		<?php 
		for($i = 0; $i < $numrows; $i++){
			if($i == 0){
				echo '<li data-target="#carousel" data-slide-to="'.$i.'" class="active"></li>';
			}else{
				echo '<li data-target="#carousel" data-slide-to="'.$i.'"></li>';
			}
		}
		?>
		</ol>

		<div class="carousel-inner" role="listbox">
			<?php 
			$count = 1;
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				if($count == 1){
					if($row['descripcion'] == 'imagen'){
						echo '
						<div class="item active" style="text-align:center;">
							<img src="subpages/anuncios/'.$row['img'].'" style="width:100%; height:1910px;" onclick="salirPublicidad()">
						</div>
						';
					}else{
						echo '
						<div class="item active" style="text-align:center; margin-top:50%;">
							<video style="width:100%; height:100%;" onclick="salirPublicidad()">
								<source src="subpages/anuncios/'.$row['img'].'" type="video/mp4">
							</video>
						</div>		
						';
					}
				}else{
					if($row['descripcion'] == 'video'){
						echo '
						<div class="item" style="text-align:center; margin-top:50%;">
							<video style="width:100%; height:100%;" onclick="salirPublicidad()">
								<source src="subpages/anuncios/'.$row['img'].'" type="video/mp4">
							</video>
						</div>	
						';
					}else{
						echo '
						<div class="item" style="text-align:center;">
							<img src="subpages/anuncios/'.$row['img'].'" style="width:100%; height:1910px;" onclick="salirPublicidad()">
						</div>
						';
					}
				}
				$count++;
			}
			?>	
		</div>
		<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<script>
$(document).ready(function(){	
	$('#carousel').carousel({
		interval: 10000
    });
	
	// $('#front_cabecera').fadeOut('slow');
	// $( "#emo_logo" ).fadeOut('fast');
	
});

$('#carousel').on('slid.bs.carousel', function (e) {
   let elemento = $('#carousel .item.active video').first();
   if (elemento.prop("tagName") == "VIDEO") {
     elemento.get(0).play();
   }
});

$('#carousel').bind('slide.bs.carousel', function (e) {  
   let elemento = $('#carousel .item.active video').first();
   if (elemento.prop("tagName") == "VIDEO") {
     elemento.get(0).pause();
   }
});
</script>