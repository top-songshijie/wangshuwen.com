<?php
/**
 * html模板展示页面
 * Author: xiaojie
 * DateTime: 2018/12/02 10:29
 */
namespace app\portal\controller;

use app\portal\model\TempletModel;
use cmf\controller\JieBaseController;

class TempletController extends JieBaseController
{
    public function index()
    {
        $templetModel = new TempletModel();
        $list = $templetModel->getList();

        $this->assign('list',$list);
        return $this->fetch();
    }
}
