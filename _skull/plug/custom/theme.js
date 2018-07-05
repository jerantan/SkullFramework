// Email RegEx
var email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

// Modal Form
/* ------------------------------------------------------------------------------------------------ */
function form_open(table, request, act, id = ''){
	$('.form_main_div').show();
	$('.form_main_div').attr('id', table+'_form_main_div');
	$('.form_main_div').scrollTop(0);
	$('.form_content_div .form_hidden_field').val('form');
	$('.form_content_div .close').attr('onclick', "form_close('"+table+"', '"+request+"')");
	$('.form_content_div .form_close_button').attr('onclick', "form_close('"+table+"', '"+request+"')");
	$('html').attr('style', 'overflow: hidden');
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'fillin',
			table: table,
			act: act,
			id: id
		},
		success: function(response){
			$('.form_title').html(ucfirst(table)+' Form');
			$('.form_load_div').html(response);
			form_height_load();
		}
	});
}

function form_close(table, request){
	$('.form_main_div').hide();
	$('.form_content_div .form_hidden_field').val('');
	$('.form_title').html('');
	$('.form_load_div').html('');
	load(table, request);
	$('html').removeAttr('style');
}

function form1_open(table, request){
	$('.form1_main_div').show();
	$('.form1_main_div').attr('id', table+'_form1_main_div');
	$('.form1_main_div').scrollTop(0);
	$('.form1_content_div .form1_hidden_field').val('form1');
	$('.form1_content_div .close').attr('onclick', "form1_close('"+table+"', '"+request+"')");
	$('.form1_content_div .form1_close_button').attr('onclick', "form1_close('"+table+"', '"+request+"')");
	$('html').attr('style', 'overflow: hidden');
	
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'setting',
			table: table
		},
		success: function(response){
			$('.form1_title').html('Setup');
			$('.form1_load_div').html(response);
			form_height_load();
		}
	});
}

function form1_close(table, request){
	$('.form1_main_div').hide();
	$('.form1_content_div .form1_hidden_field').val('');
	$('.form1_title').html('');
	$('.form1_load_div').html('');
	load(table, request);
	
	if(!form_active('form')){
		$('html').removeAttr('style');
	}
}

function form2_open(table, request, act, form, variable, type, id = ''){
	$('.form2_main_div').show();
	$('.form2_main_div').attr('id', table+'_form2_main_div');
	$('.form2_main_div').scrollTop(0);
	$('.form2_content_div .form2_hidden_field').val('form2');
	$('.form2_content_div .close').attr('onclick', "form2_close('"+table+"')");
	$('.form2_content_div .form2_close_button').attr('onclick', "form2_close('"+table+"')");
	$('html').attr('style', 'overflow: hidden');
	
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'fillin',
			table: table,
			act: act,
			form: form,
			variable: variable,
			type: type,
			id: id
		},
		success: function(response){
			$('.form2_title').html('Instant ('+ucfirst(table)+' Form)');
			$('.form2_load_div').html(response);
			form_height_load();
		}
	});
}

function form2_close(){
	$('.form2_main_div').hide();
	$('.form2_content_div .form2_hidden_field').val('');
	$('.form2_title').html('');
	$('.form2_load_div').html('');
	
	if(!form_active('form')){
		$('html').removeAttr('style');
	}
}

function form3_open(table, request, act, form, variable, type, id = ''){
	$('.form3_main_div').show();
	$('.form3_main_div').attr('id', table+'_form3_main_div');
	$('.form3_main_div').scrollTop(0);
	$('.form3_content_div .form3_hidden_field').val('form3');
	$('.form3_content_div .close').attr('onclick', "form3_close('"+table+"')");
	$('.form3_content_div .form3_close_button').attr('onclick', "form3_close('"+table+"')");
	$('html').attr('style', 'overflow: hidden');
	
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'fillin',
			table: table,
			act: act,
			form: form,
			variable: variable,
			type: type,
			id: id
		},
		success: function(response){
			$('.form3_title').html('Instant ('+ucfirst(table)+' Form)');
			$('.form3_load_div').html(response);
			form_height_load();
		}
	});
}

function form3_close(){
	$('.form3_main_div').hide();
	$('.form3_content_div .form3_hidden_field').val('');
	$('.form3_title').html('');
	$('.form3_load_div').html('');
	
	if(!form_active('form')){
		$('html').removeAttr('style');
	}
}

function form_active(form){
	var arr = $('input[name="form_hidden_field[]"]').map(function(){ return $(this).val(); }).get();
	if($.inArray(form, arr) < 0){
		return 0;
	} else {
		return 1;
	}
}

function form_current(){
	var form = '';
	if(form_active('form')){
		form = 'form';
	}
	if(form_active('form1')){
		form = 'form1';
	}
	if(form_active('form2')){
		form = 'form2';
	}
	if(form_active('form3')){
		form = 'form3';
	}
	return form;
}

function form_select(table, request, act, form, variable, type, id = ''){
	var form_name = form_current();
	if(form_name == 'form'){
		form2_open(table, request, act, form, variable, type, id);
	} else if(form_name == 'form2'){
		form3_open(table, request, act, form, variable, type, id);
	}
}

function form_height(form){
	var div_point = 129; // Form start 114 added 15 for margin.
	var div_height = $('.'+form+'_content_div').height();
	var margin_top = 50;
	var margin_bottom = 20;
	var window_height = $(window).height() - (div_point + margin_bottom);
	
	if(div_height < window_height){
		$('.'+form+'_content_div').removeAttr('style');
		$('.'+form+'_back_div').attr('style', 'top: '+margin_top+'px; bottom: '+margin_bottom+'px');
	} else {
		$('.'+form+'_content_div').attr('style', 'position: absolute; top: 0; right: 0; left: 0');
		$('.'+form+'_back_div').attr('style', 'top: 0; bottom: 0');
	}
}

function form_height_load(){
	var form_name = form_current();
	if(form_name){
		form_height(form_name);
		$('.form_load_div .option').tooltip('show');
	}
}

// Measure
/* ------------------------------------------------------------------------------------------------ */
function string(val){
	return val+'';
}

function triup(form, variable){
	var val = $('#'+form+'_form #'+variable+'_input_field').val();
	val = val * 1 + 1;
	$('#'+form+'_form #'+variable+'_input_field').val(format('measure', string(val)));
	$('#'+form+'_form #'+variable+'_err_main_div').html('');
}

function tridown(form, variable){
	var val = $('#'+form+'_form #'+variable+'_input_field').val();
	var min = $('#'+form+'_form #'+variable+'_input_field').attr('min');
	val = val * 1 - 1;
	if(val >= min){
		$('#'+form+'_form #'+variable+'_input_field').val(format('measure', string(val)));
	}
}

function format(type, val){
	if(type == 'number'){
		if(!val){
			val = 0;
		}
	}
	
	var prefix = ''; var suffix = '';
	if(type == 'measure' || type == 'amount' || type == 'percent'){
		var arr = val.split('.');

		var num = arr[0];
		if(num > 0){
			num = Math.round(num);
		} else {
			num = '0';
		}
		
		var deci = arr[1];
		if(deci < 10){
			deci = deci+'0';
		}
		
		if(deci > 0){
			var dec = deci.substr(0, 2);

			var third = deci.substr(2, 1);
			if(third > 4){
				var dec = Math.round(dec) + 1;
				if(dec < 10){
					dec = '0'+dec;
				}
			}
		} else {
			dec = '00';
		}
		
		val = num+'.'+dec;
		
		switch(type){
			case 'measure':
				if(dec <= 0){
					val = num;
				}
			break;
			case 'amount':
				prefix = js_symbol;
			break;
			case 'percent':
				suffix = '%';
			break;
		}
	}
	return prefix+val+suffix;
}

// Upload
/* ------------------------------------------------------------------------------------------------ */
function file_remove(form, variable, id, type, animate = ''){
	var _upload_obj = upload_obj[form][variable];
	_upload_obj.file_arr[id] = '';
	if(animate){
		$('#'+form+'_form #'+variable+'_prev_'+id).delay(js_delay).fadeOut(js_fadeout);
		setTimeout(function(){
			$('#'+form+'_form #'+variable+'_prev_'+id).remove();
			if(type){
				if(!_upload_obj.file_arr.filter(string).length && !_upload_obj.uip_count){
					$('#'+form+'_form #'+variable+'_err_main_div').html('Please fill out this field.');
					$('#'+form+'_form #'+variable+'_err_main_div').css('top', '22px');
				}
			}
			form_height_load();
		}, 2000);
	} else {
		$('#'+form+'_form #'+variable+'_prev_'+id).remove();
		if(type){
			if(!_upload_obj.file_arr.filter(string).length && !_upload_obj.uip_count){
				$('#'+form+'_form #'+variable+'_err_main_div').html('Please fill out this field.');
				$('#'+form+'_form #'+variable+'_err_main_div').css('top', '22px');
			}
		}
		form_height_load();
	}
}

function single_upload(_table, request, _form, variable, _response_id, id, by){
	url = '';
	table = _table;
	form = _form;
	response_id = _response_id;
	$('#'+form+'_notice_main_div').html(js_notice_fine).delay().fadeIn();
	file_upload(form, request, variable, id, by);
}

function multi_upload(){
	for(var variable in upload_obj[form]){
		var _upload_obj = upload_obj[form][variable];
		var by = _upload_obj.upload_by;
		for(var count = 0; count < _upload_obj.file_arr.length; count++){
			if(_upload_obj.file_arr[count]){
				file_upload(form, request, variable, count, by);
			}
		}
	}
}

function file_upload(form, request, variable, id, by){
	var _upload_obj = upload_obj[form][variable];
	if(!$.isArray(_upload_obj.file_arr[id])){ // This means if the object is not upload-in-progress
		_upload_obj.uip_count++; // This is upload-in-progress add count

		$('#'+form+'_form #'+variable+'_prev_'+id+' .progress-bar').html('0%');
		$('#'+form+'_form #'+variable+'_prev_'+id+' .progress-bar').css('width', '0%');
		
		$('#'+form+'_form #'+variable+'_prev_'+id+' .progress').show();
		$('#'+form+'_form #'+variable+'_prev_'+id+' .cancel').show();
		
		file_form = new FormData();
		file_form.append('proc', 'copy');
		file_form.append('by', by);
		file_form.append('table', table);
		file_form.append('id', response_id);
		file_form.append('file_upload', _upload_obj.file_arr[id]);

		_upload_obj.file_arr[id] = new Array(_upload_obj.file_arr[id], 1); // This is to set the object as upload-in-progress
		
		$.ajax({
			url: js_domain+request,
			type: 'post',
			data: file_form,
			processData: false, // important
			contentType: false, // important
			xhr: function(){
				myXhr = $.ajaxSettings.xhr();
				if(myXhr.upload){
					myXhr.upload.addEventListener('progress', function(e){
						progress = Math.round((e.loaded * 100) / e.total);
						$('#'+form+'_form #'+variable+'_prev_'+id+' .progress-bar').html(progress+'%');
						$('#'+form+'_form #'+variable+'_prev_'+id+' .progress-bar').css('width', progress+'%');
					});
				}
				return myXhr;
			},												
			beforeSend: function(upload){				
				$('#'+form+'_form #'+variable+'_prev_'+id+' .cancel').click(function(){
					upload.abort();

					if($.isArray(_upload_obj.file_arr[id])){ // This is to prevent loading many times. Enchancement: remove the appended FormData() after upload.abort.
						_upload_obj.uip_count--; // This is upload-in-progress minus count

						if(act == 'insert'){
							if(!_upload_obj.uip_count){
								setTimeout(function(){
									success();
								}, js_timeout);
							}
						} else {
							$('#'+form+'_notice_main_div').delay().fadeOut();
						}

						$('#'+form+'_form #'+variable+'_prev_'+id+' .progress').hide();
						$('#'+form+'_form #'+variable+'_prev_'+id+' .cancel').hide();

						_upload_obj.file_arr[id] = _upload_obj.file_arr[id][0]; // This is to set the object as not upload-in-progress
					}
				});
			},
			success: function(response){
				file_added(form, request, variable, id, response.trim());
			}
		});
	}
}

function file_added(form, request, variable, id, val){
	var _upload_obj = upload_obj[form][variable];
	_upload_obj.uip_count--; // This is upload-in-progress minus count
	_upload_obj.file_arr[id] = '';

	$('#'+form+'_form #'+variable+'_prev_'+id+' .upload').hide();
	$('#'+form+'_form #'+variable+'_prev_'+id+' .remove').html('Delete');
	$('#'+form+'_form #'+variable+'_prev_'+id+' .remove').attr('onclick', "del_box('"+table+"', '"+request+"', '"+val+"', '"+response_id+"', 1)");

	$('#'+form+'_form #'+variable+'_prev_'+id+' .progress').hide();
	$('#'+form+'_form #'+variable+'_prev_'+id+' .cancel').hide();

	$('#'+form+'_form #'+variable+'_prev_'+id).attr('id', val.replace('.', ''));

	if(!_upload_obj.uip_count){
		success();
	}
}

// Process
/* ------------------------------------------------------------------------------------------------ */
function load(table, request){
	var search = $('#'+table+'_search_field').val() || '';
	var go = $('#'+table+'_go_to_field').val() - 1;
	var limit = $('#'+table+'_limit_field').val() || '';
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'manager',
			table: table,
			search: search,
			start: go,
			limit: limit
		},
		success: function(response){
			$('#'+table+'_load_main_div').html(response);
			form_height_load();
		}
	});
}

function search(table, request){
	var search = $('#'+table+'_search_field').val() || '';
	var go = 0;
	var limit = $('#'+table+'_limit_field').val() || '';
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'manager',
			table: table,
			search: search,
			start: go,
			limit: limit
		},
		success: function(response){
			$('#'+table+'_load_main_div').html(response);
		}
	});
}

function limit(table, request){
	var search = $('#'+table+'_search_field').val() || '';
	var go = 0;
	var limit = $('#'+table+'_limit_field').val() || '';
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'manager',
			table: table,
			search: search,
			start: go,
			limit: limit
		},
		success: function(response){
			$('#'+table+'_load_main_div').html(response);
		}
	});
}

function back_next(table, request, start){
	var search = $('#'+table+'_search_field').val() || '';
	var limit = $('#'+table+'_limit_field').val() || '';
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'manager',
			table: table,
			search: search,
			start: start,
			limit: limit
		},
		success: function(response){
			scroll(table+'_table_main_div');
			$('#'+table+'_load_main_div').html(response);
		}
	});
}

function go_to(table, request, page){
	var go = $('#'+table+'_go_to_field').val() - 1;
	if(go < page && go > -1){
		var search = $('#'+table+'_search_field').val() || '';
		var limit = $('#'+table+'_limit_field').val() || '';
		$.ajax({
			url: js_domain+request,
			type: 'post',
			data: {
				proc: 'manager',
				table: table,
				search: search,
				start: go,
				limit: limit
			},
			success: function(response){
				scroll(table+'_table_main_div');
				$('#'+table+'_load_main_div').html(response);
			}
		});
	}
}

function active(table, request, val, id){
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'activate',
			table: table,
			val: val,
			id: id
		},
		success: function(){
			load(table, request);
		}
	});
}

function del_box(table, request, val, id, type = ''){
	$('.del_box_main_div').modal('show');
	$('.del_box_val').html(val);

	if(!type){
		$('.del_box_confirm').attr('onclick', "del('"+table+"', '"+request+"', '"+id+"')");
	} else {
		$('.del_box_confirm').attr('onclick', "del('"+table+"', '"+request+"', '"+id+"', '"+val+"')");
	}
}

function del(table, request, id, val = ''){
	$('#html_notice_main_div').html(js_notice_fine).delay().fadeIn();
	setTimeout(function(){
		$.ajax({
			url: js_domain+request,
			type: 'post',
			data: {
				proc: 'delete',
				table: table,
				id: id,
				val: val
			},
			success: function(){
				$('#html_notice_main_div').html(js_notice_ok).delay(js_delay).fadeOut(js_fadeout);
				if(!val){
					setTimeout(function(){
						if(form_current() == 'form'){
							form_close(table, request);
						} else {
							load(table, request);
						}
					}, js_timeout);
				} else {
					$('#'+val.replace('.', '')).remove();
					form_height_load();
				}
			}
		});
	}, js_timeout);
}

function chosen_load(table, request, act, sel, form, variable, type){
	$('#'+form+'_form #'+variable+'_err_main_div').html('');
	$.ajax({
		url: js_domain+request,
		type: 'post',
		data: {
			proc: 'choose',
			table: table,
			act: act,
			sel: sel,
			form: form,
			variable: variable,
			type: type
		},
		success: function(response){
			$('#'+form+'_form #'+variable+'_chosen_load_span').html(response);
		}
	});
}

function scroll(id){
	var form_name = form_current();
	if(!form_name){
		$('html').animate({
			scrollTop: $('#'+id).offset().top - js_offset
		}, js_scroll);
	} else {
		$('.'+form_name+'_main_div').animate({
			scrollTop: $('.'+form_name+'_main_div').scrollTop() - $('.'+form_name+'_main_div').offset().top + $('#'+id).offset().top - js_offset
		}, js_scroll);
	}
}

function cancel(form){
	$('#'+form+'_form .input_field').css('border-color', '#CCC');
	$('#'+form+'_form .err_main_div').html('');
}

function success(){
	$('#'+form+'_notice_main_div').html(js_notice_ok).delay(js_delay).fadeOut(js_fadeout);
	if(url){
		setTimeout(function(){
			window.location = js_link+url;
		}, js_timeout);
	} else {
		if(typeof submit != 'undefined'){
			var form_name = form_current();
			if(form_name == 'form'){
				setTimeout(function(){
					if(act == 'insert'){
						form_open(table, request, act);
					} else {
						form_open(table, request, act, response_id);
					}
				}, js_timeout);
			} else if(form_name == 'form2'){
				chosen_load(table, request, '', response_id, post_form, post_variable, post_type);
				form2_close();
			} else if(form_name == 'form3'){
				chosen_load(table, request, '', response_id, post_form, post_variable, post_type);
				form3_close();
			}
		}
		scroll(form+'_form');
		delete submit; delete upload;
	}
}

function ucfirst(string){
	return string.substring(0, 1).toUpperCase()+string.substring(1).toLowerCase();
}

function inject(file, ext){
	var element;
	switch(ext){
		case 'js':
			element = document.createElement('script');
    		element.src = file+'.'+ext;
		break;
		case 'css':
			element = document.createElement('link');
    		element.href = file+'.'+ext;
    		element.rel = 'stylesheet';
		break;
	}
	document.getElementsByTagName('head')[0].appendChild(element);
}