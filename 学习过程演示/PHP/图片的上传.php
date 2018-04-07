<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件上传</title>
	<link rel="stylesheet" href="bs/bootstrap.min.css">
	<script src="bs/jquery-3.2.1.js"></script>
	<script src="bs/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="files">上传文件</label>
				<input type="file" name="files">
			</div>
			<input type="submit" value="提交">
		</form>
	</div>
</body>
</html>