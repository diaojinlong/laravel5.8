<?php

namespace App\Services;

class PriceServices
{

    /**
     * PHP精确计算  主要用于货币的计算用
     * @param $n1 第一个数
     * @param $symbol 计算符号 + - * / %
     * @param $n2 第二个数
     * @param string $scale 精度 默认为小数点后两位
     * @return  string
     */
    public static function priceCalc($n1, $symbol, $n2, $scale = '2')
    {
        $res = "";
        switch ($symbol) {
            case "+"://加法
                $res = bcadd($n1, $n2, $scale);
                break;
            case "-"://减法
                $res = bcsub($n1, $n2, $scale);
                break;
            case "*"://乘法
                $res = bcmul($n1, $n2, $scale);
                break;
            case "/"://除法
                $res = bcdiv($n1, $n2, $scale);
                break;
            case "%"://求余、取模
                $res = bcmod($n1, $n2, $scale);
                break;
            default:
                $res = "";
                break;
        }
        return $res;
    }

    /**
     * 价格由元转分(用于微信支付单位转换)
     * @param $price 金额
     * @return int
     */
    public static function priceYuanToFen($price)
    {
        $price = intval(self::priceCalc(100, "*", $price));
        return $price;
    }

    /**
     * 价格由分转元
     * @param $price 金额
     * @return float
     */
    public static function priceFenToYuan($price)
    {
        $price = self::priceCalc(self::priceFormat($price), "/", 100);
        return $price;
    }

    /**
     * 价格格式化
     * @param int $price
     * @return string    $price_format
     */
    public static function priceFormat($price)
    {
        $price_format = number_format($price, 2, '.', '');
        return $price_format;
    }
}
