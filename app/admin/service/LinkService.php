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

namespace app\admin\service;


use app\admin\model\Link;
use app\common\service\BaseService;

/**
 * 友链管理-服务类
 * @author 牧羊人
 * @since 2020/7/2
 * Class LinkService
 * @package app\admin\service
 */
class LinkService extends BaseService
{
    /**
     * 构造函数
     * @author 牧羊人
     * @since 2020/7/2
     * LinkService constructor.
     */
    public function __construct()
    {
        $this->model = new Link();
    }

    /**
     * 获取数据列表
     * @return array
     * @since 2020/7/2
     * @author 牧羊人
     */
    public function getList()
    {
        $param = request()->param();
        // 查询条件
        $map = [];
        // 友链类型
        $type = isset($param['type']) ? (int)$param['type'] : 0;
        if ($type) {
            $map[] = ['type', '=', $type];
        }
        // 友链平台
        $platform = isset($param['platform']) ? (int)$param['platform'] : 0;
        if ($platform) {
            $map[] = ['platform', '=', $platform];
        }
        return parent::getList($map); // TODO: Change the autogenerated stub
    }

    /**
     * 添加或编辑
     * @return array
     * @since 2020/7/2
     * @author 牧羊人
     */
    public function edit()
    {
        $data = request()->param();
        $image = trim($data['image']);
        $form = (int)$data['form'];
        //字段验证
        if (!$data['id'] && $form == 2 && !$image) {
            return message('请上传图片', false);
        }
        if ($form == 1) {
            //文字
            $data['image'] = '';
        }
        //图片处理
        if (strpos($image, "temp")) {
            $data['image'] = save_image($image, 'link');
        } else {
            $data['image'] = str_replace(IMG_URL, "", $data['image']);
        }
        return parent::edit($data); // TODO: Change the autogenerated stub
    }
}