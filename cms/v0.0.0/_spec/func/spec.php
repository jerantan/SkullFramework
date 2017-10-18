<?php
class spec extends field{
	function userdata(){
		$sql = new sql;
		$sql->field = 'name, level, active';
		$sql->table = 'user';
		$sql->clause = "where id = '".$this->session()."'";
		$sql->select();
		$this->userdata = $sql->fetch();
	}
}
?>