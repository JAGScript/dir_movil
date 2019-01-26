<?php 
	@session_start();
	if($_SESSION['autentica'] != md5('ADM_DIRECTORIO')){
		echo "
			<script>
				alert('Debes iniciar sesion para acceder');
				window.location.href = '?modulo=inicio';
			</script>
		";
		exit();
	}
?>