<?php
class specs extends spec{
	function init(){
		$sql = $this->sql;
		$data = $sql->query("SHOW TABLES LIKE 'user'");
		if(!$sql->fetch($data)){
			$query = 'CREATE TABLE IF NOT EXISTS `user` (
				`id` int(11) AUTO_INCREMENT PRIMARY KEY,
				`name` varchar(50) NOT NULL,
				`username` varchar(50) NOT NULL,
				`password` varchar(50) NOT NULL,
				`level` varchar(50) NOT NULL,
				`active` tinyint(1) NOT NULL,
				`added` datetime NOT NULL,
				`updated` datetime NOT NULL
			)';
			$sql->query($query);

			$query = "INSERT INTO `user` (`id`, `name`, `username`, `password`, `level`, `active`, `added`, `updated`) VALUES
			(1, 'Jeran Tan', 'adminadmin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'Admin', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00')";
			$sql->query($query);

			$query = "INSERT INTO `field` (`id`, `table_name`, `field_name`, `active`) VALUES
			(1, 'user', 'name', 1),
			(2, 'user', 'username', 1),
			(3, 'user', 'level', 1),
			(4, 'user', 'active', 1),
			(5, 'user', 'added', 1),
			(6, 'user', 'updated', 1)";
			$sql->query($query);
		}
	}
}
?>