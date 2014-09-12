<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class FinancingController extends BaseController {
    public function fcash(){
    	$fc = M('finance_cash')->select();
    	$this->assign('fcash',$fc);
    	$this->display();
    }

    public function fCard(){
    	$this->display();
    }

    public function borrow(){
    	$this->display();
    }

    public function add($stype){
    	if(IS_POST){
    		zecho($_POST);
    	} else {
    		$this->display();
    	}
    }

    public function cashinfo($id){
    	$info	=	M('finance_cash')->where("id=%d", $id)->find();
    	$ralog = M('finance_ratelog')->where("mobile='%s' AND customer='%s'", array($info['mobile'], $info['customer']))->select();
    	// zecho($ralog);
    	$this->assign('cash', $info);
    	$this->assign('cashlog', $ralog);
    	$this->display();
    }
}