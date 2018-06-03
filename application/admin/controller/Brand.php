<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/23
 * Time: 11:12
 */

namespace app\admin\controller;

use app\index\model\Brand as BrandModel;
use think\Controller;
use think\Request;

class Brand extends BaseAdmin
{
    public function index(){
        $brands = BrandModel::where('id','>',0)->order('id','desc')
            ->paginate(10,false,[
            'query'=>request()->param(),
            'type'      => 'util\AdminPage',
            'var_page'  => 'page'
        ]);

        $this->assign('brands',$brands);
        $this->assign('title', '分类管理');
        return view();
    }

    public function edit(Request $request){
        $id = input('get.id');
        $brand = BrandModel::get($id);
        if (!$brand){
            $this->error('找不到该分类!');
        }
        $this->assign('brand',$brand);
        $this->assign('title','分类编辑');
        return view();
    }

    public function editsave(){
        $brand = BrandModel::get(input('post.id'));
        if (!$brand){
            $this->error('找不到该分类');
        }
        $brand->brand_name = input('post.brand_name');
        $brand->nick_name = input('post.nick_name');
        $brand->brand_des = input('post.brand_des');
        $brand->title = input('post.title');
        $brand->keyword = input('post.keyword');
        $brand->description = input('post.description');
        $result= $brand->save();
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('编辑成功','index','',1);
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('编辑失败');
        }
    }

    public function delete(Request $request){
        $brand = BrandModel::get($request->get('id'));
        $result = $brand->delete();
        if ($result){
            $this->success('删除成功');
        }else {
            $this->error('删除失败');
        }
    }

    public function add(){
        $this->assign('title','分类新增');
        return view();
    }

    public function addsave(){
        $brand = new BrandModel();
        $brand->brand_name = input('get.brand_name');
        $brand->nick_name = input('get.nick_name');
        $brand->brand_des = input('get.brand_des');
        $brand->cate = input('get.cate');
        $brand->cate_des = input('get.cate_des');
        $brand->title = input('get.title');
        $brand->keyword = input('get.keyword');
        $brand->description = input('get.description');
        $result = $brand->save();
        if ($result){
            $this->success('添加成功','index','',1);
        }else {
            $this->error('添加失败');
        }
    }
}