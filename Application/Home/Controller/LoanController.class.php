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

    //Add loan of housing.
    public function add_housing(){
        if(IS_POST){
            zecho($_POST);
        }else{
            $psetting = M('common_member_profile_setting')->select();
            $this->assign('ps',$psetting);
            $info = M('loan_housing')->select();
            $this->assign('add_housing',$info);
            $this->display();
        }
    }

    //Add loan of car.
    public function add_car(){
        $this->display();
    }

    //Edit column of table loan_housing.
    public function add_to_housing(){
    	if(IS_POST){
    		// zecho($_POST);
            foreach($_POST['add_to_housing'] as $key => $value){
                // $vol[] = M()->execute("alter table pre_loan_housing drop column $value");//删除列
                $vol[] = M()->execute("alter table pre_loan_housing add column $value varchar(255) not null");//添加列
            }
            $vol  ? $this->redirect('home/loan/add_housing','字段添加成功') : $this->redirect('home/loan/add_housing','字段添加失败');
    	}else{
			$info = M('common_member_profile_setting')->select();
	    	$this->assign('add_to_housing',$info);
	    	$this->display();
    	}
    }

    //Edit column of table loan_car.
    public function add_to_car(){
    	zecho($_POST);
    	$this->display();
    }

    //List of all loan.
    public function llist(){
        $this->display();
    }
}