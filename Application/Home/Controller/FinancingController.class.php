<?php
namespace Home\Controller;
use Common\Controller\BaseController;

class FinancingController extends BaseController {

    // $financing = D('FinanceCash');
    // $financing = new \Home\Model\FinanceCashModel();

    //现金融资
    public function fcash(){
        $financing = D('FinanceCash');
    	$fc = $financing->Cash_select();
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
        $financing = D('FinanceCash');
    	if(IS_POST){
    		// zecho($_POST);
            $_POST['add']['stype']  =   'cash';
            $_POST['add']['startime'] = strtotime($_POST['add']['startime']);
            $financing->Cash_add($_POST['add']) ? $this->success('业务添加成功！', U('Home/Financing/fcash')) : $this->error('业务添加失败！');
    	} else {
            $this->assign('banks', $this->_G['banks']);
    		$this->display();
    	}
    }

    //现金融资详情
    public function cashinfo($id){
        $financing = D('FinanceCash');
        $ratelog = D('FinanceRatelog');
    	$info	=	$financing->Cash_select($id);
        $map = array('mobile' => $info['mobile'], 'customer' => $info['customer']);
        $ratelog = $ratelog->Rate_select($map);
    	// $ralog = M('finance_ratelog')->where(array('mobile' => $info['mobile'], 'customer' => $info['customer']))->select();
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
        $financing = D('FinanceCash');
        if(IS_POST){
            // zecho($_POST);
            $_POST['edit']['startime'] = strtotime($_POST['edit']['startime']);
            $_POST['edit']['endtime'] = strtotime($_POST['edit']['endtime']);
            $financing->Cash_save($id,$_POST['edit']) ? $this->success('信息修改成功！') : $this->error('信息修改失败！');
        } else {
            $info   =   $financing->Cash_select($id);
            $this->assign('banks', $this->_G['banks']);
            $this->assign('ecash',$info);
            $this->display();
        }
    }

    //现金融资提现
    public function wcash($id){
        $financing = D('FinanceCash');
        $info = $v = $financing->Cash_select($id);
        if($v['status'] != 1){
            $financing->Cash_save($id,array('endtime' => time(),'status' => 1));
            // D('FinanceCash')->where("id='%d'",$id)->save(array('endtime' => time(),'status' => 1));//更新为提现状态
        }

        // $info   =   $financing->Cash_select(array('id' => $id));
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
    public function cash_review($id){
        $financing = D('FinanceCash');
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $info   =   $financing->where("id=%d", $id)->getField('status');
        return $financing->review_pass($id) ? $this->success($ex[$info].'审核通过') : $this->error($ex[$info].'审核失败或已审核');
    }

    //删除现金融资业务
    public function del_cash($id){
        $financing = D('FinanceCash');
        $financing->Cash_delete($id) ? $this->success('删除成功') : $this->error('删除失败');
        // D('FinanceCard')->where("id='%d'",$id)->delete() ? $this->success('删除成功') : $this->error('删除失败');
    }

    //资金拆借
    public function borrow(){
        $this->display();
    }

    //信用卡融资
    public function fcard(){
        $financing = D('FinanceCard');
        $fc = $financing->Card_select();
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
        $financing = D('FinanceCard');
        if(IS_POST){
            // zecho($_POST);
            $_POST['add']['stype']  =   'card';
            $_POST['add']['startime'] = strtotime($_POST['add']['startime']);
            $financing->add($_POST['add']) ? $this->success('业务添加成功！', U('Home/Financing/fcard')) : $this->error('业务添加失败！');
        } else {
            $this->assign('banks', $this->_G['banks']);
            $this->display();
        }
    }

    //信用卡融资详情
    public function cardinfo($id){
        $financing = D('FinanceCard');
        $ratelog = D('FinanceRatelog');
        $info   =   $financing->Card_select($id);
        $map = array('mobile' => $info['mobile'], 'customer' => $info['customer']);
        $ratelog = $ratelog->Rate_select($map);
        // $ralog = M('finance_ratelog')->where("mobile='%s' AND customer='%s'", array($info['mobile'], $info['customer']))->select();
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
        $financing = D('FinanceCard');
        if(IS_POST){
            // zecho($_POST);
            $_POST['edit']['startime'] = strtotime($_POST['edit']['startime']);
            $_POST['edit']['endtime'] = strtotime($_POST['edit']['endtime']);
            $financing->Card_save($id, $_POST['edit']) ? $this->success('信息修改成功！') : $this->error('信息修改失败！');
        } else {
            $info   =  $financing->Card_select($id);
            $this->assign('banks', $this->_G['banks']);
            $this->assign('ecard',$info);
            $this->display();
        }
    }

    //信用卡融资提现
    public function wcard($id){
        $financing = D('FinanceCard');
        $info = $v = $financing->Card_select($id);
        if($v['status'] != 1){
            $financing->Card_save($id,array('endtime' => time(),'status' => 1));
            // D('FinanceCash')->where("id='%d'",$id)->save(array('endtime' => time(),'status' => 1));//更新为提现状态
        }

        // $info   =   D('FinanceCash')->where("id='%d'", $id)->find();
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $this->assign('kills',$ex);
        $this->assign('banks', $this->_G['banks']);
        $this->assign('wcard',$info);
        $this->display();
    }

    //审核
    public function card_review($id){
        $financing = D('FinanceCard');
        $ko = explode("\n",$this->_G['setting']['fina_status']['svalue']);
        foreach($ko as $k => $v){
            $ex[] = explode("=",$v)[1];
        }
        $info   =   $financing->where("id=%d", $id)->getField('status');
        return $financing->review_pass($id) ? $this->success($ex[$info].'审核通过') : $this->error($ex[$info].'审核失败或已审核');
    }

    //删除信用卡融资业务
    public function del_card($id){
        $financing = D('FinanceCard');
        $financing->Card_delete($id) ? $this->success('删除成功') : $this->error('删除失败');
        // D('FinanceCard')->where("id='%d'",$id)->delete() ? $this->success('删除成功') : $this->error('删除失败');
    }

    //打款计划
    public function rate(){
        $ratelog = D('FinanceRatelog');

        $month  =   I('month') ? intval(I('month')) : date('n');
        $yeah   =   I('yeah') ? intval(I('yeah')) : date('Y');

        $mday   =   mktime(0,0,0,$month,1,$yeah);
        $eday   =   mktime(23, 59, 59, $month, date('t'), $yeah);
        $map['dateline']  = array(array('GT',$mday),array('LT',$eday),'and'); 

        $list = $ratelog->Rate_select($map);
        $this->assign('banks', $this->_G['banks']);
        $this->assign('list', $list);
        $this->display();
    }

    //打款计划生成
    public function rate_build(){
        $fcash  =   D('FinanceCash');
        $fcard  =   D('FinanceCard');
        $ratelog = D('FinanceRatelog');
        
        $mday   =   mktime(0,0,0,date('n'),1,date('Y'));
        $eday   =   mktime(23, 59, 59, date('n'), date('t'), date('Y'));
        $map['dateline']  = array(array('GT',$mday),array('LT',$eday),'and');

        // $fcash = $fcash->Cash_select();
        // $fcard = $fcard->Card_select();
        $fina = array_merge($fcash->Cash_select(), $fcard->Card_select());
        foreach ($fina as $key => $value) {
            if($value['stype'] == 'cash'){
                $ca = $fcash->review_verify($value['id']);
            }
            if ($value['stype'] == 'card') {
                $ca = $fcard->review_verify($value['id']);
            }
            if($ca){
                $map['cashid']  =   $value['id'];
                $map['stype']  =   $value['stype'];
                // zecho($value);
                if(!$ratelog->Rate_select($map)){
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
                    // M('finance_ratelog')->add($value); 
                    // zecho($value); 
                    $ratelog->Rate_add($value);                  
                }

            }
        }
        $this->success('打款计划生成成功', U('home/financing/rate'));
    }

    //返回json数据
    public function rateinfo(){
        $ratelog = D('FinanceRatelog');
        $banks = $this->_G['banks'];
        $json['id']       =   I('id');
        $jso = $ratelog->Rate_select(I('id'));
        // $jso = M('finance_ratelog')->where("id=%d",I('id'))->find();
        $jso['dateline'] = date("Y-m-d",$jso['dateline']);
        $jso['stype'] = $jso['stype'] == 'cash' ? '现金' : ($jso['stype'] == 'card' ? '信用卡' : '空');
        $jso['bankname'] = $banks[$jso['bankname']]['bankname'];
        exit(json_encode($jso));
    }

    //打款状态确认
    public function dorate($id){
        $ratelog = D('FinanceRatelog');
        // zecho($id);
        $data['status'] = '1';
        $ratelog->Rate_save($id, $data) ? $this->success('状态更改为 已打款') : $this->error('打款状态更新失败！');
        // M('finance_ratelog')->where("id='%s'",$id)->save($data) ? $this->success('状态更改为 已打款') : $this->error('打款状态更新失败！');
    }
}