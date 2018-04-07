var http=require("http");
var fs=require("fs");
var url=require("url");
var querystring=require("querystring");
http.createServer(function(request,response){
	//定义文件名
	var filename="";
	//判断浏览器传过来的url
	var urlobj=url.parse(request.url);
	//获取文件路径
	var pathname=urlobj.pathname;
	//console.log(pathname)
	if(pathname=="/"){//判断是不是链接
		filename="login.html";
	}else if(pathname=="/checkuser.html"){//判断是不是登录链接
		if(urlobj.query){//如果含有参数
			//判断输入的用户名和密码是否正确
			var params=querystring.parse(urlobj.query);
			if(params.username==="admin"&&params.password==="123"){
				filename="profile.html";//登录成功
			}else{
				filename="404.html";//错误提示
			}
		}
	}else{//如果不是登录链接
		filename="404.html";//错误提示
	}
	//读取文件流,作为响应发给浏览器
	fs.createReadStream(filename).pipe(response);//pipe 设置数据通道，将读入流数据接入写入流；

}).listen(8888,"127.0.0.1",function(){
	console.log("http:\\127.0.0.1:8888");
});