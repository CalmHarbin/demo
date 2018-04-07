<?php 
$obj=[[
	"id"=>1,
	"username"=>"user1",
	"password"=>"123"
],[
	"id"=>2,
	"username"=>"user2",
	"password"=>"123"
]];
echo json_encode($obj,JSON_UNESCAPED_UNICODE);
 ?>