<?php
define('build', getenv('build'));
define('skull_root', str_replace('cms', '_skull', $_SERVER['DOCUMENT_ROOT']));
define('skull_domain', 'http://skull.com/');
define('root', $_SERVER['DOCUMENT_ROOT'].build.'/');
define('domain', 'http://'.$_SERVER['HTTP_HOST'].'/');
require_once skull_root.'func/skull.php';
?>