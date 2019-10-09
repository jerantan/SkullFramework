<script>
	var js_alphanumeric = '<?php echo alphanumeric; ?>';
	var js_domain = '<?php echo domain; ?>';
	var js_symbol = '<?php echo symbol; ?>';
	var js_notice_fine = '<?php $this->notice_fine(fine); ?>';
	var js_notice_ok = '<?php $this->notice_ok("Success."); ?>';
	var js_delay = '<?php echo delay; ?>';
	var js_fadeout = '<?php echo fadeout; ?>';
	var js_timeout = '<?php echo timeout; ?>';
	var js_offset = '<?php echo offset; ?>';
	var js_scroll = '<?php echo scroll; ?>';
	var js_image = '<?php echo image; ?>';
	var js_audio = '<?php echo audio; ?>';
	var js_video = '<?php echo video; ?>';

	// Upload Obj
	upload_obj = {};
</script>

<?php if($this->userdata['active']){ ?>
<script>
	function signout(){
		$.ajax({
			url: js_domain,
			type: 'post',
			data: {
				proc: 'signout'
			},
			success: function(){
				location.reload();
			}
		});
	}

	(function idleSignout(){
		var t;
		window.onload = resetTimer;
		window.onmousemove = resetTimer;
		window.onmousedown = resetTimer; // catches touchscreen presses
		window.onclick = resetTimer;     // catches touchpad clicks
		window.onscroll = resetTimer;    // catches scrolling with arrow keys
		window.onkeypress = resetTimer;

		function resetTimer() {
			clearTimeout(t);
			t = setTimeout(signout, 60000 * 30);  // time is in milliseconds
		}
	})();
</script>
<?php } ?>

<style>
	html, body{ background: <?php echo html; ?>; }
	.notice_prop{ background: <?php echo html; ?>; }
	.content_main_div .dropdown-menu{ background-color: <?php echo font; ?>; }
	.content_main_div .dropdown-menu > li > a{ color: <?php echo main; ?>; }
	.content_main_div .dropdown-menu > li > a:hover,
	.content_main_div .dropdown-menu > li > a:focus{ color: <?php echo hove; ?>; background: <?php echo main; ?>; }
	.form_main_back_div{ background: <?php echo (opac != 1)? 'black' : main; ?>; opacity: <?php echo opac; ?>; }
	.form_back_div{ background: <?php echo (opac != 1)? 'transparent' : font; ?>; }
	.form_load_div .dropdown-menu{ background-color: <?php echo font; ?>; }
	.form_load_div .dropdown-menu > li > a{ color: <?php echo main; ?>; }	
	.form_load_div .dropdown-menu > li > a:hover,
	.form_load_div .dropdown-menu > li > a:focus{ color: <?php echo hove; ?>; background: <?php echo main; ?>; }
	.form1_main_back_div{ background: <?php echo (opac != 1)? 'black' : main; ?>; opacity: <?php echo opac; ?>; }
	.form1_back_div{ background: <?php echo (opac != 1)? 'transparent' : font; ?>; }
	.form2_main_back_div{ background: <?php echo (opac != 1)? 'black' : main; ?>; opacity: <?php echo opac; ?>; }
	.form2_back_div{ background: <?php echo (opac != 1)? 'transparent' : font; ?>; }
	.form3_main_back_div{ background: <?php echo (opac != 1)? 'black' : main; ?>; opacity: <?php echo opac; ?>; }
	.form3_back_div{ background: <?php echo (opac != 1)? 'transparent' : font; ?>; }
	.table-striped > tbody > .active > th,
	.table-striped > tbody > tr > .active,
	.table-striped > tbody > .active > td{ color: <?php echo font; ?>; background-color: <?php echo main; ?> !important; }
	a{ color: <?php echo main; ?>; }
	a:hover,
	a:focus{ color: <?php echo main; ?>; }
	.btn_prop{ color: <?php echo font; ?>; border-color: <?php echo main; ?>; background-color: <?php echo main; ?>; }
	.btn_prop:hover,
	.btn_prop:focus{ color: <?php echo hove; ?>; border-color: <?php echo main; ?>; background-color: <?php echo main; ?>; }
	.disable:hover,
	.disable:focus{ color: <?php echo font; ?>; border-color: <?php echo main; ?>; background-color: <?php echo main; ?>; }
	.input-group-addon,
	.input-group-addon:hover,
	.input-group-addon:focus{ color: <?php echo font; ?>; border-color: <?php echo main; ?>; background-color: <?php echo main; ?>; }
	.hover:hover,
	.hover:focus{ color: <?php echo hove; ?>; }
	.rest{ color: <?php echo font; ?>; }
	.rest:hover,
	.rest:focus{ color: <?php echo hove; ?>; }
	.shadow{ box-shadow: 3px 0px 10px 0px <?php echo main; ?>; }
</style>