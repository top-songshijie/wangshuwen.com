<?php
/**
 * 个人日记
 * Author: xiaojie
 * DateTime: 2018/12/02 10:41
 */
namespace app\portal\controller;

use app\portal\model\DiaryModel;
use cmf\controller\JieBaseController;

class DiaryController extends JieBaseController
{
    public function index()
    {
        $diaryModel = new DiaryModel();
		$list = $diaryModel->getList();

        $this->assign('list',$list);
        return $this->fetch();
    }
}
