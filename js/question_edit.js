	$('#question_scan').addClass('selected');
	$('#img_a').hide();
	$(function() {
		$('#new_preview a').lightBox({fixedNavigation:true});
	});
	$('#new_eight').hide();
	$('#myForm').submit(function() {
		var type = $('#question_type').val();
		if($('#question_name').val()=='') {alert('请输入问题');return false;}
		if(type==2){
			if($('#fill_optin_1').val()=='') {alert('请输入选项1');return false;}
			if($('#fill_optin_2').val()=='') {alert('请输入选项2');return false;}
			if($('#fill_optin_3').val()=='') {alert('请输入选项3');return false;}
			if($('#fill_optin_4').val()=='') {alert('请输入选项4');return false;}
			if($('#fill_optin_5').val()=='') {alert('请输入选项5');return false;}
			if($('#fill_optin_6').val()=='') {alert('请输入选项6');return false;}
			if($('#fill_optin_7').val()=='') {alert('请输入选项7');return false;}
			if($('#fill_optin_8').val()=='') {alert('请输入选项8');return false;}
			if(($('#upload_iamge').val()!='')&&($('#question_name').val().length>14)){
				{alert('题目长度不能超过14');return false;}
			}
		}else{
			if($('#optin_1').val()=='') {alert('请输入选项1');return false;}
			if($('#optin_2').val()=='') {alert('请输入选项2');return false;}
			if($('#optin_3').val()=='') {alert('请输入选项3');return false;}
			if($('#optin_4').val()=='') {alert('请输入选项4');return false;}

		}
		$(this).ajaxSubmit(); 
		alert("修改成功");
		return false;
	}); 
	
	$('#deleteFrom').submit(function() {
		var r=confirm("确认删除!?");
		if (r==true){
			$(this).ajaxSubmit();
		 	alert("删除成功!");
		 	window.location.href='question_scan';
		}
		else{
		  	alert("取消删除!");
		}

		return false;
	});

	$('#suggestion_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("审核成功");
				window.location.href='question_scan';
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 