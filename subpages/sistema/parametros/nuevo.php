<?php 
	include('subpages/sistema/ajax/seguridad.php');
?>
<script src="js/ajaxupload.js"></script>
<div class="row">
	<div class="col-md-12" style="text-align:center;">
		<h2><span class="label label-primary">Nueva Vía de Evacuación</span></h2>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12" style="text-align:right;">
		<button class="btn btn-primary" type="button" onclick="window.location='?modulo=via_lista';">
			<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
			Lista de vías de Evacuación
		</button>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<div class="row">
			<div class="col-md-12">
				<h4><strong>Nombre:</strong></h4>
				<input type="text" class="form-control mayus" id="nombre" placeholder="Ingrese el nombre del nivel..." />
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-lg-6 col-md-push-3">
		<h4>Imagen:</h4>
		<div class="input-group">
			<input class="form-control" placeholder="Nombre de la imagen..." type="text" id="imagen" readonly="readonly" aria-describedby="basic-addon2">
			<span class="input-group-addon" id="basic-addon2">
				<div style="" id="upload1">
					<img src="img/examina.png"  style="border:0; margin:-2px;" alt="">
				</div>
			</span>
		</div>
		<div style="position:relative; display:none;" id="btnborrarimg" style="text-align:center;">
			<img id="imagen_subida" style="max-width:300px;"/>
			<div style="position:absolute; top:0px; right:0;">
				<button type="button" class="btn btn-success" onclick="borrarimg()" title="Eliminar">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</div>
			<div class="imgeliminadas">
				
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-top:50px;">
	<div class="col-md-12" style="text-align:right;">
		<button class="btn btn-default btn-lg" type="button" onclick="window.location='';">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			Cancelar
		</button>
		<button class="btn btn-primary btn-lg" id="btn_guardar" type="button" onclick="guardar()">
			<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
			Guardar
		</button>
		<img src="img/loading.gif" id="wait" style="width:45px; display:none;"/>
	</div>
</div>
<script>$(function(){
	var btnUpload=$('#upload1');
	new AjaxUpload(btnUpload, {
		action: 'subpages/sistema/vias/ajax/upload.php',
		name: 'uploadfile',
		onSubmit: function(file, ext){
			 if (! (ext && /^(JPG|PNG|JPEG|jpg|png|jpeg)$/.test(ext))){
				alert('Solo archivos JPG, PNG, JPEG.');
				return false;
			}
		},
		onComplete: function(file, response){
			var mirsp = response;
			//reload ();
			document.getElementById('imagen').value=mirsp;
			document.getElementById('imagen_subida').src='subpages/vias/'+mirsp;
			$('#btnborrarimg').fadeIn();
		}
	});
});

function borrarimg(){
	$('#btnborrarimg').fadeOut();
	var imgname = $('#logo').val();
	$('.imgeliminadas').append('<div class="eliminarimg"><input type="hidden" class="eliminadas" value="'+imgname+'" /><div>');
	$('#foto').prop('src','');
	$('#logo').val('');
}

function guardar(){
	var nombre = $('#nombre').val();
	var imagen = $('#imagen').val();
	if((imagen == '') || (nombre == '')){
		$('#vacio').modal('show');
	}else{
		$('#btn_guardar').fadeOut('slow');
		$('#wait').delay(600).fadeIn('slow');
		$.post('subpages/sistema/vias/ajax/guardar.php',{
			imagen : imagen, nombre : nombre
		}).done(function(response){
			$('#wait').fadeOut('slow');
			$('#guardado').modal('show');
		});
	}
}
</script>