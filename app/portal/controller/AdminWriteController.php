<?php
/**
 * 文章相关
 * Author: xiaojie
 * DateTime: 2018/12/02 20:45
 */
namespace app\portal\controller;

use app\portal\model\ArticleModel;
use app\portal\model\CateModel;
use cmf\controller\AdminJieBaseController;

/**
 * Class AdminWriteController
 * @package app\portal\controller
 * @adminMenuRoot(
 *     'name'   =>'文章管理',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 10000,
 *     'icon'   =>'coffee',
 *     'remark' =>'文章管理'
 * )
 */

class AdminWriteController extends AdminJieBaseController
{

	/**
	 * 文章列表
	 * @adminMenu(
	 *     'name'   => '文章管理',
	 *     'parent' => 'portal/AdminWrite/default',
	 *     'display'=> true,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '文章列表',
	 *     'param'  => ''
	 * )
	 */
	public function index()
	{
		$articleModel = new ArticleModel();
		$cateModel = new CateModel();
		$cate_list = $cateModel
			->field('id,cate_name')
			->select();
		$list = $articleModel
			->alias('a')
			->field('c.cate_name,a.*')
			->join('cate c','c.id = a.cate_id')
			->order('a.id DESC')
			->paginate(20);

		$this->assign('list',$list);
		$this->assign('cate_list',$cate_list);
		$this->assign('page',$list->render());
		return $this->fetch();
	}

	/**
	 * 添加文章
	 * @adminMenu(
	 *     'name'   => '添加文章',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '添加文章',
	 *     'param'  => ''
	 * )
	 */
	public function add()
	{
		$cateModel = new CateModel();
		$cate_list = $cateModel
			->field('id,cate_name')
			->select();

		$this->assign('cate_list',$cate_list);
		return $this->fetch();
	}

	/**
	 * 添加文章提交
	 * @adminMenu(
	 *     'name'   => '添加文章提交',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '添加文章提交',
	 *     'param'  => ''
	 * )
	 */
	public function addPost()
	{
		$param = $this->request->param();
		$articleModel = new ArticleModel();
		$res = $articleModel->save($param);
		if($res){
			$this->success('添加成功');
		}
	}

	/**
	 * 编辑文章
	 * @adminMenu(
	 *     'name'   => '编辑文章',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '编辑文章',
	 *     'param'  => ''
	 * )
	 */
	public function edit()
	{
		$id = $this->request->param('id','','intval');
		$cateModel = new CateModel();
		$articleModel = new ArticleModel();
		$cate_list = $cateModel
			->field('id,cate_name')
			->select();
		$info = $articleModel->where('id',$id)->find();

		$this->assign('info',$info);
		$this->assign('cate_list',$cate_list);
		return $this->fetch();
	}

	/**
	 * 编辑文章提交
	 * @adminMenu(
	 *     'name'   => '编辑文章提交',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '编辑文章提交',
	 *     'param'  => ''
	 * )
	 */
	public function editPost()
	{
		$param = $this->request->param();
		$articleModel = new ArticleModel();
		$res = $articleModel->isUpdate(true)->save($param);
		if($res){
			$this->success('更新成功');
		}
	}

	/**
	 * 删除文章
	 * @adminMenu(
	 *     'name'   => '删除文章',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '删除文章',
	 *     'param'  => ''
	 * )
	 */
	public function delete()
	{
		$id = $this->request->param('id','','intval');
		$articleModel = new ArticleModel();
		$res = $articleModel->where('id',$id)->delete();
		if($res){
			$this->success('删除成功');
		}
	}

}

