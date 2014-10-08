<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class SettingController extends BaseController {

    //账号登录设置
    public function slogin(){
    	$this->display();
    }

    //系统参数设置
    public function settings(){
        if(IS_POST){
            // zecho($_POST);
            foreach($_POST as $ke => $va){
                // M('common_setting')->where("skey='s%'",$ke)->save($va);
            }
            M('common_setting')->add($_POST['add']) ? $this->success('信息添加成功！') : $this->error('信息添加失败！');
        } else {
            $this->display();   
        }
    }

    //菜单项目维护
    public function sidebar(){
        if(formcheck('submit_sidebar')){
            if(!empty($_POST['add']['title']) && !empty($_POST['add']['controller']) && !empty($_POST['add']['action'])){
                M('admincp_sidebar')->add($_POST['add']);
            }
            foreach ($_POST['edit'] as $key => $value) {
                M('admincp_sidebar')->where("id='d%'",$key)->save($value);
            }
        } else {
            $this->assign('formhash', formhash());
            $this->display();
        }
    	
    }
}