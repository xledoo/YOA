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
	        $SMS    =   new \Org\Util\SMSender($this->_G['setting']['SMS_USERNAME']['svalue'], $this->_G['setting']['SMS_PASSWORD']['svalue'], $this->_G['setting']['SMS_CHARSET']['svalue'], $this->_G['setting']['SMS_INTERFACE']['svalue']);
	        foreach($_POST['mb'] as $key => $value){
	        	$result[] = $SMS->SendSMS($value, $_POST['cont']);
	        }
	        $result ? $this->success('短信发送成功！') : $this->error('短信发送失败！');

    	} else {
    		$mb = M('finance_cash')->select();
	    	$this->assign('mb',$mb);
	    	$this->display();
    	}
    }

    //邮件群发
    public function email(){
    	if(IS_POST){
    		zecho($this->_G['setting']);
    		import('ORG.Util.Mail');
    		// $mail = new PHPmailer($this->_G['setting']['MAIL_ADDRESS']['svalue'], $this->_G['setting']['MAIL_SMTP']['svalue'], $this->_G['setting']['MAIL_LOGINNAME']['svalue'], $this->_G['setting']['MAIL_PASSWORD']['svalue'], $this->_G['setting']['MAIL_CHARSET']['svalue'], $this->_G['setting']['MAIL_AUTH']['svalue'], $this->_G['setting']['MAIL_HTML']['svalue']);
    		foreach ($_POST['em'] as $key => $value) {
    			$result[] = SendMail($value,$_POST['title'],$_POST['cont'],$_POST['sign']);
    		}
    		$result ? $this->success('邮件发送成功！') : $this->error('邮件发送失败！');
    	} else {
    		$em = M('common_customer')->select();
	    	$this->assign('em',$em);
    		$this->display();
    	}
    }
}