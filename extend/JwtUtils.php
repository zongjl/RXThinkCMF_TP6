<?php
// +----------------------------------------------------------------------
// | 牧羊人 [ THMALL ]
// +----------------------------------------------------------------------
// | 版权所有 2020~2028 南京牧羊人科技有限公司
// +----------------------------------------------------------------------
// | 官方网站: http://www.ta-tech.cn/
// +----------------------------------------------------------------------
// | Author: 牧羊人 <ta-tech.cn@gmail.com>
// +----------------------------------------------------------------------

/**
 * Jwt工具类
 *
 * @author 牧羊人
 * @since 2020-04-22
 */
class JwtUtils
{

    /**
     * 获取登录ID
     *
     * @author 牧羊人
     * @since 2020-04-22
     */
    public static function getAdminId()
    {
        // 从Header中获取token参数
        $token = request()->header('token');
        // 解析Token并获取用户ID
        $jwt = new Jwt();
        $uid = $jwt->verifyToken($token);
        return $uid;
    }
}