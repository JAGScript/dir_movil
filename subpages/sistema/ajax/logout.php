<?php 
	session_start();
	session_destroy();
	header("Location: ?modulo=inicio");
?>