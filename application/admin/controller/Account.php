<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/28
 * Time: 14:36
 */

namespace app\admin\controller;

use app\admin\model\Admin as AdminModel;
use think\Controller;
use think\Session;

class Account extends Controller
{
    public function login(){
        $this->assign('title','管理员登录');
        return $this->fetch();
    }
    public function loginConfirm(){
        $username = input('post.username');
        $password = input('post.password');
        $user = AdminModel::where('username',trim($username))->find();
        if (!$user){
            $this->error('用户名或密码错误','login','',1);
        }
        if (md5($password) != $user->password){
            $this->error('用户名或密码错误','login','',1);
        }
        Session::set('aimote_admin',$user->username);
        $this->success('登录成功','/admin','',1);
    }

    public function logout(){
        Session::delete('aimote_admin');
        $this->success('注销登录','admin/account/login','',1);
    }
}