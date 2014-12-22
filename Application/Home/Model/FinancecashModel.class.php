<?php

namespace Home\Model;

use Think\Model;

class FinanceCashModel extends Model {

	protected $tableName = 'finance_cash';

	public function Cash_select($map = array()){
		if($map){
			$result = $this->where($map)->select();
		} else {
			$result = $this->select();
		}
		return $result;
	}

	public function Cash_add($map = array()){
		return $this->add($map);
	}

	public function Cash_update($map = array()){
		return $this->save($map);
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