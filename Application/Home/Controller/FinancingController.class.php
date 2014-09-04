<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class FinancingController extends BaseController {
    public function index(){
    	$this->display();
    }

    public function fcash(){
    	$this->display();
    }

    public function fCard(){
    	$this->display();
    }
}