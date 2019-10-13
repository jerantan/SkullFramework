<script>
  $('#<?php echo $this->form; ?>_form').submit(function(){
    if(submit == true){
      $('#<?php echo $this->form; ?>_notice_main_div').html(js_notice_fine).delay().fadeIn();
      setTimeout(function(){
        $.ajax({
          url: js_domain+'<?php echo $table; ?>',
          type: 'post',
          data: {
            proc: 'signin',
            table: '<?php echo $table; ?>',
            field: '<?php echo $var; ?>',
            val: encrypt($('#<?php echo $this->form; ?>_form #<?php echo $var; ?>_input_field').val()),
            pass: encrypt($('#<?php echo $this->form; ?>_form #password_input_field').val())
          },
          success: function(response){
            switch(response.trim()){
              case '-':
                $('#<?php echo $this->form; ?>_notice_main_div').html('<?php $this->notice_err("Either $var or password is incorrect."); ?>').delay(js_delay).fadeOut(js_fadeout);
              break;
              case '0':
                $('#<?php echo $this->form; ?>_notice_main_div').html('<?php $this->notice_err('Account is inactive.'); ?>').delay(js_delay).fadeOut(js_fadeout);
              break;
              case '1':
                $('#<?php echo $this->form; ?>_notice_main_div').html(js_notice_ok).delay(js_delay).fadeOut(js_fadeout);
                setTimeout(function(){
                  location.reload();
                }, js_timeout);
              break;
            }
          }
        });
      }, js_timeout);
    }
    return false;
  });
</script>