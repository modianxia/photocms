<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/28
 * Time: 14:37
 */

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    protected $pk='id';
    protected $autoWriteTimestamp = 'datetime';
}