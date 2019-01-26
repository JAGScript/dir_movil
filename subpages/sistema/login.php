<div class="row">
	<div class="col-md-6 col-md-push-3">
		<div style="border-radius:10px; padding:20px; box-shadow: 15px 15px 5px #999; background-color:#fff; color:#000;">
			<div class="row">
				<table width="100%">
					<tr>
						<td width="30%" style="text-align:center; vertical-align:middle;">
							<img src="img/candado2.png" style="width:100%; max-width:200px;" />
						</td>
						<td style="">
							<h1 style="text-align:center;">Ingreso de Usuarios</h1>
							<div class="row" style="margin-top:50px;">
								<div class="col-md-12">
									<h4><strong>Usuario:</strong></h4>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">
											<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
										</span>
										<input type="text" id="login" class="form-control txt" placeholder="Nombre de Usuario" autocomplete="off"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4><strong>Contraseña:</strong></h4>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">
											<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
										</span>
										<input type="password" id="pass_login" class="form-control txt" placeholder="**********" autocomplete="off" />
									</div>
								</div>
							</div>
							<div class="row" style="margin-top:25px;">
								<div class="col-md-12" style="text-align:right;">
									<button type="button" class="btn btn-success btn-lg" id="btn_conectar" onclick="conectar()">
										<span class="glyphicon glyphicon-log-in"></span>
										Inciar Sesión
									</button>
									<img src="img/loading.gif" id="wait_conectar" style="width:40px; display:none;"/>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="errordata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">!Alerta¡</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert">
					<span class="glyphicon glyphicon-warning-sing" aria-hidden="true"></span>&nbsp; La información ingresada es incorrecta.
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
			</div>
		</div>
	</div>
</div>
<script>
$(document).keypress(function(e){
	if(e.which == 13){
		conectar();
	}
});

function conectar(){
	var login = $('#login').val();
	var pass = $('#pass_login').val();
	if((login == '') || (pass == '')){
		$('#txtvacio').modal('show');
	}else{
		$('#btn_conectar').fadeOut('slow');
		$('#wait_conectar').delay(600).fadeIn('slow');
		$.post('subpages/sistema/ajax/control.php',{
			login : login, pass : pass
		}).done(function(response){
			if($.trim(response) == 'ok'){
				setTimeout("window.location='?modulo=admin_home';",3000);
			}else if($.trim(response) == 'error'){
				$('#wait_conectar').fadeOut('slow');
				$('#btn_conectar').delay(600).fadeIn('slow');
				$('#login').val('');
				$('#pass_login').val('');
				setTimeout("$('#errordata').modal('show'); $('#wait_conectar').fadeOut('slow'); $('#btn_conectar').delay(600).fadeIn('slow'); $('#login').val(''); $('#pass').val('');",1500);
			}
		});
	}
}
</script>