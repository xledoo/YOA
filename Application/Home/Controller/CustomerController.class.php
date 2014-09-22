<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class CustomerController extends BaseController {
	public function clist(){
		$info = M('finance_cash')->select();
		// zecho($info);
		$this->assign('cust',$info);
    	$this->display();
    }

    //删除用户信息
    public function delc($id){
        zecho($id);
        M('finance_cash')->where("id='%d'",$id)->delete() ? $this->success('删除成功') : $this->error('删除失败');
    }
}