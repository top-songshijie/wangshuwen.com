<?php
/**
 * 文章部分
 * Author: xiaojie
 * DateTime: 2018/12/31 09:20
 */
namespace app\portal\controller;

use app\portal\model\ArticleModel;
use app\portal\model\HitsModel;
use cmf\controller\JieBaseController;
use think\Db;

class ArticleController extends JieBaseController
{

	/**
	 * 一杯浊酒
	 */
	public function index()
	{
		$articleModel = new ArticleModel();
		//最新发布
		$list = $articleModel->getList(1);
		//浏览排行
		$list2 = $articleModel->getHitsList(1);
		//文章总数
		$count = $articleModel->getCount(1);

		$this->assign('list',$list);
		$this->assign('list2',$list2);
		$this->assign('count',$count);
		return $this->fetch();
	}

	/**
	 * 素材模板
	 */
	public function index2()
	{
		$articleModel = new ArticleModel();
		//最新发布
		$list = $articleModel->getList(2);
		//浏览排行
		$list2 = $articleModel->getHitsList(2);
		//文章总数
		$count = $articleModel->getCount(2);

		$this->assign('list',$list);
		$this->assign('list2',$list2);
		$this->assign('count',$count);
		return $this->fetch();
	}

    /**
     * Python爬虫学习之路
     */
    public function index3()
    {
        $articleModel = new ArticleModel();
        //最新发布
        $list = $articleModel->getList(3);
        //浏览排行
        $list2 = $articleModel->getHitsList(3);
        //文章总数
        $count = $articleModel->getCount(3);

        $this->assign('list',$list);
        $this->assign('list2',$list2);
        $this->assign('count',$count);
        return $this->fetch();
    }

	/**
	 * 文章详情
	 */
	public function detail()
	{
		$id = $this->request->param('id','','intval');
		$hitsModel = new HitsModel();
		$articleModel = new ArticleModel();
		//记录
		Db::startTrans();
		$res = $articleModel->where('id',$id)->setInc('hits',1);
		$res2 = $hitsModel->save([
			'article_id' => $id,
			'user_ip' => $this->request->ip(),
		]);
		if(!$res or !$res2){
			Db::rollback();
		}else{
			Db::commit();
		}

		//查询
		$info = $articleModel->getDetail($id);

		//推荐
		$list = $articleModel->getList('',1);

		$this->assign('info',$info);
		$this->assign('list',$list);
		return $this->fetch();
	}


    /**
     * 分页ajax
     */
	public function page()
    {
        $param = $this->request->param();
        $articleModel = new ArticleModel();
        //最新发布
        $list = $articleModel->getPageList($param['cate_id'],$param['page'],$param['num']);
        if(empty($list)){
			$this->apiResponse(0,'获取数据成功');
		}
		$this->apiResponse(1,'获取数据成功',$list);
    }
}
