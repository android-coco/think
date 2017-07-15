<?php

/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/14
 * Time: 22:55
 */
namespace app\home\model;
class User
{
    public function save($data = null)
    {
        if (empty($data))
        {
            return false;
        }
        else
        {
            return true;
        }

    }
}