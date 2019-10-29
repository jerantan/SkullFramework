<?php
class spec extends field{
  function __construct(){
    // Initialize sql class
    $this->sql = new sql;

    $sql = $this->sql;
    $sql->field = 'name, level, active';
    $sql->table = 'user';
    $sql->clause = "where id = '".$this->session()."'";
    $data = $sql->select();
    $this->userdata = $sql->fetch($data);

    $data = $sql->query("SHOW TABLES LIKE 'field'");
    if(!$sql->fetch($data)){
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