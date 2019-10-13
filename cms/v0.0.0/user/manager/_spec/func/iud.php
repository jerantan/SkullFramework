<?php
switch($proc){
  case 'insert':
    $active = $_POST['active'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    $sql = $this->sql;
    $sql->table = $table;
    $sql->field = 'name, username, password, level, active, added';
    $sql->value = "'$name', '$username', '$password', '$level', '$active', '".date."'";
    $sql->insert();

    echo $sql->id();
  break;
  case 'update':
    $active = $_POST['active'];
    $name = $_POST['name'];
    $username = $_POST['username'];

    $password = '';
    if($_POST['password']){
      $password = ", password = md5('".$_POST['password']."')";
    }

    $level = $_POST['level'];

    $sql = $this->sql;
    $sql->table = $table;
    $sql->field_value = "name = '$name', username = '$username' $password, level = '$level', active = '$active', updated = '".date."'";
    $sql->clause = "id = '$id'";
    $sql->update();
  break;
}
?>