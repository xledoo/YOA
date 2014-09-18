<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class FinancingController extends BaseController {

    //现金融资
    public function fcash(){
    	$fc = M('finance_cash')->where("stype='cash'")->select();
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
    	$this->assign('fcash',$fc);
    	$this->display();
    }

    //添加现金融资业务
    public function addcash(){
    	if(IS_POST){
    		// zecho($_POST);
            $_POST['add']['stype']  =   'cash';
            $_POST['add']['startime'] = strtotime($_POST['add']['startime']);
            M('finance_cash')->add($_POST['add']) ? $this->success('业务添加成功！') : $this->error('业务添加失败！');
    	} else {
            $this->assign('banks', $this->_G['banks']);
    		$this->display();
    	}
    }

    //现金融资详情
    public function cashinfo($id){
    	$info	=	M('finance_cash')->where("id=%d", $id)->find();
    	$ralog = M('finance_ratelog')->where("mobile='%s' AND customer='%s'", array($info['mobile'], $info['customer']))->select();
    	$ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
        $this->assign('cash', $info);
    	$this->assign('cashlog', $ralog);
    	$this->display();
    }

    //编辑现金融资业务
    public function editcash($id){
        if(IS_POST){
            // zecho($_POST);
            $_POST['edit']['startime'] = strtotime($_POST['edit']['startime']);
            $_POST['edit']['endtime'] = strtotime($_POST['edit']['endtime']);
            M('finance_cash')->where("id='%d'", $id)->save($_POST['edit']) ? $this->success('信息修改成功！') : $this->error('信息修改失败！');
        } else {
            $info   =   M('finance_cash')->where("id='%d'", $id)->find();
            $this->assign('banks', $this->_G['banks']);
            $this->assign('ecash',$info);
            $this->display();
        }
    }

    //现金融资提现
    public function wcash($id){
        // $ary = M('finance_cash')->getDbFields();//获取表finance_cash所有字段
        // $temp = $ary;
        // unset($temp[11]);//销毁status + verify字段
        // $v['verify'] = array_md5($temp);//将字段数组加密赋值给verify字段
        $v['endtime'] = time();//获取当前提现时间戳
        $v['status'] = 1;//切换为提现状态
        M('finance_cash')->where("id='%d'",$id)->save($v);//更新
        $info   =   M('finance_cash')->where("id=%d", $id)->find();
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
        $this->assign('wcash',$info);
        $this->display();
    }

    //审核
    public function review($id){
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $info   =   M('finance_cash')->where("id=%d", $id)->getField('status');
        return D("financecash")->review_pass($id) ? $this->success($ex[$info].'审核通过') : $this->error($ex[$info].'审核失败或已审核');
    }

    //资金拆借
    public function borrow(){
        $this->display();
    }

    //信用卡融资
    public function fcard(){
        $fc = M('finance_cash')->where("stype='card'")->select();
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
        $this->assign('banks', $this->_G['banks']);
        $this->assign('fcard',$fc);
        $this->display();
    }

    //添加信用卡融资业务
    public function addcard(){
        if(IS_POST){
            // zecho($_POST[]);
            $_POST['add']['stype']  =   'card';
            $_POST['add']['startime'] = strtotime($_POST['add']['startime']);
            M('finance_cash')->add($_POST['add']) ? $this->success('业务添加成功！') : $this->error('业务添加失败！');
        } else {
            $this->assign('banks', $this->_G['banks']);
            $this->display();
        }
    }

    //信用卡融资详情
    public function cardinfo($id){
        $info   =   M('finance_cash')->where("id=%d", $id)->find();
        $ralog = M('finance_ratelog')->where("mobile='%s' AND customer='%s'", array($info['mobile'], $info['customer']))->select();
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
        $this->assign('banks', $this->_G['banks']);
        $this->assign('card', $info);
        $this->assign('cardlog', $ralog);
        $this->display();
    }

    //编辑信用卡融资业务
    public function editcard($id){
        if(IS_POST){
            // zecho($_POST);
            $_POST['edit']['startime'] = strtotime($_POST['edit']['startime']);
            $_POST['edit']['endtime'] = strtotime($_POST['edit']['endtime']);
            M('finance_cash')->where("id='%d'", $id)->save($_POST['edit']) ? $this->success('信息修改成功！') : $this->error('信息修改失败！');
        } else {
            $info   =   M('finance_cash')->where("id='%d'", $id)->find();
            $this->assign('banks', $this->_G['banks']);
            $this->assign('ecard',$info);
            $this->display();
        }
    }

    //信用卡融资提现
    public function wcard($id){
        // $ary = M('finance_cash')->getDbFields();//获取表finance_cash所有字段
        // $temp = $ary;
        // unset($temp[11]);//销毁status + verify字段
        // $v['verify'] = array_md5($temp);//将字段数组加密赋值给verify字段
        $v['endtime'] = time();//获取当前提现时间戳
        $v['status'] = 1;//切换为提现状态
        M('finance_cash')->where("id='%d'",$id)->save($v);//更新
        $info   =   M('finance_cash')->where("id=%d", $id)->find();
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
        $this->assign('wcard',$info);
        $this->display();
    }

    //删除融资业务
    public function delfina($id){
        // echo($id);
        M('finance_cash')->where("id='%d'",$id)->delete() ? $this->success('删除成功') : $this->error('删除失败');
    }
}