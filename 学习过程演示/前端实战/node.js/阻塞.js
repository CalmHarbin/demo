var fs=require("fs");
var data=fs.readFileSync("http.js");
console.log(data.toString());//以字符串形式输出数据
console.log("程序执行结束");