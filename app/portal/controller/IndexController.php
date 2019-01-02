<?php
/**
 * 个人博客首页
 * Author: xiaojie
 * DateTime: 2018/12/02 09:50
 */
namespace app\portal\controller;

use app\portal\model\ArticleModel;
use cmf\controller\JieBaseController;

class IndexController extends JieBaseController
{


    public function index()
    {
        $articleModel = new ArticleModel();
		//获取首页banner
		$banner = $this->getSlide(1);

        //最新发布
        $list = $articleModel->getList();

        //1杯浊酒
        $list2 = $articleModel->getHitsList(1);

		//热门素材
		$list3 = $articleModel->getHitsList(2);

        $this->assign('banner',$banner);
        $this->assign('list',$list);
        $this->assign('list2',$list2);
        $this->assign('list3',$list3);
        return $this->fetch(':index');
    }

}
