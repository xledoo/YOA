<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class MarketController extends BaseController {
	//微信平台
    public function weixin(){
    	$this->display();
    }

    //短信群发
    public function sms(){
    	if(IS_POST){
    		// zecho($_POST);
	    	foreach ($_POST['mb'] as $key => $value) {
	    		$_POST['mb'][$key] = substr($value, -11);
	    	}
	    	zecho($_POST);

	        import('Org.Util.SMSender');
	        $SMS    =   new \Org\Util\SMSender(C('SMS_USERNAME'),C('SMS_PASSWORD'),C('SMS_CHARSET'),C('SMS_INTERFACE'));
	        foreach($_POST['mb'] as $key => $value){
	        	$result[] = $SMS->SendSMS($value, $_POST['cont']);
	        }
	        if($result){
	        	echo ("短信群发成功！");
	        } 

    	} else {
    		$mb = M('finance_cash')->select();
	    	$this->assign('mb',$mb);
	    	$this->display();
    	}
    }

    //邮箱群发
    public function email(){
    	$this->display();
    }
}