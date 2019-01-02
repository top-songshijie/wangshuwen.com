<?php
/**
 * Author: xiaojie
 * DateTime: 2018/12/02 11:06
 */
namespace app\portal\model;

use think\Model;

class ProfileModel extends Model
{
	protected $autoWriteTimestamp = true;

	/**
	 * 获取项目列表
	 * @return false|\PDOStatement|string|\think\Collection
	 */
	public function getList()
	{
		$list = $this->where('is_show',1)->order('sort ASC')->select();
		return $list;
	}

}