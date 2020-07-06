<?php


namespace app\admin\model;


use app\common\model\BaseModel;

/**
 * 广告-模型
 * @author 牧羊人
 * @since 2020/7/2
 * Class Ad
 * @package app\admin\model
 */
class Ad extends BaseModel
{
    // 设置数据表名
    protected $name = "ad";


    public function getInfo($id)
    {
        $info = parent::getInfo($id); // TODO: Change the autogenerated stub
        if ($info) {
            // 封面
            if ($info['cover']) {
                $info['cover_url'] = get_image_url($info['cover']);
            }

            // 广告类型
            if ($info['type']) {
                $info['type_name'] = config('admin.ad_type')[$info['type']];
            }

            // 广告位
            if ($info['sort_id']) {
                $ad_sort_model = new AdSort();
                $ad_sort_info = $ad_sort_model->getInfo($info['sort_id']);
                $info['sort_name'] = $ad_sort_info['name'] . "=>" . $ad_sort_info['loc_id'];
            }
        }
        return $info;
    }
}