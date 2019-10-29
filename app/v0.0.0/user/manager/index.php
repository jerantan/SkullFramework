<?php
if(!$this->restricted(1)){
  $this->table = $this->module;
  $this->request = $this->uri;
  $this->content_open(12, 12, ucfirst($this->table).' '.term);
    $this->search();
    $this->load();
  $this->content_close();
}
?>