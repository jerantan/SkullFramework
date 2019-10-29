<?php
include 'plug/custom/theme.php';
$sql = $this->sql;
$sql->field = 'name, username, level, active';
$sql->table = $this->table;
$sql->clause = "where id = '".$this->id."'";
$data = $sql->select();
$result = $sql->fetch($data);
$this->form_option($result['name']);
// Single Form
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
  // Test functions
    $this->div_open(12, 12);
      $this->chosen('User', $this->id);
    $this->div_close();
    $this->div_open(12, 12);
      $this->chosen_required('Another : User', $this->id);
    $this->div_close();
    $this->div_open(12, 12);
      $this->upload_type = 'image, audio, video';
      $this->upload_by = 'entry';
      $this->upload_required('Photo', 1);
    $this->div_close();
    $this->div_open(12, 12);
      $this->upload_type = 'image, audio, video';
      $this->upload_by = 'setup';
      $this->upload('Another : Photo', 1);
    $this->div_close();
    /*$this->div_open(12, 12);
      $this->date('Date', '', 2017, 2020, js_numeric, 1);
    $this->div_close();
    $this->div_open(12, 12);
      $this->date_required('Another : Date', '', 2017, 2020, js_alpha);
    $this->div_close();
    $this->div_open(12, 12);
      $this->number('Number', '');
    $this->div_close();
    $this->div_open(12, 12);
      $this->number_required('Another : Number', '');
    $this->div_close();*/
    $this->div_open(12, 12);
      $this->measure('Measure', '');
    $this->div_close();
    $this->div_open(12, 12);
      $this->measure_required('Another : Measure', '');
    $this->div_close();
    /*$this->div_open(12, 12);
      $this->amount('Amount', '');
    $this->div_close();
    $this->div_open(12, 12);
      $this->amount_required('Another : Amount', '');
    $this->div_close();
    $this->div_open(12, 12);
      $this->percent('Percent', '');
    $this->div_close();
    $this->div_open(12, 12);
      $this->percent_required('Another : Percent', '');
    $this->div_close();*/
  // /Test functions
  $this->submit();
$this->form_close(0);

// Multi Form
/*$this->content1_open(12, 12, 'User Form');
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
    // Test functions
      $this->div_open(12, 12);
        $this->chosen('User', $this->id);
      $this->div_close();
      $this->div_open(12, 12);
        $this->chosen_required('Another : User', $this->id);
      $this->div_close();
      $this->div_open(12, 12);
        $this->upload_type = 'image, audio, video';
        $this->upload_by = 'entry';
        $this->upload('Photo', 1);
      $this->div_close();
      $this->div_open(12, 12);
        $this->upload_type = 'image, audio, video';
        $this->upload_by = 'setup';
        $this->upload_required('Another : Photo', 1);
      $this->div_close();
    // /Test functions
    $this->div_open(12, 12);
      $this->submit();
    $this->div_close();
  $this->form_close(0);
$this->content1_close();
$this->clear();
$this->content1_open(12, 12, 'Another User Form');
  $this->form_open('another_'.$this->table);
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
    // Test functions
      $this->div_open(12, 12);
        $this->chosen('User', $this->id);
      $this->div_close();
      $this->div_open(12, 12);
        $this->chosen_required('Another : User', $this->id);
      $this->div_close();
      $this->div_open(12, 12);
        $this->upload_type = 'image, audio, video';
        $this->upload_by = 'entry';
        $this->upload('Photo', 1);
      $this->div_close();
      $this->div_open(12, 12);
        $this->upload_type = 'image, audio, video';
        $this->upload_by = 'setup';
        $this->upload_required('Another : Photo', 1);
      $this->div_close();
    // /Test functions
    $this->div_open(12, 12);
      $this->submit();
    $this->div_close();
  $this->form_close(0);
$this->content1_close();*/
?>