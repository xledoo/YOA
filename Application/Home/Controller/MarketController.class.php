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
	    	foreach ($_POST['mb'] as $key => $value) {
	    		$_POST['mb'][$key] = substr($value, stripos($value, " ")+1);
	    	}
	        import('Org.Util.SMSender');
	        // $SMS    =   new \Org\Util\SMSender($this->_G['setting']['SMS_USERNAME']['svalue'], $this->_G['setting']['SMS_PASSWORD']['svalue'], $this->_G['setting']['SMS_CHARSET']['svalue'], $this->_G['setting']['SMS_INTERFACE']['svalue']);
	        $SMS    =   new \Org\Util\SMSender(C('SMS_USERNAME'),C('SMS_PASSWORD'),C('SMS_CHARSET'),C('SMS_INTERFACE'));
	        // zecho($SMS->SendSMS('18687444499','dsfff'));
	        foreach($_POST['mb'] as $key => $value){
	        	//$result[] = $SMS->SendSMS($value, $_POST['cont']);
	        	$random     =   random(6, 1);
		        $content    =   '您的手机号：'.$value.'，注册验证码：'.$random.'，一天内提交有效。感谢您的注册！';
		        if(M('admincp_checkmobile')->where("mobile='%s' AND dateline > ".NOW_TIME-300, array($value))->find()){
		            $this->error('验证短信已经发送 请5分钟后重试');
		        } else {
		            M('admincp_checkmobile')->where("mobile='%s'")->delete();
		        }
		        if($result = $SMS->SendSMS($value, $content)){
		            $checkModel =   M('admincp_checkmobile');
		            $data   =   array(
		                'mobile'    =>  $value,
		                'sendip'    =>  get_client_ip(),
		                'dateline'  =>  NOW_TIME   
		            );
		            if($checkModel->add($data)){
		                $smsModel   =   M('admincp_smsender');
		                $data['message'] =  $content;
		                $data['status'] =  ($result['result'] != 0) ? 1 : 0;
		                $data['result'] =  $result['message'];
		                $smsModel->add($data);
		                $this->success('验证短信发送成功,请等待接收');                             
		            }
		        } else {
		            $this->error('验证短信发送失败,请联系管理员');
		        }
		    } 
    	} else {
    		$mb = M('finance_cash')->select();
	    	$this->assign('mb',$mb);
	    	$this->display();
    	}
    }

    //邮件群发
    public function email(){
    	if(IS_POST){
    		import('ORG.Util.Mail');
    		// $mail = new PHPmailer($this->_G['setting']['MAIL_ADDRESS']['svalue'], $this->_G['setting']['MAIL_SMTP']['svalue'], $this->_G['setting']['MAIL_LOGINNAME']['svalue'], $this->_G['setting']['MAIL_PASSWORD']['svalue'], $this->_G['setting']['MAIL_CHARSET']['svalue'], $this->_G['setting']['MAIL_AUTH']['svalue'], $this->_G['setting']['MAIL_HTML']['svalue']);
	    	foreach ($_POST['em'] as $key => $value) {
	    		$_POST['em'][$key] = substr($value, stripos($value, " ")+1);
	    	}
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