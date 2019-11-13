// Email RegEx
var email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

// URL Hash
hash = location.hash;
if(hash){
  hash = hash.replace('#', '');
  hash = hash.split('/');
} else {
  hash = [];
}

// Modal Form
/* ------------------------------------------------------------------------------------------------ */
function __form(obj){
  $('.form'+obj.type+'_main_div').show();
  $('.form'+obj.type+'_main_div').attr('id', obj.table+'_form'+obj.type+'_main_div');
  $('.form'+obj.type+'_main_div').scrollTop(0);
  $('.form'+obj.type+'_content_div .form'+obj.type+'_hidden_field').val('form'+obj.type);
  $('.form'+obj.type+'_content_div .close').attr('onclick', 'form'+obj.type+'_close('+obj.cont_close+')');
  $('.form'+obj.type+'_content_div .form'+obj.type+'_close_button').attr('onclick', 'form'+obj.type+'_close('+obj.form_close+')');
  $('html').attr('style', 'overflow: hidden');
  $.ajax({
    url: js_domain+obj.request,
    type: 'post',
    data: obj.data,
    success: function(response){
      $('.form'+obj.type+'_title').html(obj.title);
      $('.form'+obj.type+'_load_div').html(response);
      form_height_load();
    }
  });
}

function __close(type){
  $('.form'+type+'_main_div').hide();
  $('.form'+type+'_content_div .form'+type+'_hidden_field').val('');
  $('.form'+type+'_title').html('');
  $('.form'+type+'_load_div').html('');
}

function form0_open(table, request, act, id = ''){
  var obj = {
    type: 0,
    table: table,
    cont_close: "'"+table+"', '"+request+"'",
    form_close: "'"+table+"', '"+request+"'",
    request: request,
    data: {
      proc: 'fillin',
      table: table,
      act: act,
      id: id
    },
    title: ucfirst(table)+' Form'
  };
  __form(obj);
}

function form0_close(table, request){
  __close(0); load(table, request);
  $('html').removeAttr('style');
}

function form1_open(table, request){
  var obj = {
    type: 1,
    table: table,
    cont_close: "'"+table+"', '"+request+"'",
    form_close: "'"+table+"', '"+request+"'",
    request: request,
    data: {
      proc: 'setting',
      table: table
    },
    title: 'Setup'
  };
  __form(obj);
}

function form1_close(table, request){
  __close(1); load(table, request);
  if(!form_active('form0')){
    $('html').removeAttr('style');
  }
}

function form2_open(table, request, act, form, variable, type, id = ''){
  var obj = {
    type: 2,
    table: table,
    cont_close: "'"+table+"'",
    form_close: "'"+table+"'",
    request: request,
    data: {
      proc: 'fillin',
      table: table,
      act: act,
      form: form,
      variable: variable,
      type: type,
      id: id
    },
    title: 'Instant ('+ucfirst(table)+' Form)'
  };
  __form(obj);
}

function form2_close(){
  __close(2);
  if(!form_active('form0')){
    $('html').removeAttr('style');
  }
}

function form3_open(table, request, act, form, variable, type, id = ''){
  var obj = {
    type: 3,
    table: table,
    cont_close: "'"+table+"'",
    form_close: "'"+table+"'",
    request: request,
    data: {
      proc: 'fillin',
      table: table,
      act: act,
      form: form,
      variable: variable,
      type: type,
      id: id
    },
    title: 'Instant ('+ucfirst(table)+' Form)'
  };
  __form(obj);
}

function form3_close(){
  __close(3);
  if(!form_active('form0')){
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
  if(form_active('form0')) form = 'form0';
  if(form_active('form1')) form = 'form1';
  if(form_active('form2')) form = 'form2';
  if(form_active('form3')) form = 'form3';
  return form;
}

function form_select(table, request, act, form, variable, type, id = ''){
  var form_name = form_current();
  if(form_name == 'form0'){
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
    $('.form0_load_div .option').tooltip('show');
  }
}

// Measure
/* ------------------------------------------------------------------------------------------------ */
function string(val){
  return val+'';
}

function triup(form, variable){
  var val = $(field(form, variable)).val();
  val = val * 1 + 1;
  $(field(form, variable)).val(format('measure', string(val)));
  $(error(form, variable)).html('');
}

function tridown(form, variable){
  var val = $(field(form, variable)).val();
  if(val >= 1) val = val * 1 - 1;
  val = format('measure', string(val));
  if(val >= 0) $(field(form, variable)).val(val);
  if(val == 0) $(error(form, variable)).html(wNone());
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
        prefix = js_currency;
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
  var prevRemove = function(){
    $(prev(form, variable, id)).remove();
    if(type){
      if(!_upload_obj.file_arr.filter(string).length && !_upload_obj.uip_count){
        $(error(form, variable)).html(wNone());
        $(error(form, variable)).css('top', '22px');
      }
    }
    form_height_load();
  };

  var _upload_obj = upload_obj[form][variable];
  _upload_obj.file_arr[id] = '';
  if(animate){
    $(prev(form, variable, id)).delay(js_delay).fadeOut(js_fadeout);
    setTimeout(function(){
      prevRemove();
    }, 2000);
  } else {
    prevRemove();
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

    $(prev(form, variable, id)+' .progress-bar').html('0%');
    $(prev(form, variable, id)+' .progress-bar').css('width', '0%');

    $(prev(form, variable, id)+' .progress').show();
    $(prev(form, variable, id)+' .cancel').show();

    file_form = new FormData();
    file_form.append('proc', 'copy');
    file_form.append('by', by);
    file_form.append('table', table);
    file_form.append('id', response_id);
    file_form.append('file_upload', _upload_obj.file_arr[id]);

    _upload_obj.file_arr[id] = [_upload_obj.file_arr[id], 1]; // This is to set the object as upload-in-progress

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
            $(prev(form, variable, id)+' .progress-bar').html(progress+'%');
            $(prev(form, variable, id)+' .progress-bar').css('width', progress+'%');
          });
        }
        return myXhr;
      },
      beforeSend: function(upload){
        $(prev(form, variable, id)+' .cancel').click(function(){
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

            $(prev(form, variable, id)+' .progress').hide();
            $(prev(form, variable, id)+' .cancel').hide();

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

  $(prev(form, variable, id)+' .upload').hide();
  $(prev(form, variable, id)+' .remove').html('Delete');
  $(prev(form, variable, id)+' .remove').attr('onclick', "del_box('"+table+"', '"+request+"', '"+val+"', '"+response_id+"', 1)");

  $(prev(form, variable, id)+' .progress').hide();
  $(prev(form, variable, id)+' .cancel').hide();

  $(prev(form, variable, id)).attr('id', val.replace('.', ''));

  if(!_upload_obj.uip_count){
    success();
  }
}

// Process
/* ------------------------------------------------------------------------------------------------ */
function __load(obj){
  var search = $('#'+obj.table+'_search_field').val() || '';
  var limit = (typeof obj.limit != 'undefined')? $('#'+obj.table+'_limit_field').val() || '' : localStorage.limit || '';
  var sort = (typeof obj.sort == 'undefined')? $('#'+obj.table+'_table_main_div td a[class*="sort_"]').attr('id') || '' : obj.sort;
  $.ajax({
    url: js_domain+obj.request,
    type: 'post',
    data: {
      proc: 'manager',
      table: obj.table,
      search: search,
      start: obj.start,
      limit: limit,
      sort: sort
    },
    success: function(response){
      if(obj.scroll) scroll(obj.table+'_table_main_div');
      $('#'+obj.table+'_load_main_div').html(response);
      if(obj.height) form_height_load();
      if(limit && localStorage.limit != limit) localStorage.limit = limit;
    }
  });
}

function load(table, request){
  var obj = {
    table: table,
    request: request,
    start: goto(table),
    scroll: false,
    height: true
  };
  __load(obj);
}

function search(table, request){
  var obj = {
    table: table,
    request: request,
    start: 0,
    scroll: false,
    height: false
  };
  __load(obj);
}

function limit(table, request){
  var obj = {
    table: table,
    request: request,
    start: 0,
    scroll: false,
    height: false,
    limit: true
  };
  __load(obj);
}

function check(self, table){
  var val = $(self).val();
  if(val == '#'){
    $('#'+table+'_load_main_div ._add').show();
    $('#'+table+'_load_main_div ._opt').hide();
  } else {
    $('#'+table+'_load_main_div ._opt').show();
    $('#'+table+'_load_main_div ._add').hide();

    $($('#'+table+'_load_main_div ._opt a[onclick*="active"]')[0]).attr({'data-toggle': 'tooltip', 'data-placement': 'top', 'data-original-title': 'Activate Selected'});
    $($('#'+table+'_load_main_div ._opt a[onclick*="active"]')[1]).attr({'data-toggle': 'tooltip', 'data-placement': 'top', 'data-original-title': 'Deactivate Selected'});
    $('#'+table+'_load_main_div ._opt a[onclick*="del_box"]').attr('data-original-title', 'Delete Selected');
    $('[data-toggle="tooltip"]').tooltip();
  }
}

function back_next(table, request, start){
  var obj = {
    table: table,
    request: request,
    start: start,
    scroll: true,
    height: false
  };
  __load(obj);
}

function go_to(table, request, page){
  var go = goto(table);
  if(go < page && go > -1){
    var obj = {
      table: table,
      request: request,
      start: go,
      scroll: true,
      height: false
    };
    __load(obj);
  }
}

function sort(table, request, field_sort){
  var obj = {
    table: table,
    request: request,
    start: 0,
    scroll: false,
    height: false,
    sort: field_sort
  };
  __load(obj);
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
            if(form_current() == 'form0'){
              form0_close(table, request);
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
  $(error(form, variable)).html('');
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
  if(typeof upload_obj[form] != 'undefined'){
    $('#'+form+'_form div[id*="_prev_"]').remove();
    for(var variable in upload_obj[form]){
      upload_obj[form][variable].file_arr = [];
    }
  }
  $('#'+form+'_form .input_field').css('border-color', '#CCC');
  $('#'+form+'_form .err_main_div').html('');
}

function success(){
  $('#'+form+'_notice_main_div').html(js_notice_ok).delay(js_delay).fadeOut(js_fadeout);
  if(url){
    setTimeout(function(){
      window.location = js_domain+url;
    }, js_timeout);
  } else {
    if(typeof submit != 'undefined'){
      var form_name = form_current();
      if(form_name == 'form0'){
        setTimeout(function(){
          if(act == 'insert'){
            form0_open(table, request, act);
          } else {
            form0_open(table, request, act, response_id);
          }
        }, js_timeout);
      } else if(form_name == 'form2'){
        chosen_load(table, request, '', response_id, post_form, post_variable, post_type);
        form2_close();
      } else if(form_name == 'form3'){
        chosen_load(table, request, '', response_id, post_form, post_variable, post_type);
        form3_close();
      }
      scroll(form+'_form');
      delete submit; delete upload;
    }
  }
}

function ucfirst(string){
  return string.substring(0, 1).toUpperCase()+string.substring(1).toLowerCase();
}

function inject(file){
  var ext = file.substr(file.lastIndexOf('.') + 1);
  var elem;
  switch(ext){
    case 'js':
      elem = document.createElement('script');
      elem.src = file;
    break;
    case 'css':
      elem = document.createElement('link');
      elem.href = file;
      elem.rel = 'stylesheet';
    break;
  }
  document.getElementsByTagName('head')[0].appendChild(elem);
}

function encrypt(str){
  var alphanumeric = js_alphanumeric;
  var rand = Math.floor((Math.random() * alphanumeric.length) + 2);
  var mod = rand % 2;
  if(mod) rand--;
  rand_half = rand / 2;
  var hash = '';
  for(var char of str){
    var index = alphanumeric.indexOf(char);
    if(index >= 0){
      var new_index = (index + rand) % alphanumeric.length;
      hash += alphanumeric.substr(new_index, 1);
    } else {
      hash += char;
    }
  }
  return btoa('<!--192'+rand_half+'168-->'+hash+'<!--0'+rand+'1-->');
}

function unique(table, request, field, val, id = ''){
  $.ajax({
    url: request,
    async: false,
    type: 'post',
    data: {
      proc: 'unique',
      table: table,
      field: field,
      val: encrypt(val),
      id: id
    },
    success: function(response){
      unires = response;
    }
  });
}

function trigger(request){
  switch(hash[1]){
    case 'setup':
      form1_open(hash[0], request);
    break;
    case 'add':
      form0_open(hash[0], request, 'insert');
    break;
    case 'view':
    case 'update':
      unique(hash[0], request, 'id', hash[2]);
      if(unires > 0){
        form0_open(hash[0], request, hash[1], hash[2]);
        delete unires;
      }
    break;
  }
  hash = [];
}

function alpha_event_val(form, variable, event){
  $(field(form, variable))[event](function(){
    if(!$(field(form, variable)).val()){
      $(error(form, variable)).html(wNone());
    } else {
      if(variable.indexOf('email') >= 0){
        if(!email.test($(field(form, variable)).val())){
          $(error(form, variable)).html(msg()+wEmail());
        } else {
          $(error(form, variable)).html('');
        }
      } else {
        $(error(form, variable)).html('');
      }
    }
  });
}

function alpha_submit_val(form, variable, chosen_class){
  $('#'+form+'_form').submit(function(){
    if(!$(field(form, variable)).val()){
      to_focus(form, variable, chosen_class);
      $(error(form, variable)).html(wNone());
    } else {
      if(variable.indexOf('email') >= 0){
        if(!email.test($(field(form, variable)).val())){
          $(error(form, variable)).html(msg()+wEmail());
          to_focus(form, variable, chosen_class);
        }
      }
    }
  });
}

function alpha_unique_event_val(form, request, id, variable, event, trim){
  $(field(form, variable))[event](function(){
    if(!$(field(form, variable)).val()){
      $(error(form, variable)).html(wNone());
    } else {
      if(trim == 'username'){
        if($(field(form, variable)).val() && $(field(form, variable)).val().length <= 5){
          $(error(form, variable)).html(msg()+w6Chars());
        } else {
          ajax_unique_val(form, request, id, variable, trim);
        }
      } else if(trim == 'email'){
        if(!email.test($(field(form, variable)).val())){
          $(error(form, variable)).html(msg()+wEmail());
        } else {
          ajax_unique_val(form, request, id, variable, trim);
        }
      } else {
        ajax_unique_val(form, request, id, variable, trim);
      }
    }
  });
}

function alpha_unique_submit_val(form, request, id, variable, trim){
  $('#'+form+'_form').submit(function(){
    if(!$(field(form, variable)).val()){
      to_focus(form, variable);
      $(error(form, variable)).html(wNone());
    } else {
      if(trim == 'username'){
        if($(field(form, variable)).val() && $(field(form, variable)).val().length <= 5){
          to_focus(form, variable);
          $(error(form, variable)).html(msg()+w6Chars());
        } else {
          ajax_unique_val(form, request, id, variable, trim, 1);
        }
      } else if(trim == 'email'){
        if(!email.test($(field(form, variable)).val())){
          $(error(form, variable)).html(msg()+wEmail());
          to_focus(form, variable);
        } else {
          ajax_unique_val(form, request, id, variable, trim, 1);
        }
      } else {
        ajax_unique_val(form, request, id, variable, trim);
      }
    }
  });
}

function numeric_val(type, form, variable){
  if(type == 'measure'){
    $(field(form, variable)).attr('style', 'text-align: right; padding-right: 25px');
  } else {
    $(field(form, variable)).attr('style', 'text-align: right');
  }

  $('#'+form+'_form .input-group .view_field').attr('style', 'text-align: right');

  $(field(form, variable)).blur(function(){
    var val = $(field(form, variable)).val();
    $(field(form, variable)).val(format(type, sanitize(val)));
  });

  $(field(form, variable)).keypress(function(e){
    var e = (e) ? e : window.event;
    var key = (e.which) ? e.which : e.keycode;
    if(type == 'measure' || type == 'amount' || type == 'percent'){
      if(key > 31 && (key < 46 || key == 47 || key > 57)) return false;
    } else if(type == 'number'){
      if(key > 31 && (key < 48 || key > 57)) return false;
    }
  });
}

function numeric_event_val(form, variable, event){
  $(field(form, variable))[event](function(){
    var val = sanitize($(this).val());
    if(!val || val <= 0){
      $(error(form, variable)).html(wNone());
    } else {
      $(error(form, variable)).html('');
    }
  });
}

function numeric_submit_val(form, variable){
  $('#'+form+'_form').submit(function(){
    var val = sanitize($(field(form, variable)).val());
    if(!val || val <= 0){
      to_focus(form, variable);
      $(error(form, variable)).html(wNone());
    }
  });
}

function numeric_unique_event_val(form, request, id, variable, event, trim){
  $(field(form, variable))[event](function(){
    if(!$(field(form, variable)).val() || $(field(form, variable)).val() <= 0){
      $(error(form, variable)).html(wNone());
    } else {
      ajax_unique_val(form, request, id, variable, trim);
    }
  });
}

function numeric_unique_submit_val(form, request, id, variable, trim){
  $('#'+form+'_form').submit(function(){
    if(!$(field(form, variable)).val() || $(field(form, variable)).val() <= 0){
      to_focus(form, variable);
      $(error(form, variable)).html(wNone());
    } else {
      ajax_unique_val(form, request, id, variable, trim, 1);
    }
  });
}

function date_picker(form, variable, min, max, format, month, year){
  setTimeout(function(){
    $(field(form, variable)).datepicker({
      changeYear: ((!year)? true : false),
      changeMonth: ((!month)? true : false),
      dateFormat: ((format)? format : ''),
      maxDate: ((max)? new Date(max) : ''),
      minDate: ((min)? new Date(min) : '')
    });
  }, js_timeout * 2);

  $('#'+form+'_form #'+variable+'_addon_main_link').click(function(){
    $(field(form, variable)).focus();
  });
}

function pass_event_val(form, variable, type){
  $(field(form, variable)).keyup(function(){
    if(!$(field(form, variable)).val()){
      if(type){
        $(error(form, variable)).html(wNone());
      }
    } else {
      if($(field(form, variable)).val().length <= 5){
        $(error(form, variable)).html(msg()+w6Chars());
      } else {
        $(error(form, variable)).html('');
      }

      var confirm = $('#'+form+'_form #confirm_input_field');
      if(($(field(form, variable)).val() || confirm.val()) && $(field(form, variable)).val() != confirm.val()){
        $(field(form, variable)).css('border-color', 'red');
        confirm.css('border-color', 'red');
      } else {
        $(field(form, variable)).css('border-color', '');
        confirm.css('border-color', '');
      }
    }
  });
}

function pass_submit_val(form, variable, type){
  $('#'+form+'_form').submit(function(){
    if(!$(field(form, variable)).val()){
      if(type){
        to_focus(form, variable);
        $(error(form, variable)).html(wNone());
      }
    } else {
      if($(field(form, variable)).val().length <= 5){
        to_focus(form, variable);
        $(error(form, variable)).html(msg()+w6Chars());
      } else {
        $(error(form, variable)).html('');
      }
    }
  });
}

function con_event_val(form, variable, type){
  $(field(form, variable)).keyup(function(){
    if(type){
      if(!$(field(form, variable)).val()){
        $(error(form, variable)).html(wNone());
        return;
      } else {
        $(error(form, variable)).html('');
      }
    }

    if(($(field(form, variable)).val() || $(pwd(form, variable)).val()) && $(field(form, variable)).val() != $(pwd(form, variable)).val()){
      $(field(form, variable)).css('border-color', 'red');
      $(pwd(form, variable)).css('border-color', 'red');
    } else {
      $(field(form, variable)).css('border-color', '');
      $(pwd(form, variable)).css('border-color', '');
    }
  });
}

function con_submit_val(form, variable, type){
  $('#'+form+'_form').submit(function(){
    if(type){
      if(!$(field(form, variable)).val()){
        to_focus(form, variable);
        $(error(form, variable)).html(wNone());
        return;
      } else {
        $(error(form, variable)).html('');
      }
    }

    if(($('#'+form+'form #'+variable+'_input_field').val() || $(pwd(form, variable)).val()) && $(field(form, variable)).val() != $(pwd(form, variable)).val()){
      to_focus(form, variable);
      $(field(form, variable)).css('border-color', 'red');
      $(pwd(form, variable)).css('border-color', 'red');
    } else {
      $(field(form, variable)).css('border-color', '');
      $(pwd(form, variable)).css('border-color', '');
    }
  });
}

function preview_image(extension, url){
  if(js_image.indexOf(extension) >= 0){
    return '<div style="width: 100%; height: 150px; background: url('+url+') no-repeat center; background-size: 100%"></div>';
  }
}

function preview_audio(extension, url, filename){
  if(js_audio.indexOf(extension) >= 0){
    var html = '';
    html += '<div style="height: 150px; overflow: hidden; word-wrap: break-word">';
    html += '<audio controls>';
    html += '<source src="'+url+'">';
    html += '</audio>';
    html += filename;
    html += '</div>';
    return html;
  }
}

function preview_video(extension, url){
  if(js_video.indexOf(extension) >= 0){
    var html = '';
    html += '<div style="height: 150px">';
    html += '<video controls>';
    html += '<source src="'+url+'">';
    html += '</video>';
    html += '</div>';
    return html;
  }
}

function upload_preview(prev, extension, id, remove, upload = ''){
  var html = '';
  html += '<div id="'+id+'" class="col-md-2">';
  html += '<br>';
  html += '<div class="col-md-12 shadow" style="padding-top: 15px; padding-bottom: 15px">';

  if(!prev){
    html += '<div class="err" style="width: 100%; height: 150px">WhOops! ".'+extension+'" is not allowed. This will be auto removed.</div><br>';
  } else {
    html += prev;
    if(act != 'view' && !upload){
      html += '<span class="remove" onclick="'+remove+'">Delete</span><br>';
    } else if(upload){
      if(act != 'insert') html += '<span class="upload" onclick="'+upload+'">Upload</span>';
      html += '<span class="remove" onclick="'+remove+'">Remove</span>';
      html += '<div class="col-xs-12 upload_item_main_div">';
      html += '<div class="progress" style="display: none"><div class="progress-bar progress-bar-striped active"></div></div>';
      html += '<button class="btn btn-danger btn-sm btn-block cancel" onclick="return false" style="display: none">Cancel</button>';
      html += '</div>';
    }
  }

  html += '</div>';
  html += '</div>';
  return html;
}

function uploaded_preview(table, request, _act, form, variable, id, target){
  for(var key in target){
    var _target = target[key];
    var name = _target.substr(_target.lastIndexOf('/') + 1);
    var ext = name.substr(name.lastIndexOf('.') + 1);

    act = _act;
    var remove = "del_box('"+table+"', '"+request+"', '"+name+"', '"+id+"', 1)";

    var prev = '';
    if(!prev) prev = preview_image(ext, to_url(_target));
    if(!prev) prev = preview_audio(ext, to_url(_target), name);
    if(!prev) prev = preview_video(ext, to_url(_target));

    var html = upload_preview(prev, ext, name.replace('.', ''), remove);
    $('#'+form+'_form #'+variable+'_prev').append(html);
  }
}

function upload_event_val(table, request, _act, form, variable, event, upload_type, upload_by, multi, type, id){
  if(typeof upload_obj[form] == 'undefined'){
    upload_obj[form] = {};
  }
  upload_obj[form][variable] = {};
  upload_obj[form][variable].file_arr = [];
  upload_obj[form][variable].file_count = 0;
  upload_obj[form][variable].upload_type = upload_type;
  upload_obj[form][variable].upload_by = upload_by;
  upload_obj[form][variable].uip_count = 0; // This is upload-in-progress initial count

  $(field(form, variable))[event](function(event){
    var file = event.target.files;
    for(var count = upload_obj[form][variable].file_count; count < file.length + upload_obj[form][variable].file_count; count++){
      var filename = file[count - upload_obj[form][variable].file_count].name;
      var extension = filename.substr(filename.lastIndexOf('.') + 1);

      upload_obj[form][variable].file_arr[count] = file[count - upload_obj[form][variable].file_count];
      var tmppath = URL.createObjectURL(file[count - upload_obj[form][variable].file_count]);

      if(!multi){
        file_remove(form, variable, count - 1, type);
      }

      act = _act;
      var prev_id = variable+'_prev_'+count;
      var upload = "single_upload('"+table+"', '"+request+"', '"+form+"', '"+variable+"', '"+id+"', '"+count+"', '"+upload_by+"')";
      var remove = "file_remove('"+form+"', '"+variable+"', '"+count+"', '"+type+"')";

      var prev = '';
      if(upload_obj[form][variable].upload_type.indexOf('image') >= 0 && !prev){
        prev = preview_image(extension, tmppath);
      }

      if(upload_obj[form][variable].upload_type.indexOf('audio') >= 0 && !prev){
        prev = preview_audio(extension, tmppath, filename);
      }

      if(upload_obj[form][variable].upload_type.indexOf('video') >= 0 && !prev){
        prev = preview_video(extension, tmppath);
      }

      var html = upload_preview(prev, extension, prev_id, remove, upload);
      $('#'+form+'_form #'+variable+'_prev').prepend(html);

      if(!prev){
        file_remove(form, variable, count, type, 1);
      }
    }

    $(this).val('');
    upload_obj[form][variable].file_count = count;
    form_height_load();
    $(error(form, variable)).html('');
  });
}

function upload_submit_val(form, variable, type){
  $('#'+form+'_form').submit(function(){
    if(!upload_obj[form][variable].file_arr.filter(string).length){
      if(type){
        to_focus(form, variable);
        $(error(form, variable)).html(wNone());
        $(error(form, variable)).css('top', '22px');
      }
    } else {
      upload = true;
    }
  });
}

function form_submit(_table, _request, _act, _form, id, _url, _post_form, _post_variable, _post_type){
  var FormValBefore = '';
  setTimeout(function(){
    $('#'+_form+'_form .input_field').each(function(){
      FormValBefore += $(this).val();
    });
  }, js_timeout * 3);

  $('#'+_form+'_form').submit(function(){
    if(submit == true){
      var notice = $('#'+_form+'_notice_main_div');
      notice.html(js_notice_fine).delay().fadeIn();

      var FormValAfter = '';
      $('#'+_form+'_form .input_field').each(function(){
        FormValAfter += $(this).val();
      });

      if(!FormValBefore || FormValBefore == FormValAfter && upload == false){
        setTimeout(function(){
          notice.html(js_notice_no).delay(js_delay).fadeOut(js_fadeout);
        }, js_timeout);
        delete submit; delete upload;
      } else {
        var FormData = {};
        $('#'+_form+'_form input[type="hidden"]').each(function(){
          FormData[$(this).attr('name')] = $(this).val();
        });
        $('#'+_form+'_form .input_field').each(function(){
          FormData[$(this).attr('name')] = encrypt(sanitize($(this).val()));
        });
        setTimeout(function(){
          $.ajax({
            url: js_domain+_request,
            type: 'post',
            data: FormData,
            success: function(response){
              // Redirection Page
              url = _url;
              // Module Vars
              table = _table;
              request = _request;
              // Form Vars
              act = _act;
              form = _form;
              if(act == 'insert'){
                response_id = response.trim();
              } else {
                response_id = id;
              }
              // Post Form Vars
              post_form = _post_form;
              post_variable = _post_variable;
              post_type = _post_type;
              // Result
              if(upload == true){
                multi_upload();
              } else {
                success();
              }
            }
          });
        }, js_timeout);
      }
    }
    return false;
  });
}

function ajax_unique_val(form, request, id, variable, trim, type = ''){
  if(typeof timer != 'undefined'){ clearTimeout(timer); } timer = setTimeout(function(){
    var async = (!type)? true : false;
    $.ajax({
      url: js_domain+request,
      async: async,
      type: 'post',
      data: {
        proc: 'unique',
        table: form,
        field: trim,
        val: encrypt($(field(form, variable)).val()),
        id: id
      },
      success: function(response){
        if(response.substr(-1) > 0){
          if(type) to_focus(form, variable);
          $(error(form, variable)).html(msg()+' again, this '+trim+' is already taken.');
        } else {
          $(error(form, variable)).html('');
        }
      }
    });
  }, js_timeout);
}

function to_focus(form, variable, chosen_class = ''){
  if(submit != false){
    var form_name = form_current();
    if(!form_name){
      $('html').animate({
        scrollTop: $(field(form, variable)+chosen_class).offset().top - js_offset
      }, js_scroll, function(){ $(field(form, variable)+chosen_class).focus(); });
    } else {
      $('.'+form_name+'_main_div').animate({
        scrollTop: $('.'+form_name+'_main_div').scrollTop() - $('.'+form_name+'_main_div').offset().top + $(field(form, variable)+chosen_class).offset().top - js_offset
      }, js_scroll, function(){ $(field(form, variable)+chosen_class).focus(); });
    }
  }
  submit = false;
}

function to_url(dir){
  return dir.replace(js_base, js_domain);
}

function sanitize(str){
  str = str.replace(js_currency, '');
  str = str.replace('%', '');
  return str;
}

function first(focus){
  var form_name = form_current();
  form_name = (form_name)? form_name+'_load' : 'content_main';
  if(focus == 0){
    var input = $('.'+form_name+'_div .input_field:first');
    input.focus();
    var val = input.val();
    input.val('');
    input.val(val);
  } else {
    setTimeout(function(){
      $('.'+form_name+'_div .chosen-container input:first').focus();
    }, js_timeout);
  }
}

function field(form, variable){
  return '#'+form+'_form #'+variable+'_input_field';
}

function pwd(form, variable){
  return '#'+form+'_form #password_input_field';
}

function prev(form, variable, id){
  return '#'+form+'_form #'+variable+'_prev_'+id;
}

function goto(table){
  return $('#'+table+'_go_to_field').val() - 1;
}

function error(form, variable){
  return '#'+form+'_form #'+variable+'_err_main_div';
}

function msg(){
  return 'Please fill out this field';
}

function wNone(){
  return msg()+'.';
}

function wEmail(){
  return ' with an email.';
}

function w6Chars(){
  return ' with 6 chars or above.';
}