<?php
class spec extends field{
	function __construct(){
		$sql = new sql;
		$sql->field = 'name, level, active';
		$sql->table = 'user';
		$sql->clause = "where id = '".$this->session()."'";
		$sql->select();
		$this->userdata = $sql->fetch();

		$sql->data = $sql->query("SHOW TABLES LIKE 'field'");
		if(!$sql->fetch()){
			$query = 'CREATE TABLE IF NOT EXISTS `field` (
				`id` int(11) AUTO_INCREMENT PRIMARY KEY,
				`table_name` varchar(50) NOT NULL,
				`field_name` varchar(50) NOT NULL,
				`active` tinyint(1) NOT NULL
			)';
			$sql->query($query);
		}

		if(method_exists($this, 'init')) $this->init();
	}
}
?>