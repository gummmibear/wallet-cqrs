<?php

namespace Domain\Wallet\Helper;

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
