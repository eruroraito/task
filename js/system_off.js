	$('#system').addClass('selected');
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

	$('#selectall').click(function(){
		var checkboxname = 'input[name='+'"question[]"]';
		if($(checkboxname)){
			$(checkboxname).attr('checked',true);
		}
	});

	$('#selectnone').click(function(){
		var checkboxname = 'input[name='+'"question[]"]';
		if($(checkboxname)){
			$(checkboxname).attr('checked',false);
		}
	});

	$('#selectreverse').click(function(){
		var checkboxname = 'input[name='+'"question[]"]';
		if($(checkboxname)){
			$(checkboxname).each(function(){
				$(this).attr('checked',!this.checked);					
			});			
		}
	});

	$('#question_id').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("下架成功");
				window.location.reload();
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 

	$('button').click(function(){
		$('button').removeClass('selected');
		$(this).addClass('selected');
	});

	$('#offSearchForm').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 