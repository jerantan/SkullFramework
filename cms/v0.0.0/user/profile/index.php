<?php
if(!$this->restricted(0)){
	$this->table = $this->module;
	$this->request = $this->uri;
	$this->act = 'update';
	$this->id = $this->session();

	$sql = $this->sql;
	$sql->field = 'username';
	$sql->table = $this->table;
	$sql->clause = "where id = '".$this->id."'";
	$data = $sql->select();
	$result = $sql->fetch($data);

	$this->content_open(12, 12, $this->title);
		$this->form_open('profile');
			$this->div_open(3, 4);
				$this->text_required('Name', $this->userdata['name']);
				$this->text_unique('Username', $result['username']);
			$this->div_close();
			
			$this->div_open(3, 4);
				$this->password();
			$this->div_close();
			
			$this->submit();
		$this->form_close(0);
	$this->content_close();
}
?>