<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/28
 * Time: 11:23
 */

namespace app\admin\controller;

use app\index\model\Site as SiteModel;
use app\admin\model\Admin as AdminModel;
use think\Controller;

class Site extends BaseAdmin
{
    public function index(){
        $site = SiteModel::get(0);
        if (!$site){
            $result = $this->createSiteInfo();
            if (!$result){
                echo '初始化网站信息失败，请检查数据库连接';
            }
        }
        $this->assign('site',$site);
        $this->assign('title','网站设置');
        return $this->fetch();
    }

    protected function createSiteInfo(){
        $site = new SiteModel();
        $site->site_name = '爱模特';
        $site->pc_url = 'localhost:8080';
        $site->m_url = 'localhost:8080';
        $site->pc_logo = '__IMG__/logo.png';
        $site->m_logo = '__IMG__/mlogo.png';
        $site->title = '高清套图超市分享推女郎、秀人网、美媛馆、蕾丝猫等美女套图 - 爱模特';
        $site->keyword = '套图超市，推女郎，秀人网，美媛馆，蕾丝猫，高清美女，套图';
        $site->description = '爱模特套图超市栏目，致力于分享各类高清美女套图，包含有推女郎、推女神、秀人网、尤果网、美媛馆、蕾丝猫等等高清美女套图图片。';
        $site->email = '123@qq.com';
        $site->icp = '无备案';
        $result = $site->save();
        return $result;
    }

    public function editsave(){
        $site = SiteModel::get(0);
        if(!$site){
            $result = $this->createSiteInfo();
           if ($result){
               $this->success('保存成功','index','',1);
           }else{
               $this->error('保存失败','index','',1);
           }
        }
        $site->site_name = input('post.site_name');
        $site->pc_url = input('post.pc_url');
        $site->m_url = input('post.m_url');
        $site->pc_logo = input('post.pc_logo');
        $site->m_logo = input('post.m_logo');
        $site->title = input('post.title');
        $site->keyword = input('post.keyword');
        $site->description = input('post.description');
        $site->email = input('post.email');
        $site->icp = input('post.icp');
        $result = $site->save();
        if ($result){
            $this->success('保存成功','index','',1);
        }else{
            $this->error('保存失败','index','',1);
        }

    }

    public function userlist(){
        $list = AdminModel::all();
        $this->assign('userlist',$list);
        $this->assign('title','管理员管理');
        return $this->fetch();
    }
}