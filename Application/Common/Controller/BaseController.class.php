<?php
/*
所有控制器的基类
Date: 20140803
Author: xledoo
*/
namespace Common\Controller;
use Think\Controller;

class BaseController extends Controller{

	/*
	全局变量用于保存登录及配置信息
	*/
	var $_G	=	array();

	/*
	系统自动初始化全局变量
	*/
	function _initialize(){
		self::init_setting();
		self::init_member();
		self::init_sidebar();

		$this->assign('sidebar', $this->_G['sidebar']);
		$this->assign('setting', $this->_G['setting']);
	}
	
	/*
	初始化系统参数设置项目
	*/
	function init_setting(){
		$setting = M('common_setting')->cache('setting',60)->select();
		foreach ($setting as $key => $value) {
			$this->_G['setting'][$value['skey']] = $value;
		}
	}

	/*
	用户登录信息
	*/
	function init_member(){
		
	}

	/*
	初始化菜单栏信息
	*/
	function init_sidebar(){
    	$sidebar = M('admincp_sidebar')->cache('sidebar', 60)->select();
    	foreach($sidebar as $key => $value) {
    		if($value['upid']	==	0){
    			$this->_G['sidebar'][$value['controller']]	=	$value;
    		} else {
    			$submenu[$value['controller']][]	=	$value;
    		}
    		foreach ($submenu[$value['controller']] as $k => $v) {
    			$this->_G['sidebar'][$value['controller']]['submenu'][$v['action']]	=	$v;
    		}
    		unset($submenu);
    		$this->_G['sidebar'][$value['controller']]['submenu'] = array_sort($this->_G['sidebar'][$value['controller']]['submenu'], 'displayorder', 'asc');
    	}
    	$this->_G['sidebar']	=	array_sort($this->_G['sidebar'], 'displayorder', 'asc');
		return $this->_G['sidebar'];
	}
}


?>