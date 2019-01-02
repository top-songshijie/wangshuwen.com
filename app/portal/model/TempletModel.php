<?php
/**
 * Author: xiaojie
 * DateTime: 2018/12/02 10:29
 */
namespace app\portal\model;

use think\Model;

class TempletModel extends Model
{
	protected $autoWriteTimestamp = true;

	/**
	 * 获取html模板列表
	 * @return false|\PDOStatement|string|\think\Collection
	 */
	public function getList()
	{
		$list = $this
			->field('id,title,thumb,url')
			->order('id DESC')
			->select();
		return $list;
	}

}