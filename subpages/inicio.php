<div class="row" style="position:relative; margin-top:60%; text-align:center;">
	<img id="img_inicio" src="img/principal_gif.gif" style="width:375px; border:2px solid #ccc; border-radius:10px;"/>
	<div style="position:absolute; top:-450px; left:35%;" onclick="window.location='?modulo=eve_view';">
		<img src="img/eventos.png"/>
		<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%;">
			<h4>CALENDARIO DE EVENTOS</h4>
		</div>
	</div>
	<div style="position:absolute; left:35%; top:400px;" onclick="$('#info_general').modal('show');">
		<img src="img/info.png"/>
		<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%; padding-left:15px;">
			<h4>INFORMACION GENERAL</h4>
		</div>
	</div>
	<div style="position:absolute; left:0; top:-250px;" onclick="window.location='?modulo=loc_menu';">
		<img src="img/local.png"/>
		<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%;">
			<h4>LOCALES</h4>
		</div>
	</div>
	<div style="position:absolute; top:-250px; left:70.5%;" onclick="window.location='?modulo=map_view';">
		<img src="img/mapas.png"/>
		<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%;">
			<h4>MAPAS DEL C.C.</h4>
		</div>
	</div>
	<div style="position:absolute; top:150px; left:0;" onclick="window.location='?modulo=car_view';">
		<img src="img/cartelera.png"/>
		<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%; padding-left:15px;">
			<h4>CARTELERA DE CINE</h4>
		</div>
	</div>
	<div style="position:absolute; top:150px; left:70.5%;" onclick="window.location='?modulo=via_view';">
		<img src="img/vias.png"/>
		<div style="position:absolute; bottom:0; background:rgba(0, 0, 0, 0.57); color:#fff; width:100%;">
			<h4>VIAS DE EVACUACION</h4>
		</div>
	</div>
</div>
<!--INICIO SECCION DE LA INFORMACION GENERARL DEL CC-->
<div class="modal fade bs-example-modal-lg" id="info_general" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:20%;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content borde fondo">
			<img src="img/marco1.png" style="position:absolute; width:200px; z-index:39; margin-left:38%; margin-top:-15px;"/>
			<div class="modal-header" style="margin-top:75px;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel" style="text-align:center;"><strong>INFORMACION GENERAL CONDADO SHOPPING</strong></h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><strong><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;&nbsp;HORARIOS DE ATENCIÓN</strong></h3>
					</div>
					<div class="panel-body">
						<h1><strong>Lunes a Jueves de 10:00 am - 20:30 pm</strong></h1>
						<h1><strong>Viernes y Sábados de 10:00 am - 21:00 pm</strong></h1>
						<h1><strong>Domingos de 10:00 am - 20:00 pm</strong></h1>
					</div>
				</div>
				<div class="alert alert-info" role="alert" style="text-align:center;"><h4><strong>REDES SOCIALES</strong></h4></div>
				<div class="table-responsive">
					<table class="table" style="border-radius:5px;">
						<tr style="text-align:center;">
							<td style="vertical-align:middle;">
								<h4><strong>FACEBOOK</strong></h4>
								<img src="img/face.png" />
								<h4><strong>/condadoshopping</strong></h4>
							</td>
							<td style="vertical-align:middle;">
								<h4><strong>INSTAGRAM</strong></h4>
								<img src="img/insta.png" />
								<h4><strong>@condadoshopping</strong></h4>
							</td>
							<td style="vertical-align:middle;">
								<h4><strong>TWITTER</strong></h4>
								<img src="img/twitter.png" />
								<h4><strong>@condadoshopping</strong></h4>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!--FIN SECCION DE LA INFORMACION GENERARL DEL CC-->
<script>
function ocultar_sms(){
	if($('#menu-open').is(':checked')){
		$('#sms_top').css('display','');
	}else{
		$('#sms_top').css('display','none');
	}
}
</script>