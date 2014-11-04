<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class LoanController extends BaseController {
    public function add(){
    	if(IS_POST){
    		// zecho($_POST);
    		if($_POST['add_loan'] == 'housing'){
    			$this->redirect('home/loan/add_housing');
    		} elseif ($_POST['add_loan'] == 'car') {
    			$this->redirect('home/loan/add_car');
    		}
    	} else {
            $info = M('loan')->select();
            $this->assign('ad',$info);
    		$this->display();
    	}
    }

    //Add loan of housing.
    public function add_housing(){
        if(IS_POST){
            // zecho($_FILES);
            $_POST['add']['signid'] = $_GET['id'];
            $config = array(
                'maxSize'    =>    3145728,
                'savePath'   =>    './housing/',
                'saveName'   =>    array('uniqid',''),
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub'    =>    true,
                'subName'    =>    array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
                foreach($info as $file){
                    // echo $file['savepath'].$file['savename'];
                    $this->success('文件'.$file['savepath'].$file['savename'].'上传成功！');
                }
            }
            M('loan_housing')->add($_POST['add']) ? $this->success('房产抵押借贷添加成功！') : $this->success('房产抵押借贷添加失败！');
        }else{
            $fd = M('loan_housing')->getDbFields();
            foreach($fd as $key => $value){
                $oo[$value] = M('common_member_profile_setting')->where("fieldid='%s'",$value)->select();
                foreach($oo[$value] as $k => $v){
                    $oo[$value] = $v;
                }
            }
            $this->assign('lv',$oo);
            $this->display();
        }
    }

    //Add loan of car.
    public function add_car(){
        if(IS_POST){
            // zecho($_POST);
            $_POST['add']['signid'] = $_GET['id'];
            $config = array(
                'maxSize'    =>    3145728,
                'savePath'   =>    './car/',
                'saveName'   =>    array('uniqid',''),
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub'    =>    true,
                'subName'    =>    array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
                foreach($info as $file){
                    // echo $file['savepath'].$file['savename'];
                    $this->success('文件'.$file['savepath'].$file['savename'].'上传成功！');
                }
            }
            M('loan_car')->add($_POST['add']) ? $this->success('车辆抵押借贷添加成功！') : $this->success('车辆抵押借贷添加失败！');
        }else{
            $fd = M('loan_car')->getDbFields();
            foreach($fd as $key => $value){
                $oo[$value] = M('common_member_profile_setting')->where("fieldid='%s'",$value)->select();
                foreach($oo[$value] as $k => $v){
                    $oo[$value] = $v;
                }
            }
            $this->assign('lv',$oo);
            $this->display();
        }
    }

    //Edit column of table loan_housing.
    public function add_to_housing(){
    	if(IS_POST){
    		// zecho($_POST);
            foreach($_POST['add_to_housing'] as $key => $value){
                // $vol[] = M()->execute("alter table pre_loan_housing drop column $value");//删除列
                if(!in_array($value,(M('loan_housing')->getDbFields()))){
                    $vol[] = M()->execute("alter table pre_loan_housing add column $value varchar(255) not null");//添加列
                } else{
                    $this->error("字段已存在，请重试！");
                }
            }
            $vol ? $this->success('资料修改成功！') : $this->error('资料修改失败！');
    	}else{
            $pro = M('common_member_profile_setting');
			$count = $pro->count();
            $page = new \Think\Page($count,20);
            $list = $pro->limit($page->firstRow.','.$page->listRows)->select();
            $page->setConfig('first', '首页');//第一页
            $page->setConfig('prev', '上一页');//上一页
            $page->setConfig('next', '下一页');//下一页
            $page->setConfig('last', '末页');//最后一页
            $page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $show = $page->show();
            $this->assign('list',$list);
            $this->assign('show',$show);
	    	$this->display();
    	}
    }

    //Edit column of table loan_car.
    public function add_to_car(){
        if(IS_POST){
            // zecho($_POST);
            foreach($_POST['add_to_car'] as $key => $value){
                // $vol[] = M()->execute("alter table pre_loan_car drop column $value");//删除列
                if(!in_array($value,(M('loan_car')->getDbFields()))){
                    $vol[] = M()->execute("alter table pre_loan_car add column $value varchar(255) not null");//添加列
                } else{
                    $this->error("字段已存在，请重试！");
                }
            }
            $vol ? $this->success('资料修改成功！') : $this->error('资料修改失败！');
        }else{
            $pro = M('common_member_profile_setting');
            $count = $pro->count();
            $page = new \Think\Page($count,20);
            $list = $pro->limit($page->firstRow.','.$page->listRows)->select();
            $page->setConfig('first', '首页');//第一页
            $page->setConfig('prev', '上一页');//上一页
            $page->setConfig('next', '下一页');//下一页
            $page->setConfig('last', '末页');//最后一页
            $page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $show = $page->show();
            $this->assign('list',$list);
            $this->assign('show',$show);
            $this->display();
        }
    }

    //Edit options of table common_member_profile_seting
    public function edit_options($fieldid = ""){
        if(IS_POST){
            // zecho($_POST);
            M('common_member_profile_setting')->where("fieldid='%s'",$_POST['edit']['fieldid'])->save($_POST['edit']) ? $this->success('资料修改成功！') : $this->error('资料修改失败！');
        }else{
            $info = M('common_member_profile_setting')->where("fieldid='%s'",$fieldid)->select();
            $this->assign('eo',$info);
            $this->display();
        }
    }

    //Add options from table common_member_profile_seting
    public function add_options(){
        if(IS_POST){
            // zecho($_POST);
            M('common_member_profile_setting')->add($_POST['add']) ? $this->success('资料添加成功！') : $this->error('资料添加失败！');
        }else{
            $this->display();
        }
    }

    //List of all loan.
    public function llist(){
        $this->display();
    }
}