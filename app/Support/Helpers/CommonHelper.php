<?php
if (!function_exists('format_price')) {
    /**
     * 格式化金额（保留小数点后2位，四舍五入）
     * @param $price
     * @return string
     */
    function format_price($price)
    {
        $price = round($price, 2);
        return number_format($price, 2, ".", "");
    }
}

if (!function_exists('error_msg')) {
    /**
     * 依据code返回错误描述
     * @param $code
     * @return array
     */
    function error_msg($code)
    {
        $msg = array(
            40000 => '请求失败',
            40001 => '参数错误',
            40002 => '操作失败',
            40003 => '您无权限',
            40004 => '数据不存在',
            40005 => '数据已删除',
            40006 => '数据不可编辑',
            40007 => '文件类型非法',
        );
        if (isset($msg[$code])) {
            return array($code, $msg[$code]);
        } else {
            return array($code, $msg[40000]);
        }
    }
}
