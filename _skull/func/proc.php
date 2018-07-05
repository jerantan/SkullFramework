<?php
class proc extends skull{
	function signin(){
		$table = $_POST['table'];
		$field = $_POST['field'];
		$val = $_POST['val'];
		$pass = $_POST['pass'];

		$sql = $this->sql;
		$sql->field = 'id, active';
		$sql->table = $table;
		$sql->clause = "where $field = '$val' and password = md5('$pass')";
		$data = $sql->select();

		if($sql->count($data)){
			$result = $sql->fetch($data);
			$_SESSION[session] = $result['id'];
			echo $result['active'];
		} else {
			echo '-';
		}
	}

	function signout(){
		$_SESSION[session] = '';
	}

	function manager(){
		$this->table = $_POST['table'];
		$this->request = $this->uri;
		$this->search = $_POST['search'];
		$this->start = $_POST['start'];
		$this->limit = $_POST['limit'];
		$this->widget('manager');
	}

	function fillin(){
		$this->table = $_POST['table'];
		$this->request = $this->uri;
		$this->act = $_POST['act'];
		$this->id = $_POST['id'];
		$this->widget('form');
	}

	function setting(){
		$table = $_POST['table'];
		$this->table = 'field';
		$this->request = '';
		if(!$this->restricted(1)){
			$this->content1_open(12, 12, ucfirst($table).' Field '.term);
				$this->search($table);
				$this->load();
			$this->content1_close();
			$this->widget('setup');
		}
	}

	function activate(){
		$table = $_POST['table'];
		$val = $_POST['val'];
		$id = $_POST['id'];
		
		if(!$val){
			$val = 1;
		} else {
			$val = 0;
		}
		
		$sql = $this->sql;
		$sql->table = $table;
		$sql->field_value = "active = '$val'";
		$sql->clause = "id = '$id'";
		$sql->update();
	}

	function insert(){
		$proc = $_POST['proc'];
		$table = $_POST['table'];
		include root.$this->uri.iud;
	}

	function update(){
		$proc = $_POST['proc'];
		$table = $_POST['table'];
		$id = $_POST['id'];
		include root.$this->uri.iud;
	}

	function delete(){
		$proc = $_POST['proc'];
		$table = $_POST['table'];
		$id = $_POST['id'];
		$val = $_POST['val'];
		$by = '';
		include root.$this->uri.iud;
		$this->unlink($by, $table, $id, $val);
		if(!$val){
			$sql = $this->sql;
			$sql->table = $table;
			$sql->clause = "id = '$id'";
			$sql->delete();
		}
	}

	function unique(){
		$table = $_POST['table'];
		$field = $_POST['field'];
		$val = $_POST['val'];
		$id = $_POST['id'];
		
		$sql = $this->sql;
		$sql->field = $field;
		$sql->table = $table;
		$sql->clause = "where $field = '$val' and id != '$id'";
		$data = $sql->select();
		echo $sql->count($data);
	}

	function choose(){
		$this->act = $_POST['act'];
		$sel = $_POST['sel'];
		$this->form = $_POST['form'];
		$var = $_POST['variable'];
		
		$arr = $this->name_arr($_POST['table']);
		$this->chosen_field($var, $arr['val'], $arr['opt'], $sel);
	}

	function copy(){
		$by = $_POST['by'];
		$table = $_POST['table'];
		$id = $_POST['id'];
		$file = $_FILES['file_upload'];
		$extension = end(explode('.', $file['name']));
		$tmppath = $file['tmp_name'];

		$find = array('-', ' ', ':');
		$filename = str_replace($find, '', date).substr(microtime(), 2, 6).'.'.$extension;
		$destination = $this->path($by, $table, $id);
		if(!file_exists($destination)) mkdir($destination, 0777, true);
		move_uploaded_file($tmppath, $destination.$filename);
		$this->compress($extension, $destination.$filename);
		echo $filename;
	}
}
?>