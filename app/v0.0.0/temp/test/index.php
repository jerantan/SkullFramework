<?php
if(!$this->restricted(1)){
  // Override
    // $this->title = 'Lorem Ipsum Dolor'; // Customize title.
    $this->module = 'user'; // If you will not override, make sure you have the table on your database named the same as this module.
    // $this->uri = $this->module.'/manager/'; // load user module in this module.
  // /Override
  $this->table = $this->module;
  $this->request = $this->uri;
  $this->content_open(12, 12, ucfirst($this->table).' '.term);
    $this->search();
    $this->load();
  $this->content_close();
}
?>