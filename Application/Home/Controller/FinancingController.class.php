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
            $_POST['add']['startime'] = strtotime($_POST['add']['startime']);
            M('finance_cash')->add($_POST['add']);
    	} else {
            $this->assign('banks', $this->_G['banks']);
    		$this->display();
    	}
    }

    //现金融资详情
    public function cashinfo($id){
    	$info	=	M('finance_cash')->where("id=%d", $id)->find();
    	$ralog = M('finance_ratelog')->where("mobile='%s' AND customer='%s'", array($info['mobile'], $info['customer']))->select();
    	$this->assign('cash', $info);
    	$this->assign('cashlog', $ralog);
    	$this->display();
    }

    //现金融资提现
    public function wcash($id){
        $ary = M('finance_cash')->getDbFields();//获取表finance_cash所有字段
        unset($ary[9],$ary[11]);//销毁status + verify字段
        $v['verify'] = array_md5($ary);//将字段数组加密赋值给verify字段
        $v['endtime'] = time();//获取当前提现时间戳
        M('finance_cash')->where("id='%d'",$id)->save($v);//更新
        $info   =   M('finance_cash')->where("id=%d", $id)->find();
        $this->assign('wcash',$info);
        $this->display();
    }

    public function review($id){
        $data['status'] = 1;
        M('finance_cash')->where("id='%d",$id)->field('status')->save($data) ? $this->success('审核通过！',U('home/Financing/cashinfo',array('id' => $id))) : $this->error('审核失败！',U('home/Financing/cashinfo',array('id' => $id)));
    }
}