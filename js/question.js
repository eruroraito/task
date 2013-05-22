	$('#question').addClass('selected');
	$(function() {
		$('#new_preview_section a').lightBox({fixedNavigation:true});
	});
	$('#new_eight').hide();
	$('#button_preview').click(function(){
		$('#one').css('top','375px');
		$('#two').css('top','375px');
		$('#three').css('top','435px');
		$('#four').css('top','435px');
		var type = $("#question_type").val();
		if(type==2){
			$('#new_four').hide();
			$('#new_eight').show();
			$('#answer1').text($('#fill_optin_1').val());
			$('#answer2').text($('#fill_optin_2').val());
			$('#answer3').text($('#fill_optin_3').val());
			$('#answer4').text($('#fill_optin_4').val());
			$('#answer5').text($('#fill_optin_5').val());
			$('#answer6').text($('#fill_optin_6').val());
			$('#answer7').text($('#fill_optin_7').val());
			$('#answer8').text($('#fill_optin_8').val());
		}else{
			$('#new_eight').hide();
			$('#new_four').show();
			if($('#optin_1').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_1').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_1').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#one').html(data1);
				$('#one').css('top','367px');
			}else{
				$('#one').html($('#optin_1').val());
			}
			if($('#optin_2').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_2').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_2').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#two').html(data1);
				$('#two').css('top','367px');
			}else{
				$('#two').html($('#optin_2').val());
			}
			if($('#optin_3').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_3').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_3').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#three').html(data1);
				$('#three').css('top','427px');
			}else{
				$('#three').html($('#optin_3').val());
			}
			if($('#optin_4').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_4').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_4').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#four').html(data1);
				$('#four').css('top','427px');
			}else{
				$('#four').html($('#optin_4').val());
			}
		}
		$('#new_question').text($('#question_name').val());
	});

	$("#question_type").change( 				
		function() { 
			$('#new_question').text('点击预览可以预览');
			$('#answer1').text('');
			$('#answer2').text('');
			$('#answer3').text('');
			$('#answer4').text('');
			$('#answer5').text('');
			$('#answer6').text('');
			$('#answer7').text('');
			$('#answer8').text('');
			$('#one').text('');
			$('#two').text('');
			$('#three').text('');
			$('#four').text('');
			$('#optin_1').val('');
			$('#optin_2').val('');
			$('#optin_3').val('');
			$('#optin_4').val('');	
			$('#fill_optin_1').val('');
			$('#fill_optin_2').val('');
			$('#fill_optin_3').val('');
			$('#fill_optin_4').val('');
			$('#fill_optin_5').val('');
			$('#fill_optin_6').val('');
			$('#fill_optin_7').val('');
			$('#fill_optin_8').val('');
			$('#question_name').val('');
			$('#upload_iamge').val('');
			if($(this).val()==2)
			{	
				$('#new_preview_section').css('background-image','url(../pics/eight.jpg)');
				$("#optionfour").hide();
				$("#optioneight").show();
				$('#question_name').attr('maxlength','42');		
			}else
			{
				$('#new_preview_section').css('background-image','url(../pics/four.jpg)');
				$("#optionfour").show();
				$("#optioneight").hide();	
				if($(this).val()==1||$(this).val()==3)
				{
					$('#question_name').attr('maxlength','14');			
				}else{
					$('#question_name').attr('maxlength','42');
				}
			}
			if($(this).val()==1||$(this).val()==3||$(this).val()==2)
			{
				$("#question_image").show();				
			}else
			{
				$("#question_image").hide();	
			}
		} 
	); 

	$('#myForm').submit(function() {
		var type = $('#question_type').val();
		if($('#question_name').val()=='') {alert('请输入问题');return false;}
		if(type==1||type==3){
			if($('#upload_iamge').val()=='') {alert('请上传图片');return false;}
		}
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
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("添加成功");
				window.location.reload();
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	});

