	$('#system').addClass('selected');
	$('strong').hide();
	$('#user_name').val('');
	$('#user_realname').val('');
	$('#user_password').val('');
	$('#user_rept_password').val('');
	$('#addUserForm').submit(function() {
		if($('#user_name').val()=='') {
			$('strong').text('请输入用户名').show();
			return false;
		}
		if($('#user_realname').val()=='') {
			$('strong').text('请输入真实姓名').show();
			return false;
		}
		if($('#user_password').val()=='') {
			$('strong').text('请输入密码').show();
			return false;
		}
		if($('#user_rept_password').val()=='') {
			$('strong').text('请再次输入密码').show();
			return false;
		}
		if($('#user_password').val()!=$('#user_rept_password').val()){
			$('strong').text('两次密码输入不一致').show();
			$('#user_password').val('');
			$('#user_rept_password').val('');
			return false;
		}
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("创建成功");
				window.location.reload();
			}else{
				$('strong').text(response.detail).show();
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 