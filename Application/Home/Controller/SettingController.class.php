<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class SettingController extends BaseController {
    public function slogin(){
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
            // zecho($this->_G['sidebar']);
            zecho($_POST);
    		foreach ($_POST['edit'] as $key => $value) {
                M('admincp_sidebar')->where("id='d%'")->save($value);
    		}
                // $map['controller & upid'] = array('');
                // M('admincp_sidebar')->where($map)->add($value);
    	} else {
    		$this->display();	
    	}
    	
    }
}