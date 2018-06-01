<script>
	$('#<?php echo $this->form; ?>_form').submit(function(){
		if(submit == true){
			$('#<?php echo $this->form; ?>_notice_main_div').html('<?php $this->notice_fine(fine); ?>').delay().fadeIn();
			setTimeout(function(){
				$.ajax({
					url: '<?php echo domain.$table; ?>',
					type: 'post',
					data: {
						proc: 'signin',
						table: '<?php echo $table; ?>',
						field: '<?php echo $var; ?>',
						val: $('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val(),
						pass: $('#<?php echo $this->form; ?>_form #password_input_field').val()
					},
					success: function(response){
						switch(response.trim()){
							case '-':
								$('#<?php echo $this->form; ?>_notice_main_div').html('<?php $this->notice_err("Either $var or password is incorrect."); ?>').delay(<?php echo delay; ?>).fadeOut(<?php echo fadeout; ?>);
							break;
							case '0':
								$('#<?php echo $this->form; ?>_notice_main_div').html('<?php $this->notice_err('Account is inactive.'); ?>').delay(<?php echo delay; ?>).fadeOut(<?php echo fadeout; ?>);
							break;
							case '1':
								$('#<?php echo $this->form; ?>_notice_main_div').html('<?php $this->notice_ok('Success.'); ?>').delay(<?php echo delay; ?>).fadeOut(<?php echo fadeout; ?>);
								setTimeout(function(){
									location.reload();
								}, <?php echo timeout; ?>);
							break;
						}
					}
				});
			}, <?php echo timeout; ?>);
		}
		return false;
	});
</script>