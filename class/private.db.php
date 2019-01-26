<?php 
	class DBConn extends PDO{
		public function __construct(){
			$host= '108.167.146.109';
			$dbname = 'autorvzs_dir4';
			$user = 'autorvzs';
			$pass = '@rIOd0g@Zevj';

			parent::__construct('mysql: host='.$host.'; dbname='.$dbname, $user, $pass);
			$this -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
	}
?>