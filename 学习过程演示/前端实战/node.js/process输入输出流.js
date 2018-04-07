process.stdin.on("readable",function(){
	var str=process.stdin.read();//读取输入的字符
	if(str!==null){
		process.stdout.write(str);//输出字符
	}
});