var http=require("http");
var url=require("url");

var cs=function(req,res){
	var URL=req.url;
	var pathName=url.parse(URL).pathname;
	//console.log(URL,pathName);
	if(URL!=="/favicon.ico"){
		//路由
		switch (pathName)
		{
		case "/user/add":
			res.write("<h1>user add</h1>");
			break;
		case "/user/delete":
			res.write("<h1>user delete</h1>");
			break;
		case "/user/update":
			res.write("<h1>user update</h1>");
			break;
		case "/user/select":
			res.write("<h1>user select</h1>");
			break;
		default: 
			res.write("<h1>index page</h1>");
			break;
		}
	}
	res.end();
}
http.createServer(cs).listen(8888);
console.log("8888端口已打开");