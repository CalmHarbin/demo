<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>表格数据传输</title>
	<link rel="stylesheet" href="bs/bootstrap.min.css">
	<script src="bs/jquery-3.2.1.js"></script>
	<script src="bs/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<form action="data.php" method="post">
			<div class="form-group">
				<label for="username">用户名</label>
				<input type="text" id="username" name="username" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">密码</label>
				<input type="password" id="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label>性别</label>
				<input type="radio" name="sex" value="man">男
				<input type="radio" name="sex" value="woman">女
			</div>
			<div class="form-group">
				<label>爱好</label>
				<!--同一个name带多个值使用数组-->
				<input type="checkbox" name="interest[]" value="study">读书
				<input type="checkbox" name="interest[]" value="game">游戏
				<input type="checkbox" name="interest[]" value="music">音乐
				<input type="checkbox" name="interest[]" value="movie">电影
				<input type="checkbox" name="interest[]" value="basketball">篮球
			</div>
			<div class="form-group">
				<label for="region">地区</label>
				<select name="region" id="region">
					<option value="beijin">北京</option>
					<option value="shanghai">上海</option>
					<option value="guangdong">广东</option>
					<option value="wuhan">武汉</option>
				</select>
			</div>
			<div class="form-group">
				<label for="go">我想要去的地方</label>
				<br>
				<select name="go[]" id="go" size="5" multiple>
					<option value="beijin">北京</option>
					<option value="shanghai">上海</option>
					<option value="guangdong">广东</option>
					<option value="wuhan">武汉</option>
					<option value="shenzhen">深圳</option>
					<option value="nanjing">南京</option>
					<option value="yunnan">云南</option>
					<option value="xizang">西藏</option>
				</select>
			</div>
			<div class="form-group">
				<label>自我评价</label>
				<br>
				<textarea name="evalyate" cols="30" rows="10" style="resize:none"></textarea>
			</div>
			<div class="form-group">
				<input type="submit" value="提交">
				<input type="reset" value="清除">
			</div>
		</form>
	</div>
</body>
</html>
