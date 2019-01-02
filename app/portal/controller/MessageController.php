<?php
/**
 * 留言板
 * Author: xiaojie
 * DateTime: 2018/12/31 09:40
 */
namespace app\portal\controller;

use cmf\controller\JieBaseController;

class MessageController extends JieBaseController
{
    public function index()
    {
        return $this->fetch();
    }
}
