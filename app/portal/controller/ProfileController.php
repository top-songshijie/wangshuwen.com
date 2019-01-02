<?php
/**
 * 个人简历
 * Author: xiaojie
 * DateTime: 2018/12/02 11:04
 */
namespace app\portal\controller;

use app\portal\model\ProfileModel;
use cmf\controller\JieBaseController;

class ProfileController extends JieBaseController
{
    public function index()
    {
    	$profileModel = new ProfileModel();
    	$list = $profileModel->getList();

    	$this->assign('list',$list);
        return $this->fetch();
    }
}
