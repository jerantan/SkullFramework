<?php
switch($proc){
	case 'update':
		$name = $_POST['name'];
		$username = $_POST['username'];
		
		$password = '';
		if($_POST['password']){
			$password = ", password = md5('".$_POST['password']."')";
		}
	
		$sql = new sql;
		$sql->table = $this->module;
		$sql->field_value = "name = '$name', username = '$username' $password, updated = '".date."'";
		$sql->clause = "id = '$id'";
		$sql->update();
	break;
}
?>