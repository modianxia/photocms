<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/10
 * Time: 10:44
 */

namespace app\index\model;
use think\Model;

class Taotu extends Model
{
    protected $pk='id';
    protected $autoWriteTimestamp = 'datetime';

//    public function brand(){
//        return $this->belongsToMany('Brand','brandtaotu','brand_id','taotu_id');
//    }

    public function photos(){
        return $this->hasMany('Photo','taotu_id');
    }
}