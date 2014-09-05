<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class SettingController extends BaseController {
    public function slogin(){
    	$this->display();
    }

    public function settings(){
    	$this->display();
    }

    public function sidebar(){
    	if(IS_POST){
    		foreach ($_POST['edit'] as $key => $value) {

    			M('admincp_sidebar')->where("id=%d", $key)->save($value);
    		}
    	} else {
    		$this->display();	
    	}
    	
    }
}