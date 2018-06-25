<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/9
 * Time: 17:19
 */

namespace app\index\model;

use think\Model;

class Brand extends Model
{
    protected $pk='id';
    protected $autoWriteTimestamp = 'datetime';

    public function getCateDes(){
        return $this->cate_des;
    }
}