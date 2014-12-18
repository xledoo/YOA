<?php

namespace Home\Model;
use Think\Model\RelationModel;

class LoanModel extends RelationModel{

	public $_link = array(
			//借贷人信息 & 房产抵押详情 => 一对一关系
			'pre_loan_housing' =>array(
					'mapping_type' => HAS_ONE,
					'class_name' => 'Pre_loan_housing',
				),
			//借贷人信息 & 车辆抵押详情 => 一对多关系
			'pre_loan_car' =>array(
					'mapping_type' => HAS_MANY,
					'class_name' => 'Pre_loan_car',
					'foreign_key' => 'id',
					'mapping_name' => 'loan_car',
					'mapping_order' => 'create_time desc'
				)
		);
}