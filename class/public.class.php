<?php
	session_start();
	class Init{
		public $route;
		public $subpagePath;
		public $pages = array(
			'inicio' => array('path' => 'subpages/inicio.php', 'title' => ''),
			'login_admin' => array('path' => 'subpages/sistema/login.php', 'title' => ''),
          	'admin_home' => array('path' => 'subpages/sistema/homeadmin.php'),
          	'logout' => array('path' => 'subpages/sistema/ajax/logout.php'),
          	'cat_lista' => array('path' => 'subpages/sistema/categorias/lista.php'),
          	'cat_nuevo' => array('path' => 'subpages/sistema/categorias/nuevo.php'),
          	'cat_editar' => array('path' => 'subpages/sistema/categorias/editar.php'),
          	'car_lista' => array('path' => 'subpages/sistema/cartelera/lista.php'),
          	'car_nuevo' => array('path' => 'subpages/sistema/cartelera/nuevo.php'),
          	'car_view' => array('path' => 'subpages/sistema/cartelera/showcartelera.php'),
          	'car_editar' => array('path' => 'subpages/sistema/cartelera/editar.php'),
          	'loc_lista' => array('path' => 'subpages/sistema/locales/lista.php'),
          	'loc_nuevo' => array('path' => 'subpages/sistema/locales/nuevo.php'),
          	'loc_editar' => array('path' => 'subpages/sistema/locales/editar.php'),
          	'loc_view' => array('path' => 'subpages/sistema/locales/mostrarlocales.php'),
          	'loc_menu' => array('path' => 'subpages/sistema/locales/menu.php'),
          	'loc_menu_nivel' => array('path' => 'subpages/sistema/locales/menu_nivel.php'),
          	'loc_nivel' => array('path' => 'subpages/sistema/locales/nivel.php'),
          	'loc_menu_categoria' => array('path' => 'subpages/sistema/locales/menu_categoria.php'),
          	'loc_categoria' => array('path' => 'subpages/sistema/locales/categoria.php'),
          	'loc_orden' => array('path' => 'subpages/sistema/locales/orden.php'),
          	'anu_nuevo' => array('path' => 'subpages/sistema/anuncios/nuevo.php'),
          	'anu_lista' => array('path' => 'subpages/sistema/anuncios/lista.php'),
          	'anu_editar' => array('path' => 'subpages/sistema/anuncios/editar.php'),
          	'eve_nuevo' => array('path' => 'subpages/sistema/eventos/nuevo.php'),
          	'eve_lista' => array('path' => 'subpages/sistema/eventos/lista.php'),
          	'eve_editar' => array('path' => 'subpages/sistema/eventos/editar.php'),
          	'eve_view' => array('path' => 'subpages/sistema/eventos/showeventos.php'),
          	'map_nuevo' => array('path' => 'subpages/sistema/mapas/nuevo.php'),
          	'map_lista' => array('path' => 'subpages/sistema/mapas/lista.php'),
          	'map_editar' => array('path' => 'subpages/sistema/mapas/editar.php'),
          	'map_view' => array('path' => 'subpages/sistema/mapas/showmapas.php'),
          	'via_nuevo' => array('path' => 'subpages/sistema/vias/nuevo.php'),
          	'via_lista' => array('path' => 'subpages/sistema/vias/lista.php'),
          	'via_editar' => array('path' => 'subpages/sistema/vias/editar.php'),
          	'via_view' => array('path' => 'subpages/sistema/vias/showmapas.php'),
          	'loc_view_letter' => array('path' => 'subpages/sistema/locales/mostrarlocalesxletra.php'),
          	'loc_view_nivel' => array('path' => 'subpages/sistema/locales/mostrarlocalesxnivel.php'),
          	'par_lista' => array('path' => 'subpages/sistema/parametros/lista.php'),
          	'par_editar' => array('path' => 'subpages/sistema/parametros/editar.php'),
          	'par_view' => array('path' => 'subpages/sistema/parametros/showmapas.php'),
          	'publicidad' => array('path' => 'subpages/publicidad.php'));
		
		public function __construct(){
			$this -> CheckIfPageRequestIsLegal();
		}
		
		public function CheckIfPageRequestIsLegal(){
			
			if($_SESSION['autentica'] == md5('ADM_DIRECTORIO')){
				$request = isset($_REQUEST['modulo']) ? $_REQUEST['modulo'] : 'admin';
			}else{
				$request = isset($_REQUEST['modulo']) ? $_REQUEST['modulo'] : 'inicio';
			}
			
			if(array_key_exists($request,$this -> pages)){
				$this -> subpagePath = $this -> pages[$request]['path'];
			}else{
				$this -> subpagePath = '404.php';
			}
		}
	}
?>