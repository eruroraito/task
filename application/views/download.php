<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>资料下载</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../common/jquery.form.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="../pics/favicon.ico" media="screen" />
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<style type="text/css">
		section.body {width:946px;height:550px;margin:0 auto; background:#cfcfcf;padding-top: 20px;position:relative;}
		section.upload{background:url(../pics/system_bg.png) no-repeat;width:780px;height:518px;margin:0 auto;padding:0 37px;}
		span.left{float:left;width:160px;height: 670px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		span.right{float:right;width:160px;height: 670px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		footer{width:948px;margin:23px auto;text-align: center;}
		h4{margin:0 auto;width:60px;line-height:24px;}
		h3{color:#06574d;font-size:18px;line-height:16px;}
		h3.upload{margin:17px 0px 5px;}
		h3.information{margin:11px 0px 5px;}
		input.submit{background: url(../pics/canvas.png) 0 -360px no-repeat;width:96px;height:31px;border:none;text-indent: -1000px;overflow: hidden;}
		table{width:100%;margin-top:10px;}
		table th{background:#4f81bd;border-bottom:5px solid #fff;height:24px;line-height:24px;padding:0 8px;color:#fff;font-weight:bold;}
		table td{border-bottom: 2px solid #fff;height:20px;line-height: 20px;padding:0 8px;}
		table td.odd{background:#d0d8e8;}
		table td.even{background:#e9edf4;}
		table td a:hover{text-decoration: underline;}
	</style>
</head>
<body>
<article id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>
	<section class="body">
		<section class="upload">
			<h4>资料下载</h4>
			<h3 class="upload">上传资源</h3>
			<form action="download/do_upload" method="post" enctype="multipart/form-data" id="uploadform">
				<input type="file" name="upload" id="filename"/>
				<input type="hidden" name="filename" id="true_name"/>
				<input type="submit" value="上传" class="submit" />
			</form>
			<h3 class="information">资料下载</h3>
			<table>
				<tr>
					<th>点击下载资料</th>
				</tr>
				<?php 
					foreach ($download_names as $key => $value) {
						$class_name = 'odd';
						if($key%2==0) $class_name = 'even';
						echo '<tr>';
						echo '<td class='.$class_name.'><a href=../uploads/help/'.$value['file_name'].'>'.$value['file_name'].'</a></td>';
						echo '</tr>';
					}
				?>
			</table>
		</section>
	</section>	


	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>

<script type="text/javascript">
	$('#download').addClass('selected');
	$('#uploadform').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("上传成功");
				window.location.reload();
			}
			else {
				alert("请上传.xls文件");
				window.location.reload();
			}
		} }; 
		var filename= $('#filename').val();
		$('#true_name').val(filename);
		$('#uploadform').ajaxSubmit(options); 
		
		return false;
	}); 
</script>
</body>
</html>