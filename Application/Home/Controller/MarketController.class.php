<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class MarketController extends BaseController {
    public function weixin(){
    	$this->display();
    }

    public function sms(){
    	$this->display();
    }

    public function email(){
    	$this->display();
    }
}