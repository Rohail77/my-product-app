<?php


namespace app\helpers;


class UtilHelper
{
    public static function randomString($n): string
    {
        $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $result = "";
        for ($i = 0; $i < $n; $i++) {
            $randIndex = rand(0, strlen($str) - 1);
            $result .= $str[$randIndex];
        }
        return $result;
    }
}