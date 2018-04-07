var fs=require("fs");
fs.readFile("http.js",function(err,data){
	if(err){//如果有错误
		return console.log(err);
	}
	console.log(data.toString());
})
console.log("程序执行完毕");