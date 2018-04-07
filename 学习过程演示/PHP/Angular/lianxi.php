<!DOCTYPE html>
<html ng-app="myapp">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><!--探测屏幕-->
<link rel="stylesheet" href="../bs/bootstrap.min.css">
<script src="../bs/jquery-3.2.1.js"></script>
<script src="../bs/bootstrap.min.js"></script>
<script src="angular.min.js"></script>
<script src="angular-ui-router.js"></script>
<style>
	#top{
		height: 50px;
		line-height: 50px;
		background-color: #999;
	}
	#left{
		width: 200px;
		float: left;
		height: 300px;
		border: 1px solid black;
	}
	#right{
		float: right;
		width:500px;
		height: 300px;
	}
</style>
<title>多路由</title>
</head>
<body ng-cloak >

	<div ui-view="top" id="top"></div>
	<div ui-view="left" id="left"></div>
	<div ui-view="right" id="right"></div>
	
</body>
<script>
	var myapp=angular.module('myapp',['ui.router']);//引入ui-route模块
	
	//路由器
	myapp.config(['$stateProvider','$urlRouterProvider',function($stateProvider,$urlRouterProvider){
		//1.6路由解决办法
		// $locationProvider.hashPrefix('');

		//默认路由
		$urlRouterProvider.otherwise('/index');
		//定义路由规则
		$stateProvider
			.state("index",{
				url:"/index",
				views:{
					top:{
						templateUrl:"top.html"
					},
					left:{
						templateUrl:"left.html"
					},
					right:{
						templateUrl:"index1.html"
					}
				}
			})
			.state("logon",{
				url:"/logon",
				views:{
					top:{
						templateUrl:"top.html"
					},
					left:{
						templateUrl:"left.html"
					},
					right:{
						templateUrl:"logon1.html"
					}
				}
			})

	}])

</script>
</html>
