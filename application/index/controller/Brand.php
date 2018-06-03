<?php

namespace app\index\controller;

use app\index\model\Brand as BrandModel;
use app\index\model\Site as SiteModel;
use app\index\model\Photo as PhotoModel;
use app\index\model\Taotu as TaotuModel;
use think\Controller;
use think\Db;

class Brand extends Controller
{
    public function listall($cate='jigou')
    {
        $site = SiteModel::get(0);
        $brands = BrandModel::where('cate','=',$cate)->select();
        $this->assign('site', $site);
        $this->assign('brands', $brands);
        $this->assign('cate',$cate);
        $this->assign('cate_name',current($brands)->getCateDes());
        if (isMobile()){
            return $this->fetch('mlistall');
        }else{
            return $this->fetch();
        }
    }

    public function index($id)
    {
        $site = SiteModel::get(0);
        $brand = BrandModel::get($id);
        $brands = BrandModel::where('cate','=',$brand->cate)->select();//查出相同分类的所有套图
        if (isMobile()){
            $page = 'Mpage'; //选择分页设置
        }else{
            $page = 'Page2';
        }
        //查出tags里包含brand的cate_des的所有套图
        $taotus = TaotuModel::where('tags','like',"%$brand->brand_name%")->paginate(15,false,[
            'query'=>request()->param(),
            'type'      => 'util\\'.$page,
            'var_page'  => 'page'
        ]);
        foreach ($taotus as $taotu) {
           $taotu->count = count(PhotoModel::where('taotu_id', '=', $taotu->id)->select());
        }
        $this->assign('brand', $brand);
        $this->assign('brands', $brands);
        $this->assign('site', $site);
        $this->assign('count', count($taotus));
        $this->assign('taotus', $taotus);
        if (isMobile()){
            return $this->fetch('mindex');
        }else{
            return $this->fetch();
        }
    }

    public function newest(){
        $site = SiteModel::get(0);
        if (isMobile()){
            $page = 'Mpage'; //选择分页设置
        }else{
            $page = 'Page2';
        }
        $brands = BrandModel::where('id','>',0)->paginate(10,false,[
            'query'=>request()->param(),
            'type'      => 'util\\'.$page,
            'var_page'  => 'page'
        ]);
        $this->assign('brands',$brands);
        $this->assign('site', $site);
        if (isMobile()){
            return $this->fetch('mnewest');
        }else{
            return $this->fetch();
        }
    }
}