<?php 
	$fecha = date('Y-m-d');

	$select1 = "SELECT * FROM cartelera WHERE activo = ?";
	$stmt1 = $gbd -> prepare($select1);
	$stmt1 -> execute(array(1));
?>
<div class="row">
	<div class="col-md-12">
		<div class="well" style="text-align:center;">
			<h4>
				<strong>Disfrutas de los estrenos y tus películas favoritas en MULTICINES</strong>
				<button type="button" class="btn btn-primary btn-lg pull-right" onclick="window.location='?modulo=inicio';">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<strong>Volver</strong>
				</button>
			<h4>
		</div>
	</div>
</div>
<div class="row" id="slider_cartelera">
	<div class="col-md-10 col-md-push-1">
		<div class="row">
            <?php while($row1 = $stmt1 -> fetch(PDO::FETCH_ASSOC)){
                echo '
                <div class="col-xs-6 col-md-4" onclick="open_movie('.$row1['id'].')">
                    <a class="thumbnail">
                        <img src="subpages/cartelera/'.$row1['img'].'" alt="...">
                    </a>
                </div>
                ';
            } ?>
        </div>
	</div>
</div>
<div class="modal fade bs-example-modal-lg" id="pelicula_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Información de película</h4>
            </div>
            <div class="modal-body" style="text-align:center">
    			<h2>Película:</h2>
    			<h2 id="pelicula"></h2>
    			<h4>Horarios Disponibles:</h4>
    			<h4 id="descripcion"></h4>
    			<h4 id="horarios"></h4>
    			<br>
    			<img id="imagen_movie" style="width:400px; box-shadow:5px 5px 3px #222; border-radius:10px;"/>
    			<br>
    			<br>
    			<p id="sinopsis"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
function open_movie(data){
	$.post('subpages/sistema/cartelera/ajax/datos_movie.php',{
		data : data
	}).done(function(response){
		var rsp = response.split('|');
		$('#pelicula').html('<strong>'+rsp[0]+'</strong>');
		$('#descripcion').html('<strong>2D: '+rsp[1]+'</strong>');
		$('#horarios').html('<strong>3D: '+rsp[2]+'</strong>');
		$('#imagen_movie').prop('src','subpages/cartelera/'+rsp[3]);
		$('#sinopsis').html('<strong>'+rsp[4]+'</strong>');
		$('#pelicula_info').modal('show');
	});
}
</script>