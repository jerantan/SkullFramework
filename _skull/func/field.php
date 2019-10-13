<?php
class field extends html{
  // Default
  /* ------------------------------------------------------------------------------------------------ */
  function field_frame_open($label, $type = ''){
    ?>
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <?php if($type){ ?>
            <span class="err">*</span>
          <?php } ?>
          <?php echo $this->label($label); ?> :
        </div>
        <div class="col-md-12 col-sm-12">
    <?php
  }

  function field_frame_close($var){
    ?>
          <div id="<?php echo $var; ?>_err_main_div" class="err err_main_div"></div>
        </div>
      </div>
    <?php
    $this->clear();
    $this->clear();
  }

  function group_frame_open($type = ''){
    if($this->act != 'view' || $type){
    ?>
      <div class="input-group">
    <?php
    }
  }

  function group_frame_close($type = ''){
    if($this->act != 'view' || $type){
    ?>
      </div>
    <?php
    }
  }

  function view_field($var, $val = ''){
    ?>
      <div id="<?php echo $var; ?>_view_field" class="view_field border">
        <?php if($val == ''){ echo '<br>'; } else { echo $val; } ?>
      </div>
    <?php
  }

  function alpha_event_val($event, $var){
    ?>
      <script>
        alpha_event_val('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $event; ?>');
      </script>
    <?php
  }

  function alpha_submit_val($var){
    $chosen_class = (isset($this->chosen))? '_chosen input' : '';
    ?>
      <script>
        alpha_submit_val('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $chosen_class; ?>');
      </script>
    <?php
  }

  function alpha_unique_event_val($event, $var, $trim){
    ?>
      <script>
        alpha_unique_event_val('<?php echo $this->form; ?>', '<?php echo $this->request; ?>', '<?php echo $this->id; ?>', '<?php echo $var; ?>', '<?php echo $event; ?>', '<?php echo $trim; ?>');
      </script>
    <?php
  }

  function alpha_unique_submit_val($var, $trim){
    ?>
      <script>
        alpha_unique_submit_val('<?php echo $this->form; ?>', '<?php echo $this->request; ?>', '<?php echo $this->id; ?>', '<?php echo $var; ?>', '<?php echo $trim; ?>');
      </script>
    <?php
  }

  function numeric_val($type, $var){
    ?>
      <script>
        numeric_val('<?php echo $type; ?>', '<?php echo $this->form; ?>', '<?php echo $var; ?>');
      </script>
    <?php
  }

  function numeric_event_val($event, $var){
    ?>
      <script>
        numeric_event_val('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $event; ?>');
      </script>
    <?php
  }

  function numeric_submit_val($var){
    ?>
      <script>
        numeric_submit_val('<?php echo $this->form; ?>', '<?php echo $var; ?>');
      </script>
    <?php
  }

  function numeric_unique_event_val($event, $var, $trim){
    ?>
      <script>
        numeric_unique_event_val('<?php echo $this->form; ?>', '<?php echo $this->request; ?>', '<?php echo $this->id; ?>', '<?php echo $var; ?>', '<?php echo $event; ?>', '<?php echo $trim; ?>');
      </script>
    <?php
  }

  function numeric_unique_submit_val($var, $trim){
    ?>
      <script>
        numeric_unique_submit_val('<?php echo $this->form; ?>', '<?php echo $this->request; ?>', '<?php echo $this->id; ?>', '<?php echo $var; ?>', '<?php echo $trim; ?>');
      </script>
    <?php
  }

  // Text
  /* ------------------------------------------------------------------------------------------------ */
  function text_field($var, $val){
    if($this->act != 'view'){
    ?>
      <input type="text" value="<?php echo $val; ?>" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field" autocomplete="off">
    <?php
    } else {
      $this->view_field($var, $val);
    }
  }

  /* Usage : text('Name', $result['name']); or text('Another : Name', $result['another_name']); */
  function text($label, $val){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->text_field($var, $val);
    $this->field_frame_close($var);
  }

  /* Usage : text_required('Name', $result['name']); or text_required('Another : Name', $result['another_name']); */
  function text_required($label, $val){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->text_field($var, $val);
      // Validation
      $this->alpha_event_val('keyup', $var);
      $this->alpha_submit_val($var);
    $this->field_frame_close($var);
  }

  /* Usage : text_unique('Username', $result['username']); or text_unique('Another : Username', $result['another_username']); */
  function text_unique($label, $val){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $trim = $this->trim($var);
      $this->text_field($var, $val);
      // Validation
      $this->alpha_unique_event_val('keyup', $var, $trim);
      $this->alpha_unique_event_val('change', $var, $trim);
      $this->alpha_unique_submit_val($var, $trim);
    $this->field_frame_close($var);
  }

  // Textarea
  /* ------------------------------------------------------------------------------------------------ */
  function textarea_field($var, $val){
    if($this->act != 'view'){
    ?>
      <textarea name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field"><?php echo $val; ?></textarea>
    <?php
    } else {
      $this->view_field($var, $val);
    }
  }

  /* Usage : textarea('Description', $result['des']); or text('Another : Description', $result['another_des']); */
  function textarea($label, $val){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->textarea_field($var, $val);
    $this->field_frame_close($var);
  }

  /* Usage : textarea_required('Description', $result['des']); or text_required('Another : Description', $result['another_des']); */
  function textarea_required($label, $val){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->textarea_field($var, $val);
      // Validation
      $this->alpha_event_val('keyup', $var);
      $this->alpha_submit_val($var);
    $this->field_frame_close($var);
  }

  // Dropdown
  /* ------------------------------------------------------------------------------------------------ */
  function dropdown_field($var, $arr_val, $arr_opt, $sel){
    if($this->act != 'view'){
    ?>
      <select name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field">
        <?php $this->select_option($arr_val, $arr_opt, $sel); ?>
      </select>
    <?php
    } else {
      $opt = '';
      foreach($arr_val as $index => $val){
        if($sel == $val){
          $opt = $arr_opt[$index];
        }
      }
      $this->view_field($var, $opt);
    }
  }

  function select_option($arr_val, $arr_opt, $sel){
    ?>
      <option value=""></option>
      <?php foreach($arr_val as $index => $val){ ?>
        <option value="<?php echo $val; ?>" <?php if($sel == $val && $arr_opt[$index]){ echo 'selected'; } ?>><?php echo $arr_opt[$index]; ?></option>
      <?php } ?>
    <?php
  }

  /* Usage : dropdown('Active', array('1', '0'), array('Yes', 'No'), $result['active']); or dropdown('Another : Active', array('1', '0'), array('Yes', 'No'), $result['another_active']); */
  function dropdown($label, $arr_val, $arr_opt, $sel){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->dropdown_field($var, $arr_val, $arr_opt, $sel);
    $this->field_frame_close($var);
  }

  /* Usage : dropdown_required('Active', array('1', '0'), array('Yes', 'No'), $result['active']); or dropdown_required('Another : Active', array('1', '0'), array('Yes', 'No'), $result['another_active']); */
  function dropdown_required($label, $arr_val, $arr_opt, $sel){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->dropdown_field($var, $arr_val, $arr_opt, $sel);
      // Validation
      $this->alpha_event_val('change', $var);
      $this->alpha_submit_val($var);
    $this->field_frame_close($var);
  }

  // Chosen
  /* ------------------------------------------------------------------------------------------------ */
  function chosen_load($var, $sel, $type = ''){
    ?>
      <script>
        if(typeof chosen_plugged == 'undefined'){
          chosen_plugged = true;
          inject('<?php $this->plug('chosen/chosen.jquery.min.js'); ?>');
          inject('<?php $this->plug('chosen/bootstrap-chosen.css'); ?>');
        }
      </script>
      <span id="<?php echo $var; ?>_chosen_load_span"></span>
      <script>
        setTimeout(function(){
          chosen_load('<?php echo $this->trim($var); ?>', '<?php echo $this->request; ?>', '<?php echo $this->act; ?>', '<?php echo $sel; ?>', '<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $type; ?>');
        }, js_timeout);
      </script>
    <?php
  }

  function chosen_field($var, $arr_val, $arr_opt, $sel){
    if($this->act != 'view'){
    ?>
      <select name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm chosen-select-deselect input_field" data-placeholder="&nbsp;">
        <?php $this->select_option($arr_val, $arr_opt, $sel); ?>
      </select>

      <script>
        $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').chosen({ allow_single_deselect: true });
      </script>

      <?php
      if($_POST['type']){
        $this->alpha_event_val('change', $var);
      }
      ?>
    <?php
    } else {
      $opt = '';
      foreach($arr_val as $index => $val){
        if($sel == $val){
          $opt = $arr_opt[$index];
        }
      }
      $this->view_field($var, $opt);
    }
  }

  function chosen_addon($var, $type = ''){
    if($this->act != 'view'){
    ?>
      <a id="<?php echo $var; ?>_addon_main_link" class="input-group-addon addon_main_link pointer" onclick="form_select('<?php echo $this->trim($var); ?>', '<?php echo $this->request; ?>', 'insert', '<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $type; ?>'); return false">
        <i class="glyphicon glyphicon-plus-sign"></i>
      </a>
    <?php
    }
  }

  /* Usage : chosen('Customer', $result['id']); or chosen('Another : Customer', $result['another_id']); */
  function chosen($label, $sel = ''){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->group_frame_open();
        $this->chosen_load($var, $sel);
        $this->chosen_addon($var);
      $this->group_frame_close();
    $this->field_frame_close($var);
  }

  /* Usage : chosen_required('Customer', $result['id']); or chosen_required('Another : Customer', $result['another_id']); */
  function chosen_required($label, $sel = ''){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->group_frame_open();
        $this->chosen_load($var, $sel, 1);
        $this->chosen_addon($var, 1);
      $this->group_frame_close();
      // Validation
      $this->chosen = 1;
        $this->alpha_submit_val($var);
      unset($this->chosen);
    $this->field_frame_close($var);
  }

  // Number
  /* ------------------------------------------------------------------------------------------------ */
  function number_field($var, $val){
    if($this->act != 'view'){
    ?>
      <input type="number" min="0" value="<?php echo $val; ?>" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field" autocomplete="off">
    <?php
    } else {
      $this->view_field($var, $val);
    }
  }

  /* Usage : number('Quantity', $result['quantity']); or number('Another : Quantity', $result['another_quantity']); */
  function number($label, $val){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->number_field($var, $val);
      // Validation
      $this->numeric_val('number', $var);
    $this->field_frame_close($var);
  }

  /* Usage : number_required('Quantity', $result['quantity']); or number_required('Another : Quantity', $result['another_quantity']); */
  function number_required($label, $val){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->number_field($var, $val);
      // Validation
      $this->numeric_val('number', $var);
      $this->numeric_event_val('keyup', $var);
      $this->numeric_event_val('change', $var);
      $this->numeric_submit_val($var);
    $this->field_frame_close($var);
  }

  /* Usage : number_unique('Quantity', $result['quantity']); or number_unique('Another : Quantity', $result['another_quantity']); */
  function number_unique($label, $val){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $trim = $this->trim($var);
      $this->number_field($var, $val);
      // Validation
      $this->numeric_val('number', $var);
      $this->numeric_unique_event_val('keyup', $var, $trim);
      $this->numeric_unique_event_val('change', $var, $trim);
      $this->numeric_unique_submit_val($var, $trim);
    $this->field_frame_close($var);
  }

  // Measure
  /* ------------------------------------------------------------------------------------------------ */
  function measure_field($var, $val){
    if($this->act != 'view'){
    ?>
      <input type="text" value="<?php echo $val; ?>" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field" autocomplete="off">
      <span id="<?php echo $var; ?>_measure_field_span" class="measure_field_span">
        <span class="triup_span" onclick="triup('<?php echo $this->form; ?>', '<?php echo $var; ?>')">
          <b class="triup"></b>
        </span>
        <span class="tridown_span" onclick="tridown('<?php echo $this->form; ?>', '<?php echo $var; ?>')">
          <b class="tridown"></b>
        </span>
      </span>
    <?php
    } else {
      $this->view_field($var, $val);
    }
  }

  /* Usage : measure('Quantity', $result['quantity']); or measure('Another : Quantity', $result['another_quantity']); */
  function measure($label, $val){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->measure_field($var, $val);
      // Validation
      $this->numeric_val('measure', $var);
    $this->field_frame_close($var);
  }

  /* Usage : measure_required('Quantity', $result['quantity']); or measure_required('Another : Quantity', $result['another_quantity']); */
  function measure_required($label, $val){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->measure_field($var, $val);
      // Validation
      $this->numeric_val('measure', $var);
      $this->numeric_event_val('keyup', $var);
      $this->numeric_event_val('change', $var);
      $this->numeric_submit_val($var);
    $this->field_frame_close($var);
  }

  // Amount
  /* ------------------------------------------------------------------------------------------------ */
  /* Usage : amount('Price', $result['price']); or amount('Another : Price', $result['another_price']); */
  function amount($label, $val){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->text_field($var, $val);
      // Validation
      $this->numeric_val('amount', $var);
    $this->field_frame_close($var);
  }

  /* Usage : amount_required('Price', $result['price']); or amount_required('Another : Price', $result['another_price']); */
  function amount_required($label, $val){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->text_field($var, $val);
      // Validation
      $this->numeric_val('amount', $var);
      $this->numeric_event_val('keyup', $var);
      $this->numeric_event_val('change', $var);
      $this->numeric_submit_val($var);
    $this->field_frame_close($var);
  }

  // Percent
  /* ------------------------------------------------------------------------------------------------ */
  /* Usage : percent('Disc', $result['disc']); or percent('Another : Disc', $result['another_disc']); */
  function percent($label, $val){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->text_field($var, $val);
      // Validation
      $this->numeric_val('percent', $var);
    $this->field_frame_close($var);
  }

  /* Usage : percent_required('Disc', $result['disc']); or percent_required('Another : Disc', $result['another_disc']); */
  function percent_required($label, $val){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->text_field($var, $val);
      // Validation
      $this->numeric_val('percent', $var);
      $this->numeric_event_val('keyup', $var);
      $this->numeric_event_val('change', $var);
      $this->numeric_submit_val($var);
    $this->field_frame_close($var);
  }

  // Date
  /* ------------------------------------------------------------------------------------------------ */
  function date_addon($var){
    if($this->act != 'view'){
    ?>
      <a id="<?php echo $var; ?>_addon_main_link" class="input-group-addon addon_main_link pointer" onclick="return false"><i class="glyphicon glyphicon-calendar"></i></a>
    <?php
    }
  }

  function date_picker($var, $min, $max, $format, $month, $year){
    ?>
      <script>
        if(typeof datepicker_plugged == 'undefined'){
          datepicker_plugged = true;
          inject('<?php $this->plug('datepicker/bootstrap-datepicker.min.js'); ?>');
          inject('<?php $this->plug('datepicker/bootstrap-datepicker.min.css'); ?>');
        }
        date_picker('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $min; ?>', '<?php echo $max; ?>', '<?php echo $format; ?>', '<?php echo $month; ?>', '<?php echo $year; ?>');
      </script>
    <?php
  }

  /*
  Usage :
  date('Birthday', $result['bday'], 2015, 2016, js_numeric, 1, 1); or date('Another : Birthday', $result['bday'], 2015, 2016, js_numeric, 1, 1);
  2015 or 12/18/2015 - Min date to display in the picker.
  2016 or 12/18/2016 - Max date to display in the picker.
  js_numeric or js_alpha - Date format setting, these are defined in cons.php.
  1 - You can not select month, it will be fixed whatever the month at the moment.
  1 - You can not select year, it will be fixed whatever the year at the moment.
  */
  function date($label, $val, $min, $max, $format, $month = '', $year = ''){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->group_frame_open();
        $this->text_field($var, $val);
        $this->date_addon($var);
      $this->group_frame_close();
      $this->date_picker($var, $min, $max, $format, $month, $year);
    $this->field_frame_close($var);
  }

  /*
  Usage :
  date_required('Birthday', $result['bday'], 2015, 2016, js_numeric, 1, 1); or date_required('Another : Birthday', $result['bday'], 2015, 2016, js_numeric, 1, 1);
  2015 or 12/18/2015 - Min date to display in the picker.
  2016 or 12/18/2016 - Max date to display in the picker.
  js_numeric or js_alpha - Date format setting, these are defined in cons.php.
  1 - You can not select month, it will be fixed whatever the month at the moment.
  1 - You can not select year, it will be fixed whatever the year at the moment.
  */
  function date_required($label, $val, $min, $max, $format, $month = '', $year = ''){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->group_frame_open();
        $this->text_field($var, $val);
        $this->date_addon($var);
      $this->group_frame_close();
      $this->date_picker($var, $min, $max, $format, $month, $year);
      // Validation
      $this->alpha_event_val('keyup', $var);
      $this->alpha_event_val('change', $var);
      $this->alpha_submit_val($var);
    $this->field_frame_close($var);
  }

  // Password
  /* ------------------------------------------------------------------------------------------------ */
  function pass_field($var){
    if($this->act != 'view'){
    ?>
      <input type="password" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field">
    <?php
    } else {
      $this->view_field($var);
    }
  }

  function pass_event_val($var, $type = ''){
    ?>
      <script>
        pass_event_val('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $type; ?>');
      </script>
    <?php
  }

  function pass_submit_val($var, $type = ''){
    ?>
      <script>
        pass_submit_val('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $type; ?>');
      </script>
    <?php
  }

  function con_event_val($var, $type = ''){
    ?>
      <script>
        con_event_val('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $type; ?>');
      </script>
    <?php
  }

  function con_submit_val($var, $type = ''){
    ?>
      <script>
        con_submit_val('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $type; ?>');
      </script>
    <?php
  }

  function password(){
    $label = 'Password';
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->pass_field($var);
      // Validation
      $this->pass_event_val($var);
      $this->pass_submit_val($var);
    $this->field_frame_close($var);

    $label = 'Confirm';
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->pass_field($var);
      // Validation
      $this->con_event_val($var);
      $this->con_submit_val($var);
    $this->field_frame_close($var);
  }

  function password_required(){
    $label = 'Password';
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->pass_field($var);
      // Validation
      $this->pass_event_val($var, 1);
      $this->pass_submit_val($var, 1);
    $this->field_frame_close($var);

    $label = 'Confirm';
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->pass_field($var);
      // Validation
      $this->con_event_val($var, 1);
      $this->con_submit_val($var, 1);
    $this->field_frame_close($var);
  }

  // Upload
  /* ------------------------------------------------------------------------------------------------ */
  function upload_field($var, $multi){
    if($this->act != 'view'){
    ?>
      <?php if(!$multi){ ?>
        <input type="file" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="input_field">
      <?php } else { ?>
        <input type="file" name="<?php echo $var; ?>[]" id="<?php echo $var; ?>_input_field" class="input_field" multiple>
      <?php } ?>
    <?php
    }
    ?>
      <div id="<?php echo $var; ?>_prev" class="row"></div>
        <?php if($this->act != 'insert'){ ?>
        <script>
          var target = <?php echo json_encode(array_reverse(glob($this->path($this->upload_by, $this->table, $this->id).'*.*'))); ?>;
          for(var key in target){
            var _target = target[key];
            var name = _target.substr(_target.lastIndexOf('/') + 1);
            var ext = name.substr(name.lastIndexOf('.') + 1);

            act = '<?php echo $this->act; ?>';
            var remove = "del_box('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '"+name+"', '<?php echo $this->id; ?>', 1)";

            var prev = '';
            if(!prev) prev = preview_image(ext, to_url(_target));
            if(!prev) prev = preview_audio(ext, to_url(_target), name);
            if(!prev) prev = preview_video(ext, to_url(_target));

            var html = upload_preview(prev, ext, name.replace('.', ''), remove);
            $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_prev').append(html);
          }
        </script>
        <?php } ?>
    <?php
  }

  function upload_event_val($event, $var, $multi, $type = ''){
    ?>
      <script>
        upload_event_val('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $this->act; ?>', '<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $event; ?>', '<?php echo $this->upload_type; ?>', '<?php echo $this->upload_by; ?>', '<?php echo $multi; ?>', '<?php echo $type; ?>', '<?php echo $this->id; ?>');
      </script>
    <?php
  }

  function upload_submit_val($var, $type = ''){
    ?>
      <script>
        upload_submit_val('<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $type; ?>');
      </script>
    <?php
  }

  /* Usage :
  upload_type = 'image, audio, video';
  upload_by = 'entry'; // entry, setup, profile
  upload('File'); or upload('Another : File'); // Single select
  upload('File', 1); or upload('Another : File', 1); // Multiple select
  */
  function upload($label, $multi = ''){
    $this->field_frame_open($label);
      $var = $this->variable($label);
      $this->upload_field($var, $multi);
      // Validation
      $this->upload_event_val('change', $var, $multi);
      $this->upload_submit_val($var);
    $this->field_frame_close($var);
  }

  /* Usage :
  upload_type = 'image, audio, video';
  upload_by = 'entry'; // entry, setup, profile
  upload_required('File'); or upload_required('Another : File'); // Single select
  upload_required('File', 1); or upload_required('Another : File', 1); // Multiple select
  */
  function upload_required($label, $multi = ''){
    $this->field_frame_open($label, 1);
      $var = $this->variable($label);
      $this->upload_field($var, $multi);
      // Validation
      $this->upload_event_val('change', $var, $multi, 1);
      $this->upload_submit_val($var, 1);
    $this->field_frame_close($var);
  }
}
?>