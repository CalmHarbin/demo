var http=require("http");
http.createServer(function(req,res){
	res.writeHead(200,{"content-type":"text/html"});
	res.write("<h1>hello world!</h1>");
	res.end();
}).listen(8888,"127.0.0.1",function(){
	console.log("server 已启动")
})