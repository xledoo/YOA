<?php

namespace Home\Model;

use Think\Model;

class FinanceCardModel extends Model {

	protected $tableName = 'finance_card';

	//获取信用卡融资信息
	public function Card_select($para = ''){
		// if(!empty($map)){
			if($para){
				if(is_array($para)){
					$result = $this->where($para)->select();
				} else {
					$result = $this->where("id='%d'", $para)->find();
				}
			} else {
				$result = $this->select();
			}
			return $result;
		// } else {
		// 	return false;
		// }
	}

	//添加信用卡融资信息
	public function Card_add($map = ''){
		if($map){
			return $this->add($map);
		} else {
			return false;
		}
	}

	//更新信用卡融资信息
	public function Card_save($para = '', $map = ''){
		if($map){
			if($para){
				return $result = $this->where("id='%d'", $para)->save($map);
			}
		} else {
			return false;
		}

	}

	//删除信用卡融资信息
	public function Card_delete($para = ''){
		if($para){
			return $result = $this->where("id='%d'", $para)->delete();
		} else {
			return false;
		}
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