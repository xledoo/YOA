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
        $this->assign('banks', $this->_G['banks']);
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
        $v = M('finance_cash')->where("id='$id'", $id)->find();
        if($v['status'] != 1){
            M('finance_cash')->where("id='%d'",$id)->save(array('endtime' => time(),'status' => 1));//更新为提现状态
        }

        $info   =   M('finance_cash')->where("id=%d", $id)->find();
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
        $this->assign('banks', $this->_G['banks']);
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
            // zecho($_POST);
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
        $v = M('finance_cash')->where("id='$id'", $id)->find();
        if($v['status'] != 1){
            M('finance_cash')->where("id='%d'",$id)->save(array('endtime' => time(),'status' => 1));//更新为提现状态
        }

        $info   =   M('finance_cash')->where("id='%d'", $id)->find();
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
        $this->assign('banks', $this->_G['banks']);
        $this->assign('wcard',$info);
        $this->display();
    }

    //删除融资业务
    public function delfina($id){
        M('finance_cash')->where("id='%d'",$id)->delete() ? $this->success('删除成功') : $this->error('删除失败');
    }

    //打款计划
    public function rate(){

        $month  =   I('month') ? intval(I('month')) : date('n');
        $yeah   =   I('yeah') ? intval(I('yeah')) : date('Y');

        $mday   =   mktime(0,0,0,$month,1,$yeah);
        $eday   =   mktime(23, 59, 59, $month, date('t'), $yeah);
        $map['dateline']  = array(array('GT',$mday),array('LT',$eday),'and'); 

        $list = M('finance_ratelog')->where($map)->select();
        $this->assign('banks', $this->_G['banks']);
        $this->assign('list', $list);
        $this->display();
    }

    //打款计划生成
    public function rate_build(){
        $model  =   D('financecash');
        $mday   =   mktime(0,0,0,date('n'),1,date('Y'));
        $eday   =   mktime(23, 59, 59, date('n'), date('t'), date('Y'));
        $map['dateline']  = array(array('GT',$mday),array('LT',$eday),'and');

        $fina = $model->select();
        foreach ($fina as $key => $value) {
            if($model->review_verify($value['id'])){
                $map['cashid']  =   $value['id'];
                if(!M('finance_ratelog')->where($map)->find()){
                    $value['cashid']    =   $value['id'];
                    unset($value['id']);unset($value['startime']);
                    unset($value['endtime']);unset($value['cbankname']);
                    unset($value['ccardnum']);
                    unset($value['hkday']);unset($value['status']);
                    unset($value['sponsor']);unset($value['verify']);
                    $value['remark']    =   date('n').'月融资利息';

                    if($value['stype'] == 'cash'){
                        $rate = $value['money'] * $value['rate'] / 1000;
                        $value['dateline']  =   NOW_TIME;
                    } elseif($value['stype'] == 'card'){
                        $rate = $value['money'] * 10 / 1000;
                        $value['dateline']  =   mktime(0,0,0,date('n'),$value['zday'],date('Y'));
                    }
                    unset($value['zday']);
                    $value['rate']  =   tofloat($rate);
                    M('finance_ratelog')->add($value);                    
                }

            }
        }
        $this->success('打款计划生成成功', U('home/financing/rate'));
    }

    //返回json数据
    public function rateinfo(){
        $banks = $this->_G['banks'];
        $json['id']       =   I('id');
        $jso = M('finance_ratelog')->where("id=%d",I('id'))->find();
        $jso['dateline'] = date("Y-m-d",$jso['dateline']);
        $jso['stype'] = $jso['stype'] == 'cash' ? '现金' : ($jso['stype'] == 'card' ? '信用卡' : '空');
        $jso['bankname'] = $banks[$jso['bankname']]['bankname'];
        exit(json_encode($jso));
    }

    //打款状态确认
    public function dorate($id){
        // zecho($id);
        $data['status'] = '1';
        M('finance_ratelog')->where("id='%s'",$id)->save($data) ? $this->success('状态更改为 已打款') : $this->error('打款状态更新失败！');
    }
}