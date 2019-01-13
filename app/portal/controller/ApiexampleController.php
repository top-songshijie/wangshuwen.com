<?php
/**
 * api案例
 * Author: xiaojie
 * DateTime: 2019/01/13 13:41
 */
namespace app\portal\controller;

use cmf\controller\JieBaseController;


class ApiexampleController extends JieBaseController
{
	/**
	 * 获取福利图片api
	 */
	public function welfareimages()
	{
		return $this->fetch();
	}


}
