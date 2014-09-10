<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class SettingController extends BaseController {
    public function slogin(){
        $User = M('admincp_sidebar'); // 实例化User对象
        $count      = $User->where('upid=0')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where('upid=0')->order('displayorder')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }

    public function settings(){
        if(IS_POST){
            zecho($_POST);
        } else {
            $this->display();   
        }
    }

    public function sidebar(){
    	if(IS_POST){
            // zecho($this->_G['setting']);
            zecho($_POST);
    		foreach ($_POST['edit'] as $key => $value) {
                $map['id | upid'] = $key;
    			M('admincp_sidebar')->where($map)->save($value);
    		}
    	} else {
    		$this->display();	
    	}
    	
    }
}