<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/14
 * Time: 11:33
 */

namespace app\index\controller;
use think\Controller;

class Pub extends Controller
{
    public function head(){
        return $this->fetch();
    }

    public function nav(){
        return $this->fetch();
    }


    public function foot(){
        return $this->fetch();
    }

    public function mhead(){
        return $this->fetch();
    }

    public function mfoot(){
        return $this->fetch();
    }
}