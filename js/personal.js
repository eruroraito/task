	$('#personal').addClass('selected');
	$('strong').hide();
	$('#former_pass').val('');
	$('#password').val('');
	$('#rept_password').val('');
	$('#changeForm').submit(function() {
		if($('#former_pass').val()=='') {
			$('strong').text('请输入原密码').show();
			return false;
		}
		if($('#password').val()=='') {
			$('strong').text('请输入新密码').show();
			return false;
		}
		if($('#rept_password').val()=='') {
			$('strong').text('请再次输入新密码').show();
			return false;
		}
		if($('#password').val()!=$('#rept_password').val()){
			$('strong').text('两次密码输入不一致').show();
			$('#former_pass').val('');
			$('#password').val('');
			$('#rept_password').val('');
			return false;
		}
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("修改成功");
				window.location.reload();
			}else{
				$('strong').text(response.detail).show();
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 