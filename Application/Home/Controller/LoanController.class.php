<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class LoanController extends BaseController {
    public function add(){
    	if(IS_POST){
    		// zecho($_POST);
    		if($_POST['add_loan'] == 'housing'){
    			$this->redirect('home/loan/add_housing');
    		} elseif ($_POST['add_loan'] == 'car') {
    			$this->redirect('home/loan/add_car');
    		}
    	} else {
    		$this->display();
    	}
    }

    public function llist(){
    	$this->display();
    }

    public function add_to_housing(){
    	if(IS_POST){
    		zecho($_POST);
    	}else{
			$info = M('common_member_profile_setting')->select();
	    	$this->assign('add_loan',$info);
	    	$this->display();
    	}
    }

    public function add_to_car(){
    	zecho($_POST);
    	$this->display();
    }
}