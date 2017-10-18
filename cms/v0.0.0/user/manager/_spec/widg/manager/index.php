<?php
/*
Display Rule Usage
$rule['field name you want to add rule']; // 1st dimension
$rule['sample'][align]; // 2nd dimension, default value/if blank/undefined is center == $this->td(); left == $this->tdl(); right == $this->tdr();
$rule['sample']['title']; // 2nd dimension, specify the table column title how it appears or how it spells. 
*/
$rule = array(
	'name' => array(
		'align' => 'left'
	),
	'username' => array(
		'align' => 'left'
	),
	'level' => array(
		'align' => 'left'
	),
	'active' => array(
		'title' => 'Active?'
	)
);
$this->content_option();
$this->paging($this->field_list(), "where level != 'Admin' ".$this->like_clause('&&')." order by name");
	$this->table_header();
		$this->table_body($rule);
	$this->table_footer("where level != 'Admin'");
$this->pager();
?>