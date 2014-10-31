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
            $info = M('loan')->select();
            $this->assign('ad',$info);
    		$this->display();
    	}
    }

    //Add loan of housing.
    public function add_housing(){
        if(IS_POST){
            // zecho($_POST);
            $_POST['add']['signid'] = $_GET['id'];
            M('loan_housing')->add($_POST['add']) ? $this->success('房产抵押借贷添加成功！') : $this->success('房产抵押借贷添加失败！');
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
        if(IS_POST){
            // zecho($_POST);
            $_POST['add']['signid'] = $_GET['id'];
            M('loan_car')->add($_POST['add']) ? $this->success('车辆抵押借贷添加成功！') : $this->success('车辆抵押借贷添加失败！');
        }else{
            $fd = M('loan_car')->getDbFields();
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

    //Edit column of table loan_housing.
    public function add_to_housing(){
    	if(IS_POST){
    		// zecho($_POST);
            foreach($_POST['add_to_housing'] as $key => $value){
                // $vol[] = M()->execute("alter table pre_loan_housing drop column $value");//删除列
                $vol[] = M()->execute("alter table pre_loan_housing add column $value varchar(255) not null");//添加列
            }
            $vol ? $this->success('资料修改成功！') : $this->error('资料修改失败！');
    	}else{
			$info = M('common_member_profile_setting')->select();
	    	$this->assign('add_to_housing',$info);
	    	$this->display();
    	}
    }

    //Edit column of table loan_car.
    public function add_to_car(){
        if(IS_POST){
            // zecho($_POST);
            foreach($_POST['add_to_car'] as $key => $value){
                // $vol[] = M()->execute("alter table pre_loan_car drop column $value");//删除列
                $vol[] = M()->execute("alter table pre_loan_car add column $value varchar(255) not null");//添加列
            }
            $vol ? $this->success('资料修改成功！') : $this->error('资料修改失败！');
        }else{
            $info = M('common_member_profile_setting')->select();
            $this->assign('add_to_car',$info);
            $this->display();
        }
    }

    //Edit options of table common_member_profile_seting
    public function edit_options($fieldid = ""){
        if(IS_POST){
            // zecho($_POST);
            M('common_member_profile_setting')->where("fieldid='%s'",$_POST['edit']['fieldid'])->save($_POST['edit']) ? $this->success('资料修改成功！') : $this->error('资料修改失败！');
        }else{
            $info = M('common_member_profile_setting')->where("fieldid='%s'",$fieldid)->select();
            $this->assign('eo',$info);
            $this->display();
        }
    }

    //Add options from table common_member_profile_seting
    public function add_options(){
        if(IS_POST){
            // zecho($_POST);
            M('common_member_profile_setting')->add($_POST['add']) ? $this->success('资料添加成功！') : $this->error('资料添加失败！');
        }else{
            $this->display();
        }
    }

    //List of all loan.
    public function llist(){
        $this->display();
    }
}