# php
demo
<?php
 header("Content-Type:text/html; charset=utf-8");
//引入Smarty并实例化
require "libs/smarty/Smarty.class.php";
$smarty = new Smarty();


//设置属性
$smarty->setTemplateDir("templates");
$smarty->addTemplateDir("templates2");
$smarty->setCompileDir("templates_c");
$smarty->setCacheDir("cache");
$smarty->setConfigDir("config"); 
?>
<?php
include "demo2-2-SmartyInit.inc.php";

//普通变量
$copyright = "某人版权所有 copyright 2014";
$smarty->assign('copyright',$copyright);
//数组
$user = array(
"name" => "testUser",
"role" => "注册会员",
);
$smarty->assign('user',$user);
//$smarty->assign(array('name1'=>$var1, 'name2'=>$var2));
//对象
class db{
public $dbhost = "127.0.0.1";
public $dbname = "test";
}
$obj = new db();
$smarty->assign('aa',$obj);
$smarty->display('demo2-4.html');
<html>
<head>
</head>

<body>
会员名称：{$user.name} <br />
会员等级：{$user.role}<br />
<hr />
数据库信息：&nbsp;&nbsp; {$aa->dbhost}{$aa->dbname}<br />
<hr />
版权信息：{$copyright}
</body>	
</html>
