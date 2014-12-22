<?php

namespace Home\Model;

use Think\Model;

class FinanceCardModel extends Model {
	protected $tableName = 'finance_card';
	public function dselect(){
		return $this->select();
	}
	/*
	通过审核
	*/
	function review_pass($id){
		$fina = $this->where("id='$id'", $id)->find();
		unset($fina['verify']);
		return $this->where("id='$id'", $id)->save(array('verify' => array_md5($fina)));
	}
	/*
	验证审核
	*/
	function review_verify($id){
		$fina = $this->where("id='$id'", $id)->find();
		$temp = $fina;
		unset($temp['verify']);
		return array_md5($temp) == $fina['verify'] ? true : false;	
	}
}


?>