<?php
/**
 * 模板展示
 * Author: xiaojie
 * DateTime: 2018/12/16 20:31
 */
namespace app\portal\controller;

use app\portal\model\ArticleModel;
use app\portal\model\CateModel;
use app\portal\model\TempletModel;
use cmf\controller\AdminJieBaseController;

/**
 * Class AdminTempletController
 * @package app\portal\controller
 * @adminMenuRoot(
 *     'name'   =>'模板展示',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 10000,
 *     'icon'   =>'coffee',
 *     'remark' =>'模板展示'
 * )
 */

class AdminTempletController extends AdminJieBaseController
{

	/**
	 * 模板展示
	 * @adminMenu(
	 *     'name'   => '模板展示',
	 *     'parent' => 'portal/AdminTemplet/default',
	 *     'display'=> true,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '模板展示',
	 *     'param'  => ''
	 * )
	 */
	public function index()
	{
		$templetModel = new TempletModel();
		$list = $templetModel
			->where('delete_time',0)
			->order('id DESC')
			->paginate(20);

		$this->assign('list',$list);
		$this->assign('page',$list->render());
		return $this->fetch();
	}

	/**
	 * 添加模板展示
	 * @adminMenu(
	 *     'name'   => '添加模板展示',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '添加模板展示',
	 *     'param'  => ''
	 * )
	 */
	public function add()
	{
		return $this->fetch();
	}

	/**
	 * 添加模板展示提交
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
		$templetModel = new TempletModel();
		$param = $this->request->param();
		$res = $templetModel->save($param);
		if($res){
			$this->success('添加成功');
		}
	}

	/**
	 * 编辑模板展示
	 * @adminMenu(
	 *     'name'   => '编辑模板展示',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '编辑模板展示',
	 *     'param'  => ''
	 * )
	 */
	public function edit()
	{
		$templetModel = new TempletModel();
		$id = $this->request->param('id','','intval');
		$info = $templetModel->where('id',$id)->find();

		$this->assign('info',$info);
		return $this->fetch();
	}

	/**
	 * 编辑模板展示提交
	 * @adminMenu(
	 *     'name'   => '编辑模板展示提交',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '编辑模板展示提交',
	 *     'param'  => ''
	 * )
	 */
	public function editPost()
	{
		$templetModel = new TempletModel();
		$param = $this->request->param();
		$res = $templetModel->isUpdate(true)->save($param);
		if($res){
			$this->success('更新成功');
		}
	}

	/**
	 * 删除模板展示
	 * @adminMenu(
	 *     'name'   => '删除模板展示',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '删除模板展示',
	 *     'param'  => ''
	 * )
	 */
	public function delete()
	{
		$templetModel = new TempletModel();
		$id = $this->request->param('id','','intval');
		$res = $templetModel->where('id',$id)->setField('delete_time',time());
		if($res){
			$this->success('删除成功');
		}
	}

}

