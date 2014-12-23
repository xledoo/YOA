<?php

namespace Home\Model;

use Think\Model;

class FinanceRatelogModel extends Model {

	protected $tableName = 'finance_ratelog';

	//获取打款信息
	public function Rate_select($para = ''){
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

	//添加打款信息
	public function Rate_add($map = ''){
		if($map){
			return $this->add($map);
		} else {
			return false;
		}
	}

	//更新打款信息
	public function Rate_save($para = '', $map = ''){
		if($map){
			if($para){
				return $result = $this->where("id='%d'", $para)->save($map);
			}
		} else {
			return false;
		}

	}

	//删除打款信息
	public function Rate_delete($para = ''){
		if($para){
			return $result = $this->where("id='%d'", $para)->delete();
		} else {
			return false;
		}
	}
}


?>