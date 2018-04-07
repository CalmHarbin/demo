var dns=require("dns");
var DNS="www.baidu.com"
dns.lookup(DNS,function(err,ip,family){
	console.log("ip地址为"+ip);
	//反向解析
	dns.reverse(ip,function(err,hostname){
		console.log("域名为"+JSON.stringify(hostname));
	})
});

/*
域名解析为ip地址
dns.lookup(域名,function(err,IP,family){})
ip地址解析为域名
dns.reverse(ip地址,function(err,hostname){})

*/