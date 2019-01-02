<?php
/**
 * 留言板
 * Author: xiaojie
 * DateTime: 2018/12/02 11:00
 */
namespace app\portal\controller;

use cmf\controller\JieBaseController;

class PutwordsController extends JieBaseController
{
    public function index()
    {
        return $this->fetch();
    }
}
