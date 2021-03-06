<?php
/**
 * Python爬虫学习之路
 * Author: xiaojie
 * DateTime: 2019/01/10 09:14
 */
namespace app\portal\controller;

use app\portal\model\ArticleModel;
use app\portal\model\CateModel;
use cmf\controller\AdminJieBaseController;


class AdminPythonController extends AdminJieBaseController
{

	/**
	 * Python爬虫学习之路
	 * @adminMenu(
	 *     'name'   => 'Python爬虫学习之路',
	 *     'parent' => 'portal/AdminArticle/default',
	 *     'display'=> true,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => 'Python爬虫学习之路',
	 *     'param'  => ''
	 * )
	 */
	public function index()
	{
		$articleModel = new ArticleModel();
		$list = $articleModel
			->alias('a')
			->field('c.cate_name,a.*')
			->join('cate c','c.id = a.cate_id')
			->where('a.cate_id',3)
			->order('a.id DESC')
			->paginate(20);

		$this->assign('list',$list);
		$this->assign('page',$list->render());
		return $this->fetch();
	}

	/**
	 * 添加
	 * @adminMenu(
	 *     'name'   => '添加',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '添加',
	 *     'param'  => ''
	 * )
	 */
	public function add()
	{

		return $this->fetch();
	}

	/**
	 * 添加提交
	 * @adminMenu(
	 *     'name'   => '添加提交',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '添加提交',
	 *     'param'  => ''
	 * )
	 */
	public function addPost()
	{
		$param = $this->request->param();
		$articleModel = new ArticleModel();

		$param['cate_id'] = 3;
		$res = $articleModel->save($param);
		if($res){
			$this->success('添加成功');
		}
	}

	/**
	 * 编辑
	 * @adminMenu(
	 *     'name'   => '编辑',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '编辑',
	 *     'param'  => ''
	 * )
	 */
	public function edit()
	{
		$id = $this->request->param('id','','intval');
		$articleModel = new ArticleModel();
		$info = $articleModel->where('id',$id)->find();

		$this->assign('info',$info);
		return $this->fetch();
	}

	/**
	 * 编辑提交
	 * @adminMenu(
	 *     'name'   => '编辑提交',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '编辑提交',
	 *     'param'  => ''
	 * )
	 */
	public function editPost()
	{
		$param = $this->request->param();
		$articleModel = new ArticleModel();
		$param['is_recommend'] = isset($param['is_recommend'])?$param['is_recommend']:0;
		$res = $articleModel->isUpdate(true)->save($param);
		if($res){
			$this->success('更新成功');
		}
	}

	/**
	 * 删除
	 * @adminMenu(
	 *     'name'   => '删除',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '删除',
	 *     'param'  => ''
	 * )
	 */
	public function delete()
	{
		$id = $this->request->param('id','','intval');
		$articleModel = new ArticleModel();
		$res = $articleModel->where('id',$id)->delete();
		if($res){
			$this->success('删除成功	');
		}
	}

}

