<?php
/*
Display Rule Usage
$rule['field name you want to add rule']; // 1st dimension
$rule['sample'][align]; // 2nd dimension, default value/if blank/undefined is center == $this->td(); left == $this->tdl(); right == $this->tdr();
$rule['sample']['title']; // 2nd dimension, specify the table column title how it appears or how it spells. 
*/
$rule = array(
	'field_name' => array(
		'align' => 'left',
		'title' => 'Name'
	),
	'active' => array(
		'title' => 'Active?'
	)
);
// Override
	$this->table = 'field';
	$this->request = $this->table.'/';
	$this->field_orig_arr = array('field_name', 'active');
	$this->field_arr = array('field.field_name', 'field.active');
// /Override
$this->paging($this->field_list(), "where table_name = '".$this->search."'");
	$this->table_header();
		$this->table_body($rule);
	$this->table_footer("where table_name = '".$this->search."'");
$this->pager();
?>