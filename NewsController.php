<?php
/**
 * class IndexController
 * 默认动作控制器类
 * @version 1.0
 */
date_default_timezone_set('PRC');
class NewsController extends Mvclib_Controller_Action
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
     * 显示所有新闻
     */
    public function indexAction()
    {
        //1-1. 获得数据表news中的所有记录
        $rows = $this->_db->fetchAll('news');


        //2.分配数据
        $this->smarty->assign('news', $rows);

        //3、指定模板显示数据
        $this->smarty->display('News/index.phtml');
    }

    /**
     * 显示待修改的信息
     */
public function editAction(){
    //1-1、从数据库获取待修改记录
    $id = $this->getParam('id');//获取修改记录的id
    $news = $this->_db->find('news',$id);
    //1-2、 获取新闻类别
    $types = $this->_db->fetchAll('types');

    //2、将数据分配到视图文件（模板赋值）
    $this->smarty->assign('aaa', $news);
    $this->smarty->assign('types',$types);

    //3、显示视图文件
    $this->smarty->display('News/edit.phtml');
}

    /**
     * 更新数据
     */
public function updateAction(){
    //1、组织数据
    $data = array();//目的，存储待修改的数据
    $data['title'] = $_POST['title'];
    $data['description'] = $_POST['description'];
    $data['content'] = $_POST['content'];
    $data['typeid'] = $_POST['type'];
    $data['updatetime'] = time();

    $id = $_POST['id'];//获取待更新数据的id
    //2、调用模型类里update函数更新数据
    $this->_db->update('news', $data, "id=$id");
    //3、页面重定向
    header('location:index');

}

public function addAction(){
    $types = $this->_db->fetchAll('types');
    $this->smarty->assign('types',$types);
    $this->smarty->display('News/add.phtml');
}
/**
 * 处理提交数据
 */
public function insertAction(){
    //1、将提交过来的数据放到数组里
    $data = array();
    $data['title'] = $_POST['title'];
    $data['description'] = $_POST['description'];
    $data['content'] = $_POST['content'];
    $data['typeid'] = $_POST['type'];
    $data['inputtime'] = time();
    //2、上传文件
    move_uploaded_file($_FILES['thumb']['tmp_name'],'../statics/upload/'.$_FILES['thumb']['name']);
    $data['thumb'] =  $_FILES['thumb']['name'];
        var_dump($data);
        //3、添加数据至数据库

    $this->_db->insert('news',$data);
    header('Location:detail');

}
//显示添加数据详细信息
public function detailAction(){
    $id = $this->getParam('id');
    $news = $this->_db->find('news',$id);
    $this->smarty->assign('news',$news);
    $this->smarty->display('News/detail.phtml');
}
}
