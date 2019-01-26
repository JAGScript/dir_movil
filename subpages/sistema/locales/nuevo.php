<?php 
	include('subpages/sistema/ajax/seguridad.php');
	
	$select = "SELECT * FROM categoria WHERE activo = ? ORDER BY nombre ASC";
	$stmt = $gbd -> prepare($select);
	$stmt -> execute(array(1));
?>
<script src="js/ajaxupload.js"></script>
<div class="row">
	<div class="col-md-12" style="text-align:center;">
		<h2><span class="label label-primary">Nuevo Local</span></h2>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12" style="text-align:right;">
		<button class="btn btn-primary" type="button" onclick="window.location='?modulo=loc_lista';">
			<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
			Lista
		</button>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4><strong>Nombre del Local:</strong></h4>
		<input type="text" class="form-control mayus" id="nombre" placeholder="Ingrese nombre del local..." />
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4><strong>Descripción:</strong></h4>
		<textarea class="form-control mayus" rows="5" id="descripcion" placeholder="Ingrese una descripción del Local"></textarea>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4><strong>Coords:</strong></h4>
		<textarea class="form-control mayus" rows="3" id="coords" placeholder="Coordenadas del Local"></textarea>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<div class="col-md-6">
			<h4><strong>Número de Local:</strong></h4>
			<input type="text" class="form-control mayus" id="numero" placeholder="Ingrese número del local..." />
		</div>
		<div class="col-md-6">
			<h4><strong>Ubicación:</strong></h4>
			<select class="form-control" id="nivel">
				<option value="0">Seleccione...</option>
				<option value="1">Nivel 1</option>
				<option value="2">Nivel 2</option>
				<option value="3">Nivel 3</option>
				<option value="4">Nivel 4</option>
			</select>
		</div>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<button class="btn btn-primary" type="button" id="selectall" onclick="selectall()">
			<span class="glyphicon glyphicon-check" aria-hidden="true"></span>&nbsp;Seleccionar Todo
		</button>
		<button class="btn btn-primary" type="button" id="desall" onclick="desall()" style="display:none;">
			<span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>&nbsp;Quitar Todo
		</button>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4><strong>Categorías:</strong></h4>
		<div class="row">
		<?php 
		while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
			echo '
			<div class="col-md-4 categorias">
				<button class="btn btn-default" type="button" onclick="changestate('.$row['id'].')">
					<span id="check'.$row['id'].'" class="glyphicon glyphicon-unchecked change" aria-hidden="true" style="cursor:pointer;"></span>&nbsp;'.$row['nombre'].'
				</button>
				<input type="hidden" id="valuestate'.$row['id'].'" class="statecat" value="0" />
				<input type="hidden" id="id'.$row['id'].'" class="idcat" value="'.$row['id'].'" />
			</div>
			';
		}
		?>
		</div>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4>Logo:</h4>
		<div class="input-group">
			<input class="form-control" placeholder="Nombre de la imagen..." type="text" id="imagen" readonly="readonly" aria-describedby="basic-addon2">
			<span class="input-group-addon" id="basic-addon2">
				<div style="" id="upload1">
					<img src="img/examina.png"  style="border:0; margin:-2px;" alt="">
				</div>
			</span>
		</div>
		<div style="position:relative; display:none; text-align:center; background-color:#cccccc;" id="btnborrarimg">
			<img id="imagen_subida" style="max-width:300px;"/>
			<div style="position:absolute; top:0px; right:0;">
				<button type="button" class="btn btn-success" onclick="borrarimg()" title="Eliminar">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-top:15px;">
	<div class="col-md-6 col-md-push-3">
		<h4>Fachada:</h4>
		<div class="input-group">
			<input class="form-control" placeholder="Nombre de la imagen..." type="text" id="fachada" readonly="readonly" aria-describedby="basic-addon2">
			<span class="input-group-addon" id="basic-addon2">
				<div style="" id="upload2">
					<img src="img/examina.png"  style="border:0; margin:-2px;" alt="">
				</div>
			</span>
		</div>
		<div style="position:relative; display:none; text-align:center;" id="btnborrarimg2">
			<img id="imagen_subida2" style="max-width:300px;"/>
			<div style="position:absolute; top:0px; right:0;">
				<button type="button" class="btn btn-success" onclick="borrarimg2()" title="Eliminar">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</div>
</div>
<div class="imgeliminadas">
	
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
<script>
$(function(){
	var btnUpload=$('#upload1');
	new AjaxUpload(btnUpload, {
		action: 'subpages/sistema/locales/ajax/upload.php',
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
			document.getElementById('imagen_subida').src='subpages/local/'+mirsp;
			$('#btnborrarimg').fadeIn();
		}
	});
});

$(function(){
	var btnUpload=$('#upload2');
	new AjaxUpload(btnUpload, {
		action: 'subpages/sistema/locales/ajax/upload2.php',
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
			document.getElementById('imagen_subida').src='subpages/foto_local/'+mirsp;
			$('#btnborrarimg').fadeIn();
		}
	});
});

function selectall(){
	$('#selectall').fadeOut('slow');
	$('#desall').delay(600).fadeIn('slow');
	$('.change').removeClass('glyphicon-unchecked');
	$('.change').addClass('glyphicon-check');
	$('.statelocal').val(1);
}

function desall(){
	$('#desall').fadeOut('slow');
	$('#selectall').delay(600).fadeIn('slow');
	$('.change').removeClass('glyphicon-check');
	$('.change').addClass('glyphicon-unchecked');
	$('.statelocal').val(0);
}

function changestate(data){
	var state = $('#valuestate'+data).val();
	if(state == 1){
		$('#check'+data).removeClass('glyphicon-check');
		$('#check'+data).addClass('glyphicon-unchecked');
		$('#valuestate'+data).val(0);
	}else if(state == 0){
		$('#check'+data).removeClass('glyphicon-unchecked');
		$('#check'+data).addClass('glyphicon-check');
		$('#valuestate'+data).val(1);
	}
}

function borrarimg(){
	$('#btnborrarimg').fadeOut();
	var imgname = $('#imagen').val();
	$('.imgeliminadas').append('<div class="eliminarimg"><input type="hidden" class="eliminadas" value="'+imgname+'" /><div>');
	$('#imagen_subida').prop('src','');
	$('#imagen').val('');
}

function borrarimg2(){
	$('#btnborrarimg2').fadeOut();
	var imgname = $('#fachada').val();
	$('.imgeliminadas').append('<div class="eliminarimg"><input type="hidden" class="eliminadas" value="'+imgname+'" /><div>');
	$('#imagen_subida2').prop('src','');
	$('#fachada').val('');
}

function guardar(){
	var nombre = $('#nombre').val();
	var descripcion = $('#descripcion').val();
	var coords = $('#coords').val();
	var numero = $('#numero').val();
	var nivel = $('#nivel').val();
	var imagen = $('#imagen').val();
	var fachada = $('#fachada').val();
	
	var valores_on = '';
	var valores_off = '';
	
	$('.categorias').each(function(){
		var valor = $(this).find('.statecat').val();
		var cat_id = $(this).find('.idcat').val();
		
		if(valor == 1){
			valores_on += valor +'|'+ cat_id +'|'+'@';
		}else if(valor == 0){
			valores_off += valor +'|'+ cat_id +'|'+'@';
		}
	});
	
	var valoresform_on = valores_on.substring(0, valores_on.length -1);
	var valoresform_off = valores_off.substring(0, valores_off.length -1);
	
	
	if((nombre == '') || (imagen == '') || (descripcion == '') || (numero == '') || (nivel == '')){
		$('#vacio').modal('show');
	}else{
		$('#btn_guardar').fadeOut('slow');
		$('#wait').delay(600).fadeIn('slow');
		$.post('subpages/sistema/locales/ajax/guardar.php',{
			nombre : nombre, imagen : imagen, descripcion : descripcion, numero : numero, nivel : nivel, fachada : fachada, valores_on : valoresform_on, coords : coords
		}).done(function(response){
			$('#wait').fadeOut('slow');
			$('#guardado').modal('show');
		});
	}
}
</script>