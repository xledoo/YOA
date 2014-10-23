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
            unset($_POST['submit_add_housing']);
            M('loan_housing')->add($_POST) ? $this->success('资料添加成功！') : $this->success('资料添加失败！');
        }else{
            $fd = M('loan_housing')->getDbFields();
            foreach($fd as $key => $value){
                $oo[$value] = M('common_member_profile_setting')->where("fieldid='%s'",$value)->select();
                foreach($oo[$value] as $k => $v){
                    $oo[$value] = $v;
                }
            }
            $this->assign('lv',$oo);
            $this->display();
        }
    }

    //Add loan of car.
    public function add_car(){
            $fd = M('loan_housing')->getDbFields();
            foreach($fd as $key => $value){
                $oo[$value] = M('common_member_profile_setting')->where("fieldid='%s'",$value)->select();
                foreach($oo[$value] as $k => $v){
                    $oo[$value] = $v;
                }
                $info[] = M('loan_housing')->getField($value,true);
            }
            zecho($info);
        // $fd = M('loan_housing')->getFields('loan_housing');
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
            $vol  ? $this->redirect('home/loan/add_housing') : $this->redirect('home/loan/add_housing');
    	}else{
			$info = M('common_member_profile_setting')->select();
	    	$this->assign('add_to_housing',$info);
	    	$this->display();
    	}
    }

    //Edit options of table common_member_profile_seting
    public function edit_housing_options($fieldid=""){
        if(IS_POST){
            zecho($_POST);
        }else{
            $info = M('common_member_profile_setting')->where("fieldid='%s'",$fieldid)->select();
            $this->assign('eo',$info);
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