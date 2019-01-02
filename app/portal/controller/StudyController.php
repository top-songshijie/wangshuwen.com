<?php
/**
 * 学无止境(文章详情)
 * Author: xiaojie
 * DateTime: 2018/12/02 10:49
 */
namespace app\portal\controller;

use app\portal\model\ArticleModel;
use cmf\controller\JieBaseController;

class StudyController extends JieBaseController
{
    public function index()
    {
        $articleModel = new ArticleModel();
        $list = $articleModel->getList(1);
        
        $this->assign('list',$list);
        return $this->fetch();
    }

	/**
	 * 文章详情
	 */
    public function detail()
	{
		$id = $this->request->param('id','','intval');
		$articleModel = new ArticleModel();
		$info = $articleModel->getDetail($id);

		$this->assign('info',$info);
		return $this->fetch();
	}
}
