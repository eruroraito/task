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
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<style type="text/css">
		nav {text-align: center;}
		nav a{text-decoration: none; font-size:20px;margin:0 10px 0 0;}
		nav a:hover{text-decoration: underline;}
	</style>
</head>
<body>
<?php require_once 'header.php';?>
<article id="container">
	<section id="body">
		<h3>资源列表</h3>
		<?php 
			foreach ($download_names as $key => $value) {
				echo '<a href=../uploads/help/'.$value['file_name'].'>'.$value['file_name'].'</a><br />';
			}
		?>
	</section>	

	<section id="upload">
		<h3>上传资源</h3>
		<form action="download/do_upload" method="post" enctype="multipart/form-data" id="uploadform">
			<input type="file" name="upload" id="filename"/>
			<input type="hidden" name="filename" id="true_name"/>
			<input type="submit" value="上传"/>
		</form>
	</section>
</article>

<script type="text/javascript">
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