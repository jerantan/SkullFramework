<?php
class html extends proc{
  // Notice
  /* ------------------------------------------------------------------------------------------------ */
  function notice($id){ ?><div id="<?php echo $id; ?>_notice_main_div" class="notice_main_div"></div><?php }
  function notice_err($msg){ ?><div class="col-md-2 col-sm-3 col-xs-4 notice_prop notice_div notice_err err"><i class="glyphicon glyphicon-remove-circle"></i> <?php echo $msg; ?></div><?php }
  function notice_ok($msg){ ?><div class="col-md-2 col-sm-3 col-xs-4 notice_prop notice_div notice_ok ok"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo $msg; ?></div><?php }
  function notice_info($msg){ ?><div class="notice_div notice_info info alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="glyphicon glyphicon-info-sign"></i> <?php echo $msg; ?></div><?php }
  function notice_fine($msg){ ?><div class="col-md-2 col-sm-3 col-xs-4 notice_prop notice_div notice_fine fine"><img src="<?php echo skull_domain; ?>img/loader.gif"> <?php echo $msg; ?></div><?php }
  function notice_prog(){ ?><div class="col-md-2 col-sm-3 col-xs-4 notice_prop notice_div progress"><div class="progress-bar progress-bar-striped active"></div></div><?php }

  // Static Form
  /* ------------------------------------------------------------------------------------------------ */
  function content_open($md, $sm, $title){
    ?>
      <div class="col-md-<?php echo $md; ?> col-sm-<?php echo $sm; ?> content_main_div float_center radius shadow">
        <div class="row no_margin">
          <?php $this->clear(); ?>
          <form action="<?php $this->link('main/'); ?>">
            <button type="submit" class="close">&times;</button>
          </form>
          <?php $this->h(3, $title); ?>
          <?php $this->hr(); ?>
          <div class="row no_margin">
    <?php
  }

  function content_close(){
    ?>
          </div>
          <?php $this->hr(); ?>
          <form action="<?php $this->link('main/'); ?>">
            <?php $this->button('submit', 'Close', 'btn-default float_right'); ?>
          </form>
          <?php $this->clear(); ?>
        </div>
      </div>
    <?php
    $this->clear();
  }

  function content_option(){
    ?>
      <span class="dropdown navbar-right option" data-toggle="tooltip" data-placement="top" title="Option">
        <?php $this->button_dropdown('', 'close'); ?>
        <ul class="dropdown-menu" role="menu">
          <li><?php $this->setup($this->table, $this->request, 1, 'Setup'); ?></li>
        </ul>
      </span>
    <?php
    $this->field();
  }

  function content1_open($md, $sm, $title){
    ?>
      <div class="col-md-<?php echo $md; ?> col-sm-<?php echo $sm; ?> content1_main_div float_center border radius">
        <div class="row no_margin">
          <?php $this->h(4, $title); ?>
          <?php $this->hr(); ?>
          <div class="row no_margin">
    <?php
  }

  function content1_close($type = ''){
    ?>
          </div>
          <?php if($type){ ?>
            <?php $this->hr(); ?>
            <?php $this->clear(); ?>
          <?php } ?>
        </div>
      </div>
    <?php
    $this->clear();
  }

  // Modal Form
  /* ------------------------------------------------------------------------------------------------ */
  function form($type){
    ?>
      <div class="form<?php echo $type; ?>_prop form<?php echo $type; ?>_main_div">
        <div class="form<?php echo $type; ?>_prop form<?php echo $type; ?>_main_back_div"></div>
        <div class="form<?php echo $type; ?>_prop form<?php echo $type; ?>_back_div"></div>
        <br><br><br><br><br>
        <div class="form<?php echo $type; ?>_content_div radius shadow">
          <div class="row no_margin">
            <?php $this->clear(); ?>
            <input type="hidden" name="form_hidden_field[]" class="form<?php echo $type; ?>_hidden_field">
            <button type="button" class="close">&times;</button>
            <h3 class="form<?php echo $type; ?>_title"></h3>
            <?php $this->hr(); ?>

            <div class="row no_margin">
              <div class="form<?php echo $type; ?>_load_div"></div>
            </div>

            <?php $this->hr(); ?>
            <?php $this->button('button', 'Close', "btn-default form{$type}_close_button float_right"); ?>
            <?php $this->clear(); ?>
          </div>
        </div>
      </div>
    <?php
  }

  function form_option($val){
    ?>
      <span class="dropdown navbar-right option" data-toggle="tooltip" data-placement="top" title="Option">
        <?php $this->button_dropdown('', 'close'); ?>

        <ul class="dropdown-menu" role="menu">
          <li><?php $this->a($this->request, term, '', 'list-alt'); ?></li>

          <?php if($this->act != 'insert'){ ?>
            <li><?php $this->add_record($this->table, $this->request, 1, 'Add'); ?></li>

            <?php if($this->act == 'view'){ ?>
              <li><?php $this->update_record($this->table, $this->request, $this->id, 1, 'Update'); ?></li>
            <?php } ?>

            <li><?php $this->delete_record($this->table, $this->request, $val, $this->id, 1, 'Delete'); ?></li>
          <?php } ?>
        </ul>
      </span>
    <?php
  }

  // Table
  /* ------------------------------------------------------------------------------------------------ */
  function table_header(){
    if($this->search == ''){
      if(!$this->paging['total']){
        ?>
          <script>
            $('#<?php echo ($this->table != "field")? $this->table : $this->module; ?>_search_main_div').hide();
          </script>
          <center>
            <?php if($this->table != 'field') $this->add_record($this->table, $this->request, 1, 'Add Record'); $this->clear(); ?>
          </center>
        <?php
        exit();
      }
    }
    ?>
      <div class="row">
        <div class="col-xs-6">
          <?php $this->limit(); ?>
        </div>
        <div class="col-xs-6 align_right">
          <?php $this->add_record($this->table, $this->request, 0, 'Add Record'); ?>
        </div>
      </div>
    <?php
  }

  function table_body($rule){
    $this->table_open();
      $this->tr_open(1);
        $this->td('#');
          foreach($this->field_orig_arr as $field_name){
            if(isset($rule[$field_name]['align'])){
              $align = $rule[$field_name]['align'];
            } else {
              $align = 'center';
            }

            if(isset($rule[$field_name]['title'])){
              $title = $rule[$field_name]['title'];
            } else {
              $title = ucfirst($field_name);
            }

            if($field_name == $this->sortField){
              $sortType = ' sort_'.$this->sortType;
              switch($this->sortType){
                case 'asc':
                  $nextSort = 'desc';
                break;
                case 'desc':
                  $nextSort = '';
                break;
                default:
                  $nextSort = 'asc';
                break;
              }
            } else {
              $sortType = ''; $nextSort = 'asc';
            }

            $onSort = "'$this->table', '$this->request', '{$field_name}_sort_{$nextSort}'";
            $sortID = ($sortType)? 'id="'.$field_name.'_sort_'.$this->sortType.'"' : '';
            $title = '
              <a '.$sortID.' class="pointer'.$sortType.'" onclick="sort('.$onSort.');">
                '.$title.'
                <span class="tri_span">
                  <span class="triup_span">
                    <b class="triup"></b>
                  </span>
                  <span class="tridown_span">
                    <b class="tridown"></b>
                  </span>
                </span>
              </a>
            ';

            switch($align){
              case 'left':
                $this->tdl($title);
              break;
              case 'center':
                $this->td($title);
              break;
              case 'right':
                $this->tdr($title);
              break;
            }
          }
        if($this->table != 'field'){
          $this->td('Action');
        }
      $this->tr_close();
      $count = $this->paging['start'] + 1;
      while($result = $this->sql->fetch($this->paging['list'])){
        $this->tr_open();
          $this->td($count++);
            foreach($this->field_orig_arr as $field_name){
              if(isset($rule[$field_name]['align'])){
                $align = $rule[$field_name]['align'];
              } else {
                $align = 'center';
              }

              switch($align){
                case 'left':
                  if($field_name == 'name'){
                    $result_name = $this->name($result['name']);
                    $this->tdl($result_name);
                  } else {
                    $this->tdl($result[$field_name]);
                  }
                break;
                case 'center':
                  if($field_name == 'active'){
                    $this->active($result[$field_name], $result['id']);
                  } elseif($field_name == 'added' || $field_name == 'updated'){
                    $this->td($this->date_val(date_time, $result[$field_name]));
                  } else {
                    $this->td($result[$field_name]);
                  }
                break;
                case 'right':
                  $this->tdr($result[$field_name]);
                break;
              }
            }
          if($this->table != 'field'){
            $identity = (isset($result['name']))? $result_name : ucfirst($this->table).' ID : '.$result['id'];
            $this->action($identity, $result['id']);
          }
        $this->tr_close();
      }
    $this->table_close();
  }

  function table_footer($clause){
    $display = 'Showing '.($this->paging['start'] + 1).' - '.($this->paging['start'] + $this->paging['count']).' Of '.$this->paging['total'].' Entr'.$this->suffix($this->paging['total'], 'y', 'ies');
    if($this->search != ''){
      if(!$this->paging['total']){
        $display = 'Showing 0 - 0 Of 0 Entry';
        echo '<div class="none">No Record Found.</div>';
      }

      $sql = $this->sql;
      $sql->field = $this->table.'.id';
      $sql->table = $this->table;
      $sql->clause = $clause;
      $data = $sql->select();
      $total = $sql->count($data);

      $display .= ' (Filtered From '.$total.' Total Entr'.$this->suffix($total, 'y', 'ies').')';
    }
    echo $display;
  }

  function table_open(){
    ?>
      <div id="<?php echo $this->table; ?>_table_main_div" class="table-res table_main_div panel panel-default">
        <table class="table table-condensed table-bordered table-striped table-hover align_center">
    <?php
  }

  function table_close(){
    ?>
        </table>
      </div>
    <?php
  }

  function tr_open($type = ''){
    if($type){
      ?>
        <tr class="active">
      <?php
    } else {
      ?>
        <tr>
      <?php
    }
  }

  function tr_close(){
    ?>
      </tr>
    <?php
  }

  function tdl($val){
    ?>
      <td class="align_left"><?php echo $val; ?></td>
    <?php
  }

  function td($val){
    ?>
      <td><?php echo $val; ?></td>
    <?php
  }

  function tdr($val){
    ?>
      <td class="align_right"><?php echo $val; ?></td>
    <?php
  }

  // Anchor
  /* ------------------------------------------------------------------------------------------------ */
  function a($url, $caption, $class = '', $icon = ''){
    ?>
      <a href="<?php if($url){ $this->link($url); } ?>" <?php if($class){ ?> class="<?php echo $class; ?>" <?php } ?>>
        <?php if($icon){ ?>
          <i class="glyphicon glyphicon-<?php echo $icon; ?>"></i>
        <?php } ?>
        <?php echo $caption; ?>
      </a>
    <?php
  }

  function add_record($table, $request, $type, $caption){
    ?>
      <a href="<?php $this->link("$request#$table/add"); ?>" id="<?php echo $table; ?>_add_record_link" class="add_record_link" onclick="form0_open('<?php echo $table; ?>', '<?php echo $request; ?>', 'insert'); return false" <?php if(!$caption){ ?> data-toggle="tooltip" data-placement="top" title="Add Record" <?php } ?>>
        <?php if($type){ ?>
          <i class="glyphicon glyphicon-plus-sign info"></i>
        <?php } ?>
        <?php echo $caption; ?>
      </a>
      <script>
        $('[data-toggle="tooltip"]').tooltip();
      </script>
    <?php
  }

  function view_record($table, $request, $id, $type, $caption = ''){
    ?>
      <a href="<?php $this->link("$request#$table/view/$id"); ?>" onclick="form0_open('<?php echo $table; ?>', '<?php echo $request; ?>', 'view', '<?php echo $id; ?>'); return false" <?php if(!$caption){ ?> data-toggle="tooltip" data-placement="top" title="View Record" <?php } ?>>
        <?php if($type){ ?>
          <i class="glyphicon glyphicon-folder-open" style="color: orange"></i>
        <?php } ?>
        <?php echo $caption; ?>
      </a>
    <?php
  }

  function update_record($table, $request, $id, $type, $caption = ''){
    ?>
      <a href="<?php $this->link("$request#$table/update/$id"); ?>" onclick="form0_open('<?php echo $table; ?>', '<?php echo $request; ?>', 'update', '<?php echo $id; ?>'); return false" <?php if(!$caption){ ?> data-toggle="tooltip" data-placement="top" title="Update Record" <?php } ?>>
        <?php if($type){ ?>
          <i class="glyphicon glyphicon-pencil fine"></i>
        <?php } ?>
        <?php echo $caption; ?>
      </a>
    <?php
  }

  function delete_record($table, $request, $val, $id, $type, $caption = ''){
    ?>
      <a class="pointer" onclick="del_box('<?php echo $table; ?>', '<?php echo $request; ?>', '<?php echo $val; ?>', '<?php echo $id; ?>'); return false" <?php if(!$caption){ ?> data-toggle="tooltip" data-placement="top" title="Delete Record" <?php } ?>>
        <?php if($type){ ?>
          <i class="glyphicon glyphicon-trash err"></i>
        <?php } ?>
        <?php echo $caption; ?>
      </a>
    <?php
  }

  function setup($table, $request, $type, $caption){
    ?>
      <a href="<?php $this->link("$request#$table/setup"); ?>" onclick="form1_open('<?php echo $table; ?>', '<?php echo $request; ?>'); return false" <?php if(!$caption){ ?> data-toggle="tooltip" data-placement="top" title="Delete Record" <?php } ?>>
        <?php if($type){ ?>
          <i class="glyphicon glyphicon-cog"></i>
        <?php } ?>
        <?php echo $caption; ?>
      </a>
    <?php
  }

  // Button
  /* ------------------------------------------------------------------------------------------------ */
  function button($type, $caption, $class, $icon = ''){
    ?>
      <button type="<?php echo $type; ?>" class="btn btn-sm <?php echo $class; ?>">
        <?php if($icon){ ?>
          <i class="glyphicon glyphicon-<?php echo $icon; ?>"></i>
        <?php } ?>
        <?php echo $caption; ?>
      </button>
    <?php
  }

  function button_dropdown($caption, $class){
    ?>
      <button class="dropdown-toggle <?php echo $class; ?>" data-toggle="dropdown">
        <?php echo $caption; ?> <b class="caret"></b>
      </button>
    <?php
  }

  function submit($url = ''){
    $id = $this->id;
    if($id){
      $id = "&id=$id";
    }
    ?>
      <?php $this->div_open(12, '12 submit_main_div align_right'); ?>
        <?php if($this->act != 'view'){ ?>
          <span onclick="cancel('<?php echo $this->form; ?>')">
            <?php $this->button('reset', 'Cancel', 'btn-default'); ?>
          </span>
          <?php $this->button('submit', 'Submit', 'btn_prop margin_left'); ?>
        <?php } ?>
      <?php $this->div_close(); ?>

      <script>
        form_submit('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $this->act; ?>', '<?php echo $this->form; ?>', '<?php echo $this->id; ?>', '<?php echo $url; ?>', '<?php echo (isset($_POST['form']))? $_POST['form'] : ''; ?>', '<?php echo (isset($_POST['variable']))? $_POST['variable'] : ''; ?>', '<?php echo (isset($_POST['type']))? $_POST['type'] : ''; ?>');
      </script>
    <?php
  }

  // Line Break
  /* ------------------------------------------------------------------------------------------------ */
  function clear($class = ''){
    ?>
      <div class="row <?php echo $class; ?>">
        <div class="col-xs-12"><br></div>
      </div>
    <?php
  }

  function h($size, $caption){
    ?>
      <h<?php echo $size; ?>><?php echo $caption; ?></h<?php echo $size; ?>>
    <?php
  }

  function hr(){
    ?>
      <hr class="hr">
    <?php
  }

  // Element
  /* ------------------------------------------------------------------------------------------------ */
  function div_open($md, $sm){
    ?>
      <div class="col-md-<?php echo $md; ?> col-sm-<?php echo $sm; ?>">
    <?php
  }

  function div_close(){
    ?>
      </div>
    <?php
  }

  function form_open($form){
    $this->form = $form;
    ?>
      <form id="<?php echo $this->form; ?>_form">
        <?php $this->notice($this->form); ?>
        <script>
          $('#<?php echo $this->form; ?>_form').submit(function(){
            submit = true; upload = false;
          });
        </script>
        <?php if($this->act){ ?>
          <input type="hidden" value="<?php echo $this->act; ?>" name="proc">
          <input type="hidden" value="<?php echo $this->form; ?>" name="table">
          <input type="hidden" value="<?php echo $this->id; ?>" name="id">
        <?php } ?>
    <?php
  }

  function form_close($focus){
    ?>
      </form>
      <script>
        first(<?php echo $focus; ?>);
      </script>
    <?php
  }

  // Process
  /* ------------------------------------------------------------------------------------------------ */
  function restricted($type){
    $this->msg = '';
    if(!$this->session()){
      $this->msg = 'Please signin.';
      $this->widget('signin');
    } elseif(!$this->userdata['active']){
      $this->msg = 'Account is inactive.';
      $this->widget('signin');
    } elseif($type == 1 && $this->userdata['level'] != 'Admin'){
      $this->msg = '<center class="err">This is a restricted area.';
      echo $this->msg;
    }
    return $this->msg;
  }

  function load(){
    ?>
      <div id="<?php echo $this->table; ?>_load_main_div" class="load_main_div"></div>
      <script>
        load('<?php echo $this->table; ?>', '<?php echo $this->request; ?>');
      </script>
    <?php
  }

  function search($val = ''){
    ?>
      <div id="<?php echo $this->table; ?>_search_main_div" class="row search_main_div">
        <div class="col-md-4 col-sm-6 float_center">
          <div class="input-group">
            <input type="text" value="<?php echo $val; ?>" id="<?php echo $this->table; ?>_search_field" class="form-control input-sm search_field" onkeyup="if(typeof timer != 'undefined'){ clearTimeout(timer); } timer = setTimeout(function(){ search('<?php echo $this->table; ?>', '<?php echo $this->request; ?>'); }, js_timeout)" placeholder="Search . . .">
            <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
          </div>
        </div>
      </div>
    <?php
    $this->clear('visible-xs');
  }

  function limit(){
    ?>
      Show
      <select id="<?php echo $this->table; ?>_limit_field" class="limit_field" onchange="limit('<?php echo $this->table; ?>', '<?php echo $this->request; ?>')">
        <?php foreach($this->limit_arr() as $val){ ?>
          <option <?php if($this->limit == $val){ echo 'selected'; } ?>><?php echo $val; ?></option>
        <?php } ?>
      </select>
      Entries
    <?php
  }

  function active($val, $id){
    ?>
      <td>
        <a class="pointer" onclick="active('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $val; ?>', '<?php echo $id; ?>'); return false">
          <?php if($val){ ?>
            <i class="glyphicon glyphicon-ok ok"></i>
          <?php } else { ?>
            <i class="glyphicon glyphicon-remove err"></i>
          <?php } ?>
        </a>
      </td>
    <?php
  }

  function action($val, $id){
    ?>
      <td>
        <?php $this->view_record($this->table, $this->request, $id, 1); ?>&nbsp;
        <?php $this->update_record($this->table, $this->request, $id, 1); ?>
        <?php $this->delete_record($this->table, $this->request, $val, $id, 1); ?>
      </td>
    <?php
  }

  function del_box(){
    ?>
      <div class="modal fade bs-example-modal-md del_box_main_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">WhOops!</h4>
            </div>
            <div class="modal-body">
              Are you sure you want to delete : <span class="del_box_val"></span> ?
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
              <button class="btn btn-sm btn_prop del_box_confirm" data-dismiss="modal">Confirm</button>
            </div>
          </div>
        </div>
      </div>
    <?php
  }

  function pager(){
    $back = $this->paging['back'];
    $next = $this->paging['next'];
    $pages = $this->paging['pages'];
    if($pages > 1){
      ?>
        <div class="col-xs-12 align_center">
          <div class="btn-group">
            <?php if($next > 1){ ?>
              <a class="btn btn-sm btn_prop" onclick="back_next('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '0'); return false">First</a>
              <a class="btn btn-sm btn_prop" onclick="back_next('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $back; ?>'); return false">Back</a>
            <?php } else { ?>
              <a class="btn btn-sm btn_prop disable arrow">First</a>
              <a class="btn btn-sm btn_prop disable arrow">Back</a>
            <?php } ?>

            <a class="btn btn-sm btn-default arrow">
              Page :
              <input type="text" value="<?php echo $next; ?>" id="<?php echo $this->table; ?>_go_to_field" class="go_to_field" onkeydown="if(event.keyCode == 13){ go_to('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $pages; ?>'); }" autocomplete="off">
              of <?php echo $pages; ?>
            </a>

            <?php if($next < $pages){ ?>
              <a class="btn btn-sm btn_prop" onclick="back_next('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $next; ?>'); return false">Next</a>
              <a class="btn btn-sm btn_prop" onclick="back_next('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $pages - 1; ?>'); return false">Last</a>
            <?php } else { ?>
              <a class="btn btn-sm btn_prop disable arrow">Next</a>
              <a class="btn btn-sm btn_prop disable arrow">Last</a>
            <?php } ?>

            <a class="btn btn-sm btn_prop" onclick="go_to('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $pages; ?>'); return false">Go</a>
          </div>
        </div>
      <?php
    }
    echo "
      <script>
        if(hash[0] == '$this->table'){
          trigger('$this->request');
        }
      </script>
    ";
    $this->clear();
  }

  function inject($widget){
    $path = str_replace('index.php', '', $widget);
    $full = $path.'plug/theme/theme';
    $url = $this->url($full);
    if(file_exists($full.'.js')){ ?><script> inject('<?php echo $url.'.js'; ?>'); </script><?php }
    if(file_exists($full.'.css')){ ?><script> inject('<?php echo $url.'.css'; ?>'); </script><?php }
  }
}
?>