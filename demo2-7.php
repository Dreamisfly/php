<?php
include "demo2-2-SmartyInit.inc.php";
date_default_timezone_set('PRC');
$smarty->assign("islogin", false);
$smarty->assign("number", 80);

$smarty->assign("start", 1);
$smarty->assign("end", 10);
$smarty->assign("max", 3);

$smarty->assign("count", 10);

$users = array(
		"user1" => array("username"=>"mahua", "email"=>"mahua@we.com"),
		"user2" => array("username"=>"xigua", "email"=>"xigua@we.com"),
		"user3" => array("username"=>"doufu", "email"=>"doufu@we.com"),
		"user4" => array("username"=>"binggan", "email"=>"binggan@we.com"),
		"user5" => array("username"=>"chouti", "email"=>"chouti@we.com"),
		"user6" => array("username"=>"xiezi", "email"=>"xiezi@we.com"),
	);
$smarty->assign("users", $users);

$admin = array(10, "zhangsan", "male", 23);
$smarty->assign("admin", $admin);

$smarty->display("demo2-7.html");
