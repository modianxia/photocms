<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/19
 * Time: 15:13
 */

namespace app\admin\controller;


use think\Controller;

class BaseAdmin extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->_admin = session('aimote_admin');
        // 未登录的用户不允许访问
        if(!$this->_admin){
            $this->success('请登录','admin/account/login','',1);
        }
        $this->assign('username',$this->_admin);
        // 判断用户是否有权限
    }
}