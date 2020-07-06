<?php


namespace app\admin\controller;


use app\admin\service\AdSortService;
use app\common\controller\Backend;
use think\facade\View;

/**
 * 广告位-控制器
 * @author 牧羊人
 * @since 2020/7/2
 * Class Adsort
 * @package app\admin\controller
 */
class Adsort extends Backend
{
    /**
     * 初始化
     * @author 牧羊人
     * @since 2020/7/2
     */
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->model = new \app\admin\model\AdSort();
        $this->service = new AdSortService();
    }

    /**
     *
     * @return mixed
     * @since 2020/7/2
     * @author 牧羊人
     */
    public function edit()
    {
        // 广告平台列表
        View::assign("platformList", config("admin.ad_platform"));
        return parent::edit(); // TODO: Change the autogenerated stub
    }
}