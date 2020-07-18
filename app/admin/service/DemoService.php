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


use app\admin\model\Demo;
use app\common\service\BaseService;

/**
 * 演示管理-服务类
 * @author 牧羊人
 * @since: 2020/07/17
 * Class DemoService
 * @package app\admin\service
 */
class DemoService extends BaseService
{
    /**
     * 构造函数
     * LevelService constructor.
     */
    public function __construct()
    {
        $this->model = new Demo();
    }
	
	/**
     * 获取数据列表
     * @return array
     * @since 2020/07/17
     * @author 牧羊人
     */
    public function getList()
    {
        $param = request()->param();

        // 查询条件
        $map = [];
		
	
	    // 职级名称
        $name = isset($param['name']) ? trim($param['name']) : '';
        if ($name) {
            $map[] = ['name', 'like', "%{$name}%"];
        }
		
	    // 状态
        $status = isset($param['status']) ? (int)$param['status'] : 0;
        if ($status) {
            $map[] = ['status', '=', $status];
        }
		
	    // 类型
        $type = isset($param['type']) ? (int)$param['type'] : 0;
        if ($type) {
            $map[] = ['type', '=', $type];
        }
		
	    // 是否VIP
        $is_vip = isset($param['is_vip']) ? (int)$param['is_vip'] : 0;
        if ($is_vip) {
            $map[] = ['is_vip', '=', $is_vip];
        }
	
        return parent::getList($map); // TODO: Change the autogenerated stub
    }

	/**
     * 添加或编辑
     * @return array
     * @since 2020/07/17
     * @author 牧羊人
     */
    public function edit()
    {
        // 参数
        $data = request()->param();
	                                
		// 头像处理
        $avatar = trim($data['avatar']);
        if (strpos($avatar, "temp")) {
            $data['avatar'] = save_image($avatar, 'demo');
        } else {
            $data['avatar'] = str_replace(IMG_URL, "", $data['avatar']);
        }
                                                                                                                                
        return parent::edit($data); // TODO: Change the autogenerated stub
    }

                	
	/**
     * 设置状态     
	 * @return array
     * @throws \think\db\exception\BindParamException
     * @throws \think\exception\PDOException
     * @since 2020/07/17     
	 * @author 牧羊人     
	 */
    public function setStatus()
    {
		// 参数
        $data = request()->param();
        if (!$data['id']) {
            return message('记录ID不能为空', false);
        }
		if (!$data['status']) {
            return message('记录状态不能为空', false);
        }
        $error = '';
        $rowId = $this->model->edit($data, $error);
        if (!$rowId) {
            return message($error, false);
        }
        return message();
    }
	        	
	/**
     * 设置是否VIP     
	 * @return array
     * @throws \think\db\exception\BindParamException
     * @throws \think\exception\PDOException
     * @since 2020/07/17     
	 * @author 牧羊人     
	 */
    public function setIsVip()
    {
		// 参数
        $data = request()->param();
        if (!$data['id']) {
            return message('记录ID不能为空', false);
        }
		if (!$data['is_vip']) {
            return message('记录是否VIP不能为空', false);
        }
        $error = '';
        $rowId = $this->model->edit($data, $error);
        if (!$rowId) {
            return message($error, false);
        }
        return message();
    }
	                        
}