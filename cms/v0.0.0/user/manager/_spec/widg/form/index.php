<?php
$sql = $this->sql;
$sql->field = 'name, username, level, active';
$sql->table = $this->table;
$sql->clause = "where id = '".$this->id."'";
$data = $sql->select();
$result = $sql->fetch($data);
$this->form_option($result['name']);
$this->form_open($this->table);
	$this->div_open(3, 4);
		$arr = $this->active_arr();
		$this->dropdown_required('Active', $arr['val'], $arr['opt'], $this->val($result['active'], $arr['val'][0]));
		$this->text_required('Name', $result['name']);
		$this->text_unique('Username', $result['username']);
	$this->div_close();
	$this->div_open(3, 4);
		if($this->act == 'insert'){
			$this->password_required();
		} else {
			$this->password();
		}
		$arr = $this->level_arr();
		$this->dropdown_required('Level', $arr, $arr, $this->val($result['level'], $arr[0]));
	$this->div_close();
	$this->submit();
$this->form_close();
?>