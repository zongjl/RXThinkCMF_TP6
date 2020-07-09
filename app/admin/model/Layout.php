<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2020 南京RXThinkCMF研发中心
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <1175401194@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\model;


use app\common\model\BaseModel;

/**
 * 布局-模型
 * @author 牧羊人
 * @since 2020/7/2
 * Class Layout
 * @package app\admin\model
 */
class Layout extends BaseModel
{
    // 设置数据表名
    protected $name = "layout";

    /**
     * 获取缓存信息
     * @param int $id
     * @return \app\common\model\数据信息|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @author 牧羊人
     * @since 2020/7/2
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id); // TODO: Change the autogenerated stub
        if ($info) {
            // 获取图片
            if ($info['image']) {
                $info['image_url'] = get_image_url($info['image']);
            }

            // 类型名称
            if ($info['type']) {
                $info['type_name'] = config('admin.layout_type')[$info['type']];
            }

            // 推荐类型
            if ($info['type'] == 1) {
                // CMS文章

            } else {
                // TODO...
            }

            // 页面位置
            if ($info['item_id']) {
                $itemModel = new Item();
                $itemInfo = $itemModel->getInfo($info['item_id']);
                $info['item_name'] = $itemInfo['name'];
            }

            // 页面编号
            $layoutDescModel = new LayoutDesc();
            $layoutDescInfo = $layoutDescModel->where([
                'item_id' => $info['item_id'],
                'loc_id' => $info['loc_id'],
            ])->find();
            if ($layoutDescInfo) {
                $info['loc_name'] = $layoutDescInfo['loc_desc'] . "=>" . $layoutDescInfo['loc_id'];
            }
        }
        return $info;
    }
}