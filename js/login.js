	$('strong').hide();
	$('#loginform').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				location.href='home';
			}else{
				$('strong').text(response.detail).show();
			}
		} }; 
		$('#loginform').ajaxSubmit(options); 		
		return false;
	});
	$('#captcha').click(function(){
		var src ="login/captcha?"+(new Date().getTime());
		$(this).attr('src',src);
	});

	$('#username').focus(function(){
		$(this).addClass('focus');
		$(this).removeClass('error');
	});
	$('#username').blur(function(){
		$(this).removeClass('focus');
	});
	$('#password').focus(function(){
		$(this).addClass('focus');
		$(this).removeClass('error');
	});
	$('#password').blur(function(){
		$(this).removeClass('focus');
	});
	$('#captcha_id').focus(function(){
		$(this).addClass('focus');
		$(this).removeClass('error');
	});
	$('#captcha_id').blur(function(){
		$(this).removeClass('focus');
	});
	$('#submit').click(function(){
		if($('#username').val()==""){
			$('#username').addClass('error');
			$('strong').text("请输入用户名").show();
			return false;
		}else{
			$('#username').removeClass('error');
		}
		if($('#password').val()==""){
			$('#password').addClass('error');
			$('strong').text("请输入密码").show();
			return false;
		}else{
			$('#password').removeClass('error');
		}
		if($('#captcha_id').val()==""){
			$('#captcha_id').addClass('error');
			$('strong').text("请输入验证码").show();
			return false;
		}else{
			$('#captcha_id').removeClass('error');
		}
	});