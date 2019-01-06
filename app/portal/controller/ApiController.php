<?php
/*
 * api
 * By: Phpstorm
 * Author: xiaojie
 * Datetime: 2019/01/05 23:17
 */
namespace api\home\controller;

use cmf\controller\RestBaseController;
use yupoxiong\region\Region;

/**
 * @title 开源api
 * @description 接口说明
 */

class ApiController extends RestBaseController
{

	/**
	 * @title 测试demo接口
	 * @description 接口说明
	 * @author 开发者
	 * @url /api/home/index/getRegion
	 * @method GET
	 *
	 * @return name:名称
	 */
	public function getRegion()
	{
		echo "<pre />";
		print_r(2);
		die();
		$region = new Region();
		$data = $region->getRegion();
		$this->success('获取数据成功',$data);
	}

}
