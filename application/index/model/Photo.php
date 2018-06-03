<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/13
 * Time: 0:06
 */

namespace app\index\model;
use think\Model;

class Photo extends Model
{
    protected $pk ='id';
    protected $autoWriteTimestamp = 'datetime';

    public function taotu(){
        return $this->belongsTo('Taotu');
    }
}