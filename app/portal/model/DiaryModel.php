<?php
/**
 * Author: xiaojie
 * DateTime: 2018/12/02 10:42
 */
namespace app\portal\model;

use think\Model;

class DiaryModel extends Model
{
	protected $autoWriteTimestamp = true;

	/**
	 * 获取个人日记列表
	 * @return false|\PDOStatement|string|\think\Collection
	 */
	public function getList()
	{
		$list = $this
			->field('id,thumb,content,create_time')
			->order('id DESC')
			->select();
		return $list;
	}

}