	$('#question_scan').addClass('selected');
	$(function() {
		$('#new_question_scan a').lightBox({fixedNavigation:true});
	});
	$('#first_page_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#first_page_form').ajaxSubmit(options); 		
		return false;
	}); 
	$('#pre_page_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#pre_page_form').ajaxSubmit(options); 		
		return false;
	}); 
	$('#next_page_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#next_page_form').ajaxSubmit(options); 		
		return false;
	}); 
	$('#last_page_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#last_page_form').ajaxSubmit(options); 		
		return false;
	}); 
	$('#redirect_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#redirect_form').ajaxSubmit(options); 		
		return false;
	}); 

	$('#myForm').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#myForm').ajaxSubmit(options); 		
		return false;
	}); 
