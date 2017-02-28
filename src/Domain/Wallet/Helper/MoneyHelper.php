<?php

namespace Domain\Wallet\Helper;
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 27.02.17
 * Time: 22:01
 */
class MoneyHelper
{
    const PRECISSION = 100;

    public static function formatMoney(int $money)
    {
        return round($money / MoneyHelper::PRECISSION, 4);
    }

    public static function toInt(float $money)
    {
        return $money * MoneyHelper::PRECISSION;
    }
}