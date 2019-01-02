<?php
/**
 * 个人日记
 * Author: xiaojie
 * DateTime: 2018/12/16 20:16
 */
namespace app\portal\controller;

use app\portal\model\ArticleModel;
use app\portal\model\DiaryModel;
use cmf\controller\AdminJieBaseController;

class AdminDiaryController extends AdminJieBaseController
{

	/**
	 * 个人日记
	 * @adminMenu(
	 *     'name'   => '个人日记',
	 *     'parent' => 'portal/AdminWrite/default',
	 *     'display'=> true,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '个人日记',
	 *     'param'  => ''
	 * )
	 */
	public function index()
	{
		$diary = new DiaryModel();
		$list = $diary->order('id DESC')->paginate(30);

		$this->assign('page',$list->render());
		$this->assign('list',$list);
		return $this->fetch();
	}

	/**
	 * 添加个人日记
	 * @adminMenu(
	 *     'name'   => '添加个人日记',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '添加个人日记',
	 *     'param'  => ''
	 * )
	 */
	public function add()
	{
		return $this->fetch();
	}

	/**
	 * 添加个人日记提交
	 * @adminMenu(
	 *     'name'   => '添加个人日记提交',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '添加个人日记提交',
	 *     'param'  => ''
	 * )
	 */
	public function addPost()
	{
		$param = $this->request->param();
		$diary = new DiaryModel();
		$param['create_time'] = time();
		$param['update_time'] = time();
		$res = $diary->insert($param);
		if($res){
			$this->success('添加成功');
		}
	}

	/**
	 * 编辑个人日记
	 * @adminMenu(
	 *     'name'   => '编辑个人日记',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> true,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '编辑个人日记',
	 *     'param'  => ''
	 * )
	 */
	public function edit()
	{
		$id = $this->request->param('id','intval','');
		$diary = new DiaryModel();
		$info = $diary->find($id);

		$this->assign('info',$info);
		return $this->fetch();
	}

	/**
	 * 编辑个人日记提交
	 * @adminMenu(
	 *     'name'   => '编辑个人日记提交',
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
		$diary = new DiaryModel();
		$res = $diary->where('id',$param['id'])->data([
			'thumb' => $param['thumb'],
			'source' => $param['source'],
			'content' => $param['content'],
			'update_time' => time(),
		])->update();
		if($res){
			$this->success('内容已更新');
		}
	}

	/**
	 * 删除个人日记
	 * @adminMenu(
	 *     'name'   => '删除个人日记',
	 *     'parent' => 'index',
	 *     'display'=> false,
	 *     'hasView'=> false,
	 *     'order'  => 10000,
	 *     'icon'   => '',
	 *     'remark' => '删除个人日记',
	 *     'param'  => ''
	 * )
	 */
	public function delete()
	{
		$id = $this->request->param('id','','intval');
		$diary = new DiaryModel();
		$res = $diary->where('id',$id)->delete();
		if($res){
			$this->success('删除成功');
		}
	}

}

