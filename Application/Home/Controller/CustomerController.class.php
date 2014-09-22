<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class CustomerController extends BaseController {
	public function clist(){
		$info = M('finance_cash')->select();
		// zecho($info);
		$this->assign('cust',$info);
        $this->assign('banks', $this->_G['banks']);
    	$this->display();
    }

    //删除用户信息
    public function delc($id){
        zecho('您将删除id为 '.$id.' 的用户信息！');
        M('finance_cash')->where("id='%d'",$id)->delete() ? $this->success('删除成功') : $this->error('删除失败');
    }
}