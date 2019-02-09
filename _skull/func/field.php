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
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').<?php echo $event; ?>(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()){
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
					} else {
						<?php if(strpos($var, 'email') !== false){ ?>
							if(!email.test($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val())){
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field with an email.');
							} else {
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
							}
						<?php } else { ?>
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
						<?php } ?>
					}
				});
			</script>
		<?php
	}
	
	function alpha_submit_val($var){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form').submit(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()){
						<?php $this->focus($var); ?>
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
					} else {
						<?php if(strpos($var, 'email') !== false){ ?>
							if(!email.test($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val())){
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field with an email.');
								<?php $this->focus($var); ?>
							}
						<?php } ?>
					}
				});	
			</script>
		<?php
	}
	
	function alpha_unique_event_val($event, $var, $trim){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').<?php echo $event; ?>(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()){
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
					} else {
						<?php if($trim == 'username'){ ?>
							if($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() && $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val().length <= 5){
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field with 6 chars or above.');
							} else {
								<?php $this->ajax_unique_val($var, $trim); ?>
							}
						<?php } elseif($trim == 'email'){ ?>
							if(!email.test($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val())){
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field with an email.');
							} else {
								<?php $this->ajax_unique_val($var, $trim); ?>
							}
						<?php } else { $this->ajax_unique_val($var, $trim); } ?>
					}
				});
			</script>	
		<?php
	}
	
	function alpha_unique_submit_val($var, $trim){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form').submit(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()){
						<?php $this->focus($var); ?>
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
					} else {
						<?php if($trim == 'username'){ ?>
							if($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() && $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val().length <= 5){
								<?php $this->focus($var); ?>
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field with 6 chars or above.');
							} else {
								<?php $this->ajax_unique_val($var, $trim, 1); ?>
							}
						<?php } elseif($trim == 'email'){ ?>
							if(!email.test($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val())){
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field with an email.');
								<?php $this->focus($var); ?>
							} else {
								<?php $this->ajax_unique_val($var, $trim, 1); ?>
							}
						<?php } else { $this->ajax_unique_val($var, $trim); } ?>
					}
				});
			</script>
		<?php
	}
	
	function numeric_val($type, $var){
		?>
			<script>
				<?php if($type == 'measure'){ ?>
					$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').attr('style', 'text-align: right; padding-right: 25px');
				<?php } else { ?>
					$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').attr('style', 'text-align: right');
				<?php } ?>

				$('#<?php echo $this->form; ?>_form .input-group .view_field').attr('style', 'text-align: right');
					
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').blur(function(){
					var val = $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val();
					val = val.replace('<?php echo symbol; ?>', '');
					val = val.replace('%', '');
					$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val(format('<?php echo $type; ?>', val));
				});
				
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').keypress(function(e){
					var e = (e) ? e : window.event;
					var key = (e.which) ? e.which : e.keycode;
					
					if
						<?php if($type == 'number'){ ?>
							(key > 31 && (key < 48 || key > 57))
						<?php } ?>
						
						<?php if($type == 'measure' || $type == 'amount' || $type == 'percent'){ ?>
							(key > 31 && (key < 46 || key == 47 || key > 57))
						<?php } ?>
					{
						return false;
					}
				});
			</script>
		<?php
	}
	
	function numeric_event_val($event, $var){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').<?php echo $event; ?>(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() || $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() <= 0){
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
					} else {
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
					}
				});
			</script>
		<?php
	}
	
	function numeric_submit_val($var){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form').submit(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() || $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() <= 0){
						<?php $this->focus($var); ?>
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
					}
				});	
			</script>
		<?php
	}
	
	function numeric_unique_event_val($event, $var, $trim){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').<?php echo $event; ?>(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() || $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() <= 0){
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
					} else {
						<?php $this->ajax_unique_val($var, $trim); ?>
					}
				});
			</script>
		<?php
	}
	
	function numeric_unique_submit_val($var, $trim){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form').submit(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() || $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() <= 0){
						<?php $this->focus($var); ?>
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
					} else {
						<?php $this->ajax_unique_val($var, $trim, 1); ?>
					}
				});	
			</script>
		<?php
	}

	function ajax_unique_val($var, $trim, $type = ''){
		?>
			if(typeof timer != 'undefined'){ clearTimeout(timer); } timer = setTimeout(function(){
				$.ajax({
					url: '<?php echo domain.$this->request; ?>',
					<?php if($type){ ?>async: false,<?php } ?>
					type: 'post',
					data: {
						proc: 'unique',
						table: '<?php echo $this->form; ?>',
						field: '<?php echo $trim; ?>',
						val: encrypt($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()),
						id: '<?php echo $this->id; ?>'
					},
					success: function(response){
						if(response.substr(-1) > 0){
							<?php if($type){ $this->focus($var); } ?>
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field again this <?php echo $this->trim($trim); ?> is already taken.');
						} else {
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
						}
					}
				});
			}, js_timeout);
		<?php
	}

	function focus($var){
		$add = (isset($this->chosen))? '_chosen input' : '';
		?>
			if(submit != false){
				var form_name = form_current();
				if(!form_name){
					$('html').animate({
						scrollTop: $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field<?php echo $add; ?>').offset().top - js_offset
					}, js_scroll, function(){ $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field<?php echo $add; ?>').focus(); });
				} else {
					$('.'+form_name+'_main_div').animate({
						scrollTop: $('.'+form_name+'_main_div').scrollTop() - $('.'+form_name+'_main_div').offset().top + $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field<?php echo $add; ?>').offset().top - js_offset
					}, js_scroll, function(){ $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field<?php echo $add; ?>').focus(); });
				}
			}
			submit = false;
		<?php
	}

	// Text
	/* ------------------------------------------------------------------------------------------------ */
	function text_field($var, $val){
		if($this->act != 'view'){
		?>
			<input type="text" value="<?php echo $val; ?>" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field">
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
				});
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
			<input type="number" min="0" value="<?php echo $val; ?>" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field">
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
	function measure_field($var, $val, $min){
		if($this->act != 'view'){
		?>
			<input type="text" min="<?php echo $min; ?>" value="<?php echo $val; ?>" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field">
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
			$this->measure_field($var, $val, 0);
			// Validation
			$this->numeric_val('measure', $var);
		$this->field_frame_close($var);
	}
	
	/* Usage : measure_required('Quantity', $result['quantity']); or measure_required('Another : Quantity', $result['another_quantity']); */
	function measure_required($label, $val){
		$this->field_frame_open($label, 1);
			$var = $this->variable($label);
			$this->measure_field($var, $val, 1);
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
	function percent_addon($var){
		?>
			<div id="<?php echo $var; ?>_addon_main_div" class="input-group-addon addon_main_div">%</div>
		<?php
	}
	
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
			</script>
			<script>
				setTimeout(function(){
					$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').datepicker({
						<?php if(!$year){ ?>
							changeYear: true,
						<?php } ?>
						
						<?php if(!$month){ ?>
							changeMonth: true,
						<?php } ?>
						
						<?php if($format){ ?>
							dateFormat: '<?php echo $format; ?>',
						<?php } ?>
						
						<?php if($max){ ?>
							maxDate: new Date('<?php echo $max; ?>'),
						<?php } ?>
						
						<?php if($min){ ?>
							minDate: new Date('<?php echo $min; ?>')
						<?php } ?>
					});
				}, js_timeout);
				
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_addon_main_link').click(function(){
					$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').focus();
				});
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
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').keyup(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()){
						<?php if($type){ ?>
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
						<?php } ?>
					} else {
						if($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val().length <= 5){
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field with 6 chars or above.');
						} else {
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
						}

						if(($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() || $('#<?php echo $this->form; ?>_form #confirm_input_field').val()) && $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() != $('#<?php echo $this->form; ?>_form #confirm_input_field').val()){
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').css('border-color', 'red');
							$('#<?php echo $this->form; ?>_form #confirm_input_field').css('border-color', 'red');
						} else {
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').css('border-color', '');
							$('#<?php echo $this->form; ?>_form #confirm_input_field').css('border-color', '');
						}
					}
				});
			</script>
		<?php
	}
	
	function pass_submit_val($var, $type = ''){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form').submit(function(){
					if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()){
						<?php if($type){ ?>
							<?php $this->focus($var); ?>
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
						<?php } ?>
					} else {
						if($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val().length <= 5){
							<?php $this->focus($var); ?>
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field with 6 chars or above.');
						} else {
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
						}
					}
				});
			</script>
		<?php
	}
	
	function con_event_val($var, $type = ''){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').keyup(function(){
					// Executed if the statement is true
					/* ================================================================================================ */
					<?php if($type){ ?>
						if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()){
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
						} else {
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
					<?php } ?>
					/* ================================================================================================ */
					
							if(($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() || $('#<?php echo $this->form; ?>_form #password_input_field').val()) && $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() != $('#<?php echo $this->form; ?>_form #password_input_field').val()){
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').css('border-color', 'red');
								$('#<?php echo $this->form; ?>_form #password_input_field').css('border-color', 'red');
							} else {
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').css('border-color', '');
								$('#<?php echo $this->form; ?>_form #password_input_field').css('border-color', '');
							}
					
					// Executed if the statement is true
					/* ================================================================================================ */
					<?php if($type){ ?>
						}
					<?php } ?>
					/* ================================================================================================ */
				});
			</script>
		<?php
	}
	
	function con_submit_val($var, $type = ''){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form').submit(function(){
					// Executed if the statement is true
					/* ================================================================================================ */
					<?php if($type){ ?>
						if(!$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()){
							<?php $this->focus($var); ?>
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
						} else {
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
					<?php } ?>
					/* ================================================================================================ */

							if(($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() || $('#<?php echo $this->form; ?>_form #password_input_field').val()) && $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val() != $('#<?php echo $this->form; ?>_form #password_input_field').val()){
								<?php $this->focus($var); ?>

								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').css('border-color', 'red');
								$('#<?php echo $this->form; ?>_form #password_input_field').css('border-color', 'red');
							} else {
								$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').css('border-color', '');
								$('#<?php echo $this->form; ?>_form #password_input_field').css('border-color', '');
							}
					
					// Executed if the statement is true
					/* ================================================================================================ */	
					<?php if($type){ ?>		
						}
					<?php } ?>
					/* ================================================================================================ */
				});
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
			<div id="<?php echo $var; ?>_prev" class="row">
				<?php
					if($this->act != 'insert'){
						foreach(array_reverse(glob($this->path($this->upload_by, $this->table, $this->id).'*.*')) as $target){
							$filename = end(explode('/', $target));
							$extension = end(explode('.', $filename));
							$del_box = "del_box('$this->table', '$this->request', '$filename', '$this->id', 1)";
							$del_span = '';

							$list_arr = explode(', ', image);
							if(in_array($extension, $list_arr)){
								$preview = '<div style="width: 100%; height: 150px; background: url('.$this->url($target).') no-repeat center; background-size: 100%"></div>';
							}

							$list_arr = explode(', ', audio);
							if(in_array($extension, $list_arr)){
								$preview = '<div style="height: 150px; overflow: hidden; word-wrap: break-word">';
								$preview .= '<audio controls>';
								$preview .= '<source src="'.$this->url($target).'">';
								$preview .= '</audio>';
								$preview .= $filename;
								$preview .= '</div>';
							}

							$list_arr = explode(', ', video);
							if(in_array($extension, $list_arr)){
								$preview = '<div style="height: 150px">';
								$preview .= '<video controls>';
								$preview .= '<source src="'.$this->url($target).'">';
								$preview .= '</video>';
								$preview .= '</div>';
							}

							if($this->act != 'view'){
								$del_span = '<span class="remove" onclick="'.$del_box.'">Delete</span>';
							}

							echo '
								<div id="'.$this->variable($filename).'" class="col-md-2">
									<br>
									<div class="col-md-12 shadow" style="padding-top: 15px; padding-bottom: 15px">
										'.$preview.'
										'.$del_span.'
									</div>
								</div>
								';
						}
					}
				?>
			</div>
		<?php
	}

	function upload_event_val($event, $var, $multi, $type = ''){
		?>
			<script>
				if(typeof upload_obj['<?php echo $this->form; ?>'] == 'undefined'){
					upload_obj['<?php echo $this->form; ?>'] = {};
				}
				upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'] = {};
				upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_arr = [];
				upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_count = 0;
				upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_type_arr = '<?php echo $this->upload_type; ?>'.split(', ');
				upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_list = '';
				upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_by = '<?php echo $this->upload_by; ?>';
				upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].uip_count = 0; // This is upload-in-progress initial count
				
				$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').<?php echo $event; ?>(function(event){
					var file = event.target.files;
					for(var count = upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_count; count < file.length + upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_count; count++){
						var filename = file[count - upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_count].name;
						var extension = filename.substr(filename.lastIndexOf('.') + 1);
						
						upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_arr[count] = file[count - upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_count];
						var tmppath = URL.createObjectURL(file[count - upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_count]);
						
						<?php if(!$multi){ ?>
							file_remove('<?php echo $this->form; ?>', '<?php echo $var; ?>', count - 1, '<?php echo $type; ?>');
						<?php } ?>

						var html; var list; var list_arr; var preview;

						html  = '<div id="<?php echo $var; ?>_prev_'+count+'" class="col-md-2">';
						html += '<br>';
						html += '<div class="col-md-12 shadow" style="padding-top: 15px; padding-bottom: 15px">';
						
						if($.inArray('image', upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_type_arr) >= 0){
							list = '<?php echo image; ?>';
							list_arr = list.split(', ');
							upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_list += list+', ';
							
							if($.inArray(extension, list_arr) >= 0){
								preview = '<div style="width: 100%; height: 150px; background: url('+tmppath+') no-repeat center; background-size: 100%"></div>';
							}
						}
						
						if($.inArray('audio', upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_type_arr) >= 0){
							list = '<?php echo audio; ?>';
							list_arr = list.split(', ');
							upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_list += list+', ';
							
							if($.inArray(extension, list_arr) >= 0){
								preview = '<div style="height: 150px; overflow: hidden; word-wrap: break-word">';
								preview += '<audio controls>';
								preview += '<source src="'+tmppath+'">';
								preview += '</audio>';
								preview += filename;
								preview += '</div>';
							}
						}
						
						if($.inArray('video', upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_type_arr) >= 0){
							list = '<?php echo video; ?>';
							list_arr = list.split(', ');
							upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_list += list;
							
							if($.inArray(extension, list_arr) >= 0){
								preview = '<div style="height: 150px">';
								preview += '<video controls>';
								preview += '<source src="'+tmppath+'">';
								preview += '</video>';
								preview += '</div>';
							}
						}

						var upload_list_arr = upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].upload_list.split(', ');
						if($.inArray(extension, upload_list_arr) < 0){
							html += '<div class="err" style="width: 100%; height: 150px">WhOops! ".'+extension+'" is not allowed. This will be auto removed.</div>';
							html += '<br>';
						} else {
							var html_single_upload; var html_file_remove;

							html += preview;
							<?php if($this->act == 'update'){ ?>
								act = '<?php echo $this->act; ?>';
								html_single_upload = "single_upload('<?php echo $this->table; ?>', '<?php echo $this->request; ?>', '<?php echo $this->form; ?>', '<?php echo $var; ?>', '<?php echo $this->id; ?>', "+count+", '<?php echo $this->upload_by; ?>')";
								html += '<span class="upload" onclick="'+html_single_upload+'">Upload</span>';
							<?php } ?>
							html_file_remove = "file_remove('<?php echo $this->form; ?>', '<?php echo $var; ?>', "+count+", '<?php echo $type; ?>')";
							html += '<span class="remove" onclick="'+html_file_remove+'">Remove</span>';
							html += '<div class="col-xs-12 upload_item_main_div">';
							html += '<div class="progress" style="display: none"><div class="progress-bar progress-bar-striped active"></div></div>';
							html += '<button class="btn btn-danger btn-sm btn-block cancel" onclick="return false" style="display: none">Cancel</button>';
							html += '</div>';
						}
						
						html += '</div>';
						html += '</div>';
						$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_prev').prepend(html);

						if($.inArray(extension, upload_list_arr) < 0){
							file_remove('<?php echo $this->form; ?>', '<?php echo $var; ?>', count, '<?php echo $type; ?>', 1);
						}
					}
					
					$(this).val('');
					upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_count = count;
					form_height_load();
					$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('');
				});
			</script>
		<?php
	}
	
	function upload_submit_val($var, $type = ''){
		?>
			<script>
				$('#<?php echo $this->form; ?>_form').submit(function(){
					if(!upload_obj['<?php echo $this->form; ?>']['<?php echo $var; ?>'].file_arr.filter(string).length){
						<?php if($type){ ?>
							<?php $this->focus($var); ?>
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').html('Please fill out this field.');
							$('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_err_main_div').css('top', '22px');
						<?php } ?>
					} else {
						upload = true;
					}
				});	
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