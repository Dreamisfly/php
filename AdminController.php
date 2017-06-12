<?php
/**
 * class IndexController
 * 默认动作控制器类
 * @version 1.0
 */
date_default_timezone_set('PRC');
class AdminController extends Mvclib_Controller_Action
{
    /**
     * 当前控制器中所使用的数据库连接对象
     * @var Mvclib_Db_Adapter_Abstract
     */
    protected $_db;
    /**
     * 初始化方法，相当于该类的构造方法；初始化数据库连接对象
     * @see Mvclib_Controller_Action::init()
     */public function init()
{
//1. 构造数据库连接参数
    $config = array(
        'host' => '10.7.1.98',
        'username' => '201502zhangmengf',
        'password' => 'mysql2015',
        'dbname' => '201502zhangmengfei',
        'charset' => 'utf8'
    );
//2. 执行数据库连接
    $this->_db = Mvclib_Db::factory('pdo_mysql', $config);
}
    /**
     * 显示文章类型列表
     */
public function indexAction(){

     //1-1. 获得数据表news中的所有记录
        $rows = $this->_db->fetchAll('users');


        //2.分配数据
        $this->smarty->assign('users', $rows);

        //3、指定模板显示数据
        $this->smarty->display('Admin/index.phtml');
}


/**
 * 显示修改类型页面
 */
public function editAction(){
    //1、获取id
    $id = $this->getParam('id');//获取修改记录的id
    $user = $this->_db->find('users',$id);
    //1-2、 获取新闻类别
    $users = $this->_db->fetchAll('users');
    //2、将数据分配到视图文件（模板赋值）

    $this->smarty->assign('users',$user);;
    //4、显示编辑模板
    $this->smarty->display('Admin/edit.phtml');
}

/**
 * 实现类型的修改
 */
public function updateAction(){
//1、获取待修改数据（表单提交的数据）
$data['username'] = $_POST['username'];
$data['password'] = $_POST['password'];
$data['email'] = $_POST['email'];
$data['question'] = $_POST['question'];
$data['answer'] = $_POST['answer'];
$data['registertime'] = time();
//2、修改数据库内容
$id = $_POST['id'];
$this->_db->update('users',$data,"id=$id");
//3、页面跳转（主页或详情页）
header('location:index');

}
public function detailAction(){
    $id = $this->getParam('id');
    $users = $this->_db->find('users',$id);
    $this->smarty->assign('users',$users);
    $this->smarty->display('Admin/detail.phtml');
}
public function addAction(){
    $users = $this->_db->fetchAll('users');
    $this->smarty->assign('users',$users);
    $this->smarty->display('Admin/add.phtml');
}
/**
 * 处理提交数据
 */
public function insertAction(){
    //1、将提交过来的数据放到数组里
$data['username'] = $_POST['username'];
$data['password'] = $_POST['password'];
$data['email'] = $_POST['email'];
$data['question'] = $_POST['question'];
$data['answer'] = $_POST['answer'];
$data['registertime'] = time();
    //2、上传文件
    $this->_db->insert('users',$data);
    header('Location:detail');

}
}
