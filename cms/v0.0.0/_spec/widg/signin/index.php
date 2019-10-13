<?php
$label = 'Username'; $table = 'user'; // This is for user table
// $label = 'Email'; $table = 'member'; // This is for member table
$var = $this->variable($label);
?>

<?php $this->content_open(6, '9 signin_main_div', 'Authorized Personnel Only'); ?>
  <?php $this->form_open('signin'); ?>
    <input type="text" name="<?php echo $var; ?>" id="<?php echo $var; ?>_input_field" class="form-control input-sm input_field" placeholder="<?php echo $label; ?>">
    <div id="<?php echo $var; ?>_err_main_div" class="err err_main_div"></div>
    <br>
    <input type="password" name="password" id="password_input_field" class="form-control input-sm input_field" placeholder="Password">
    <div id="password_err_main_div" class="err err_main_div"></div>
    <br>

    <?php $this->div_open(12, '12 signin_submit_div align_right no_pad'); ?>
      <span onclick="cancel('<?php echo $this->form; ?>')">
        <?php $this->button('reset', 'Clear', 'btn-default'); ?>
      </span>
      <?php $this->button('submit', 'Sign in', 'btn_prop margin_left'); ?>
    <?php $this->div_close(); ?>
  <?php $this->form_close(0); ?>
<?php $this->content_close(); ?>

<?php if($this->msg){ ?>
  <script>
    $('#<?php echo $this->form; ?>_notice_main_div').html('<?php $this->notice_err($this->msg); ?>').delay().fadeIn().delay(<?php echo delay; ?>).fadeOut(<?php echo fadeout; ?>);
  </script>
<?php } ?>

<?php
// $label Validation
$this->alpha_event_val('keyup', $var);
$this->alpha_submit_val($var);
// Passwrod Validation
$this->alpha_event_val('keyup', 'password');
$this->alpha_submit_val('password');
?>
<?php include 'plug/custom/theme.php'; ?>