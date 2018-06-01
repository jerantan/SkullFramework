<?php
// Skull Header
/* ================================================================================================ */
// error_reporting(0);

// Identify if it's Load or Request
$proc = (isset($_POST['proc']))? $_POST['proc'] : '';

// Browser Restriction
/* ------------------------------------------------------------------------------------------------ */
if(!$proc){
	function getBrowser(){
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version = '';

		// First get the platform?
		if(preg_match('/linux/i', $u_agent)){
			$platform = 'Linux';
		} elseif(preg_match('/macintosh|mac os x/i', $u_agent)){
			$platform = 'Mac';
		} elseif(preg_match('/windows|win32/i', $u_agent)){
			$platform = 'Windows';
		}

		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)){ 
			$bname = 'Internet Explorer'; 
			$ub = 'MSIE'; 
		} elseif(preg_match('/Firefox/i', $u_agent)){ 
			$bname = 'Mozilla Firefox'; 
			$ub = 'Firefox'; 
		} elseif(preg_match('/Chrome/i', $u_agent)){ 
			$bname = 'Google Chrome'; 
			$ub = 'Chrome'; 
		} elseif(preg_match('/Safari/i', $u_agent)){ 
			$bname = 'Apple Safari'; 
			$ub = 'Safari'; 
		} elseif(preg_match('/Opera/i', $u_agent)){ 
			$bname = 'Opera'; 
			$ub = 'Opera'; 
		} elseif(preg_match('/Netscape/i', $u_agent)){ 
			$bname = 'Netscape'; 
			$ub = 'Netscape'; 
		}

		// Finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

		if(!preg_match_all($pattern, $u_agent, $matches)){
			// We have no matching number just continue
		}

		// See how many we have
		$i = count($matches['browser']);

		if($i != 1){
			// We will have two since we are not using 'other' argument yet
			// See if version is before or after the name
			if(strripos($u_agent, 'Version') < strripos($u_agent, $ub)){
				$version = $matches['version'][0];
			} else {
				$version = $matches['version'][1];
			}
		} else {
			$version = $matches['version'][0];
		}

		// Check if we have a number
		if($version == null || $version == ''){
			$version = '?';
		}

		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'   => $pattern
		);
	}

	$browser = getBrowser();
	if($browser['name'] == 'Internet Explorer'){
		exit('Browser can\'t support the system. Please try with other browser.');
	}
}
/* ------------------------------------------------------------------------------------------------ */

// Request URI
/* ------------------------------------------------------------------------------------------------ */
define('request_uri', $_REQUEST['uri']);

// Redirect If Index
if(strpos(request_uri, 'index.php') !== false)
header('location: '.domain.str_replace('index.php/', '', request_uri));
// /Redirect If Index

// Identify if Status 200 or 404
define('type', (!request_uri || file_exists(root.request_uri.'index.php'))? 1 : 0);

// URI Parser
function parse(){
	if(!request_uri || !type){
		$module = 'main';
		$page = '';
	} else {
		$parse_arr = explode('/', request_uri);
		$module = $parse_arr[0];
		$page = $parse_arr[1];
	}
	$uri = ($page)? $module.'/'.$page.'/' : $module.'/';
	return array('module' => $module, 'page' => $page, 'uri' => $uri);
}
/* ------------------------------------------------------------------------------------------------ */

// Initiate Parser
/* ================================================================================================ */
/* ================================================================================================ */
/* ================================================================================================ */
/* =================================== */ $parse = parse(); /* ==================================== */
/* ================================================================================================ */
/* ================================================================================================ */
/* ================================================================================================ */
// /Initiate Parser

// Plug Config
/* ------------------------------------------------------------------------------------------------ */
require_once root.'_spec/func/config.php';
/* ------------------------------------------------------------------------------------------------ */

session_start();
/* ================================================================================================ */

class db{
	function con(){
		return mysql_connect(dbhost, dbuser, dbpass);
	}
	
	function open(){
		mysql_select_db(dbname, $this->con()) || $this->query('CREATE DATABASE '.dbname) && header('location: '.domain.tbl.'/');
	}
	
	function close(){
		mysql_close($this->con());
	}
}

class sql extends db{
	function __construct(){
		$this->open();
	}

	function query($sql){
		return mysql_query($sql);
	}

	function fetch($data){
		return mysql_fetch_array($data);
	}
	
	function count($data){
		return mysql_num_rows($data);
	}
	
	function select(){
		return $data = $this->query("select $this->field from $this->table $this->clause");
	}
	
	function insert(){
		$this->query("insert into $this->table($this->field) values($this->value)");
	}
	
	function id(){
		return mysql_insert_id();
	}

	function next_id(){
        $data = $this->query("show table status where name = '".$this->table."'");
        $result = $this->fetch($data);
        return $result['Auto_increment'];
    }
	
	function update(){
		$this->query("update $this->table set $this->field_value where $this->clause");
	}
	
	function delete(){
		$this->query("delete from $this->table where $this->clause");
	}
	
	function __destruct(){
		$this->close();
	}
}

class skull{
	public $table;
	public $act;
	public $id;

	function session(){
		if(isset($_SESSION[session])){
			return $_SESSION[session];
		}
	}

	function limit_arr(){
		return array('10', '25', '50', '100');
	}
	
	function active_arr(){
		$val = array('1', '0');
		$opt = array('Yes', 'No');
		return array('val' => $val, 'opt' => $opt);
	}
	
	function level_arr(){
		return array('Asst. Admin', 'Guest');
	}

	function name_arr($table){
		$sql = $this->sql;
		$sql->field = 'id, name';
		$sql->table = $table;
		$sql->clause = 'order by name';
		$data = $sql->select();

		while($result = $sql->fetch($data)){
			$result_val[] = $result['id'];
			$result_opt[] = $result['name'];
		}
		return array('val' => $result_val, 'opt' => $result_opt);
	}
	
	function title($title){
		switch($title){
			case 'main ':
				$this->title = 'Welcome '.$this->userdata['name'];
			break;
			case 'user profile':
				$this->title = 'Profile: '.$this->userdata['level'];
			break;
			default:
				$arr = explode(' ', $title);
				foreach($arr as $word){
					$title_arr[] = ucfirst($word);
				}
				$this->title = implode(' ', $title_arr);
			break;
		}
	}
	
	function link($url){
		echo domain.$url;
	}
	
	function variable($label){
		$find = array(' #', '.', "'");
		$label = strtolower(str_replace($find, '', $label));
		
		$find = array(' : ', ' ');
		return str_replace($find, '_', $label);
	}
	
	function label($label){
		if(strpos($label, ' : ') !== false){
			$arr = explode(' : ', $label);
			$label = $arr['1'];
		}
		return $label;
	}

	function trim($label){
		switch($label){
			default:
				$label = str_replace('another_', '', $label);
			break;
		}
		return $label;
	}
	
	function paging($field, $clause){
		$start = $this->start;
		if(!$this->limit){
			$arr = $this->limit_arr();
			$this->limit = $arr[0];
		}
		
		$limit = $this->limit;
		$start = $start * $limit;
		$back = $start / $limit - 1;
		$next = $start / $limit + 1;
		
		$sql = $this->sql;
		$sql->field = $this->table.'.id';
		$sql->table = $this->table;
		$sql->clause = $clause;
		$data = $sql->select();
		$total = $sql->count($data);

		/*if($start == $total){ // Temporarily commented out, this will be clarify in delete functionality.
			$start = $start - $limit;
			$back = $back - 1;
			$next = $next - 1;
		}*/
		
		if($field){	
			$field = ", $field";
		}
		
		$sql1 = $this->sql;
		$sql1->field = $this->table.".id $field";
		$sql1->table = $this->table;
		$sql1->clause = "$clause limit $start, $limit";
		$list = $sql1->select();
		$count = $sql1->count($list);

		$pages = ceil($total / $limit);
		$arr = array(
			'start' => $start,
			'back' => $back,
			'next' => $next,
			'total' => $total,
			'list' => $list,
			'count' => $count,
			'pages' => $pages
		);
		$this->paging = $arr;
	}
	
	function format($format, $val){
		return date($format, strtotime($val));
	}
	
	function name($val){
		if(strpos($val, ', ') !== false){
			$val = strtolower($val);
			$val = explode(', ', $val);
			$lname = ucfirst($val[0]);

			$val = explode(' ', $val[1]);
			$fname = ucfirst($val[0]);
			$mname = ucfirst($val[1]);

			$val = $lname.', '.$fname.' '.$mname;
		}
		return $val;
	}
	
	function suffix($condition, $singular, $plural){
		if($condition <= 1){
			return $singular;
		} else {
			return $plural;
		}
	}
	
	function val($val, $default){
		if($this->act == 'insert' || $val != ''){
			if($val == ''){
				return $default;
			} else {
				return $val;   
			}
		}
    }
    
    function inc_val($val, $table){
		if($this->act == 'insert' || $val != ''){
			if($val == ''){
				$sql = $this->sql;
				$sql->table = $table;
				return $sql->next_id();
			} else {
				return $val;   
			}
		}
    }
	
	function date_val($format, $val){
		if($this->act == 'insert' || $val != ''){
			if($val == ''){
				return $this->format($format, now);
			} else {
				if($val != '0000-00-00 00:00:00'){
					return $this->format($format, $val);
				}
			}
		}
	}
	
	function field(){
		$sql = $this->sql;
		$sql->field = 'table_name, field_name';
		$sql->table = 'field';
		$sql->clause = "where table_name = '".$this->table."' && active";
		$data = $sql->select();
		
		$this->field_orig_arr = array();
		$this->field_arr = array();

		while($result = $sql->fetch($data)){
			$result_table_name = $result['table_name'];
			$result_field_name = $result['field_name'];
			
			$this->field_orig_arr[] = $result_field_name;
			$field_name = $result_table_name.'.'.$result_field_name;
			$this->field_switch($field_name);
		}
	}

	function field_switch($field_name){
		switch($field_name){
			default:
				$this->field_arr[] = $field_name;
			break;
		}
	}

	function field_list(){
		return implode(', ', $this->field_arr);
	}
	
	function like_clause($operator = ''){
		if($this->search != ''){
			$clause = '';
			if(count($this->field_arr)){
				$clause .= "$operator (";
			}
			
			foreach($this->field_arr as $key => $field_name){
				if($field_name == $this->table.'.active'){
					switch($this->search){
						case 'active':
							$clause .= "$field_name = 1";
						break;
						case 'inactive':
							$clause .= "$field_name = 0";
						break;
						default:
							$clause .= "$field_name like '%".$this->search."%'";
						break;
					}
				} else {
					$clause .= $this->like_clause_switch($field_name);
				}

				if($key < count($this->field_arr) - 1){
					$clause .= ' || ';
				}
			}
			
			if(count($this->field_arr)){
				$clause .= ")";
			}
			return $clause;
		}
	}

	function like_clause_switch($field_name){
		switch($field_name){
			default:
				$clause = "$field_name like '%".$this->search."%'";
			break;
		}
		return $clause;
	}

	function compress($extension, $target){
		$list_arr = explode(', ', image);
		if(in_array($extension, $list_arr)){
			$this->compress_img($target, $target, 50);
		}
	}

	function compress_img($source, $destination, $quality){
		$info = getimagesize($source);
		switch($info['mime']){
			case 'image/jpeg':
				$img = imagecreatefromjpeg($source);
			break;
			case 'image/png':
				$img = imagecreatefrompng($source);
			break;
			case 'image/gif':
				$img = imagecreatefromgif($source);
			break;
		}	
		imagejpeg($img, $destination, $quality);
	}

	function url($dir){
		return str_replace(dir, domain, $dir);
	}

	function path($by, $table, $id){
		switch($by){
			case 'entry':
				$path = upload.$by.'/'.$table.'/'.$id.'/';
			break;
			case 'setup':
				$path = upload.$by.'/'.$table.'/';
			break;
			case 'profile':
				$session_id = $this->session();
				if($id != $session_id){
					$path = upload.$by.'/'.$id.'/'.$table.'/';
				} else {
					$path = upload.$by.'/'.$session_id.'/'.$table.'/';
				}
			break;
		}
		return $path;
	}

	function bottom(){
		$this->notice('html');
		$this->form3();
		$this->form2();
		$this->form1();
		$this->form();
		$this->del_box();
	}

	// Build
	/* ------------------------------------------------------------------------------------------------ */
	function temp(){
		$view = $this->view();
		$temp = root.$this->uri.temp;
		$temp = (file_exists($temp))? $temp : root.temp;
		require_once $temp;
	}

	function view(){
		ob_start();
		if(type){
			require_once root.$this->uri.'index.php';
		} else {
			echo '
				<div style="font-family: times new roman">
					<h1 style="font-weight: bold">Not Found</h1> <p>The requested URL '.$_SERVER['REQUEST_URI'].' was not found on this server.</p>
				</div>
			';
		}
		$view = ob_get_contents();
		ob_end_clean();
		return $view;
	}

	function widget($name){
		$path = "_spec/widg/$name/index.php";
		$widget = root.$this->uri.$path;
		$widget = (file_exists($widget))? $widget : root.$path;
		if(file_exists($widget)){
			if($name != 'header') $this->inject($widget);
			require_once $widget;
		}
	}
	/* ------------------------------------------------------------------------------------------------ */
}

// Skull Footer
/* ================================================================================================ */
// Constant
define('version', 'Skull '.build);
define('temp', '_spec/func/temp.php');
define('spec', '_spec/func/spec.php');
define('iud', '_spec/func/iud.php');

// Plug Library
require_once 'proc.php';
require_once 'html.php';
require_once 'field.php';

// Plug Spec
require_once root.spec;

// Plug Specs
require_once root.$parse['uri'].spec;

// Plug Constant
require_once 'cons.php';
/* ================================================================================================ */









// Initialize
/* ================================================================================================ */
$skull = new specs;
$skull->module = $parse['module'];
$skull->page = $parse['page'];
$skull->uri = $parse['uri'];
if(!$proc){
	$skull->title($skull->module.' '.$skull->page);
	$skull->temp();
} else {
	exit($skull->$proc());
}
/* ================================================================================================ */
?>