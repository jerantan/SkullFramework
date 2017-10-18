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

$(window).resize(function(){
	form_height_load();
});