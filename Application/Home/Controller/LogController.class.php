<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class LogController extends BaseController {

    public function login(){
    	$this->display();
    }

    public function behavior(){
    	$this->display();
    }

    public function auditing(){
    	$this->display();
    }
}