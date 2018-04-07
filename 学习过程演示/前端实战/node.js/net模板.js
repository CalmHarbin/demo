var net=require("net");
var chat=net.createServer();
chat.on("connection",function(client){//client客户端
	client.write("hello world");//在客户端输出
	client.on("data",function(data){//监听数据
		console.log(data.toString());
	});
	//client.end();//关闭响应
});
chat.listen(9000);
console.log("9000端口已启动");
//cmd中输入telnet 127.0.0.1 9000进入