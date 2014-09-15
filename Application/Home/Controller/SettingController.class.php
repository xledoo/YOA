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
            zecho($_POST);
            foreach($_POST as $ke => $va){
                M('common_setting')->where("skey='s%'",$ke)->save($va);
            }
            M('common_setting')->add($_POST['add']);
        } else {
            $this->display();   
        }
    }

    //菜单项目维护
    public function sidebar(){
    	if(IS_POST){
            // zecho($this->_G['sidebar']);
            zecho($_POST);
    		foreach ($_POST['edit'] as $key => $value) {
                M('admincp_sidebar')->where("id='d%'",$key)->save($value);
    		}
            // $map['upid'] = 0;
            // $map['controller'] <> $value['controller'];
            // $pam['upid'] = $key;
            // $pam['controller'] <> $value['action'];
            M('admincp_sidebar')->add($_POST['add']);                
    	} else {
    		$this->display();	
    	}
    	
    }
}