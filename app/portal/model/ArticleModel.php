<?php
/**
 * Author: xiaojie
 * DateTime: 2018/12/02 10:02
 */
namespace app\portal\model;

use think\Model;

class ArticleModel extends Model
{
	protected $autoWriteTimestamp = true;

	/**
	 * thumb 自动转化
	 * @param $value
	 * @return string
	 */
	public function getThumbAttr($value)
	{
		if(empty($value)){
			return 'http://person.wangshuwen.com/1539956962.jpg';
		}
		return cmf_get_asset_url($value);
	}

	/**
	 * post_content 自动转化
	 * @param $value
	 * @return string
	 */
	public function getContentAttr($value)
	{
		return cmf_replace_content_file_url(htmlspecialchars_decode($value));
	}

	/**
	 * post_content 自动转化
	 * @param $value
	 * @return string
	 */
	public function setContentAttr($value)
	{
		return htmlspecialchars(cmf_replace_content_file_url(htmlspecialchars_decode($value), true));
	}

    /**
     * create_time 自动转化
     * @param $value
     * @return string
     */
    public function getCreateTimeAttr($value)
    {
        return date('Y-m-d H:i',$value);
    }

	/**
	 * 获取文章列表
	 * @param int $cate_id 所属分类
	 * @param int $is_recommend 是否推荐
	 * @return false|\PDOStatement|string|\think\Collection
	 */
	public function getList($cate_id = 0 , $is_recommend = 0 )
	{
		if($cate_id){
			$map['a.cate_id'] = $cate_id;
		}
		if($is_recommend){
			$map['a.is_recommend'] = $is_recommend;
		}
		$map['delete_time'] = 0;
		$list = $this
			->alias('a')
			->field('a.id,a.title,a.briefcontent,a.thumb,a.create_time,a.hits,a.comment_num,c.cate_name')
			->join('__CATE__ c','c.id = a.cate_id')
			->where($map)
            ->page(1,10)
			->order('a.is_recommend DESC,a.id DESC')
			->select();
		return $list;
	}

    /**
     * 根据浏览量获取文章列表
     * @param int $cate_id 所属分类
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getHitsList($cate_id = 0)
    {
        if($cate_id){
            $map['a.cate_id'] = $cate_id;
        }

        $map['delete_time'] = 0;
        $list = $this
            ->alias('a')
            ->field('a.id,a.title,a.briefcontent,a.thumb,a.create_time,a.hits,a.comment_num,c.cate_name')
            ->join('__CATE__ c','c.id = a.cate_id')
            ->where($map)
            ->order('a.hits DESC')
            ->limit(5)
            ->select();
        return $list;
    }

	/**
	 * 获取文章详情
	 * @param $id 文章id
	 * @return array|false|\PDOStatement|string|Model
	 */
	public function getDetail($id)
	{
		$info = $this
			->alias('a')
			->field('a.id,a.title,a.author,a.content,a.briefcontent,a.create_time,a.hits,a.comment_num,c.cate_name')
			->join('cate c','c.id = a.cate_id')
			->where('a.id',$id)
			->find();
		return $info;
	}

    /**
     * 分页获取文章列表
     * @param int $cate_id 所属分类
     * @param int $page 所属分类
     * @param int $num 所属分类
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getPageList($cate_id = 0 , $page = 1 ,$num = 10)
    {
        if($cate_id){
            $map['a.cate_id'] = $cate_id;
        }
        $map['delete_time'] = 0;
        $list = $this
            ->alias('a')
            ->field('a.id,a.title,a.briefcontent,a.thumb,a.create_time,a.hits,a.comment_num,c.cate_name')
            ->join('__CATE__ c','c.id = a.cate_id')
            ->where($map)
            ->page($page,$num)
            ->order('a.is_recommend DESC,a.id DESC')
            ->select()->toArray();
        return $list;
    }

	/**
	 * 获取某分类下文章总数
	 * @param $cate_id
	 * @return int|string
	 */
    public function getCount($cate_id)
	{
		$count = $this->where([
			'delete_time' => 0,
			'cate_id' => $cate_id
		])->count();
		return $count;
	}

}