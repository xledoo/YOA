<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class FinancingController extends BaseController {

    //现金融资
    public function fcash(){
    	$fc = M('finance_cash')->select();
    	$this->assign('fcash',$fc);
    	$this->display();
    }

    //信用卡融资
    public function fCard(){
    	$this->display();
    }

    //资金拆借
    public function borrow(){
    	$this->display();
    }

    //添加现金融资业务
    public function addcash($stype){
    	if(IS_POST){
    		zecho($_REQUEST);
            M('finance_cash')->add($_POST['add']);
    	} else {
    		$this->display();
    	}
    }

    //现金融资详情
    public function cashinfo($id){
    	$info	=	M('finance_cash')->where("id=%d", $id)->find();
    	$ralog = M('finance_ratelog')->where("mobile='%s' AND customer='%s'", array($info['mobile'], $info['customer']))->select();
    	// zecho($ralog);
    	$this->assign('cash', $info);
    	$this->assign('cashlog', $ralog);
    	$this->display();
    }
}