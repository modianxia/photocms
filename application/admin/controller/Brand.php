<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/23
 * Time: 11:12
 */

namespace app\admin\controller;

use app\index\model\Brand as BrandModel;
use think\Validate;
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
        $id = $request->get('id');
        $brand = BrandModel::get($id);
        if (!$brand){
            $this->error('找不到该分类!');
        }
        $this->assign('brand',$brand);
        $this->assign('title','分类编辑');
        return view();
    }

    public function editsave(Request $request){
        $brand = BrandModel::get($request->post('id'));
        if (!$brand){
            $this->error('找不到该分类');
        }
        $brand->brand_name = $request->post('brand_name');
        $brand->nick_name = $request->post('nick_name');
        $brand->brand_des = $request->post('brand_des');
        $brand->cate = $request->post('cate');
        $brand->cate_des = $request->post('cate_des');
        $brand->title = $request->post('title');
        $brand->keyword = $request->post('keyword');
        $brand->description = $request->post('description');
        $validate = new Validate($this->rule(), $this->msg());
        if ($validate->check($request->param())){
            $result = $brand->save();

            $dir = ROOT_PATH . 'public/static/upload/brand/'.$brand->nick_name;
            if (!file_exists($dir)){
                mkdir($dir,0777,true);
            }
            $banner = $request->file('banner');
            $banner_info = null;
            if ($banner){
                $banner_info = $banner->validate(['size'=>512000,'ext'=>'jpg'])
                    ->move($dir,'banner.jpg');
            }

            $mbanner = $request->file('mbanner');
            $mbanner_info = null;
            if ($mbanner){
                $mbanner_info = $mbanner->validate(['size'=>204800,'ext'=>'jpg'])
                    ->move($dir,'mbanner.jpg');
            }

            $thumb = $request->file('thumb');
            $thumb_info = null;
            if ($thumb){
                $thumb_info = $thumb->validate(['size'=>102400,'ext'=>'jpg'])
                    ->move($dir,'thumb.jpg');
            }

            if ($result){
                $this->success('修改成功','index','',1);
            }else {
                $this->error('修改失败');
            }
        }else{
            $this->error('表单填写不符合要求');
        }
    }

    public function delete(Request $request){
        $brand = BrandModel::get($request->get('id'));
        if (!$brand){
            $this->error('没有找到要删除的项');
        }
        $result = $brand->delete();
        if ($result){
            $this->success('删除成功','index','',1);
        }else {
            $this->error('删除失败');
        }
    }

    public function add(){
        $this->assign('title','分类新增');
        return view();
    }

    public function addsave(Request $request){
        $brand = new BrandModel();
        $brand->brand_name = $request->post('brand_name');
        $brand->nick_name = $request->post('nick_name');
        $brand->brand_des = $request->post('brand_des');
        $brand->cate = $request->post('cate');
        $brand->cate_des = $request->post('cate_des');
        $brand->title = $request->post('title');
        $brand->keyword = $request->post('keyword');
        $brand->description = $request->post('description');
        $validate = new Validate($this->rule(), $this->msg());
        if ($validate->check($request->param())){
            $result = $brand->save();

            $dir = ROOT_PATH . 'public/static/upload/brand/'.$brand->nick_name;
            if (!file_exists($dir)){
                mkdir($dir,0777,true);
            }
            $banner = $request->file('banner');
            $banner_info = null;
            if ($banner){
                $banner_info = $banner->validate(['size'=>512000,'ext'=>'jpg'])
                    ->move($dir,'banner.jpg');
            }

            $mbanner = $request->file('mbanner');
            $mbanner_info = null;
            if ($mbanner){
                $mbanner_info = $mbanner->validate(['size'=>204800,'ext'=>'jpg'])
                    ->move($dir,'mbanner.jpg');
            }

            $thumb = $request->file('thumb');
            $thumb_info = null;
            if ($thumb){
                $thumb_info = $thumb->validate(['size'=>102400,'ext'=>'jpg'])
                    ->move($dir,'thumb.jpg');
            }

            if ($result){
                if ($banner_info&&$mbanner_info&&$thumb_info){
                    $this->success('添加成功','index','',1);
                }else{
                    $this->error('添加成功，但图片未上传，请编辑该项上传');
                }
            }else {
                $this->error('添加失败');
            }
        }else{
            $this->error('表单填写不符合要求');
        }

    }

    protected function rule(){
        return [
            'brand_name' => 'require',
            'nick_name' => 'require',
            'cate' => 'require',
            'cate_des' => 'require',
        ];
    }

    protected function  msg(){
        return [
            'brand_name' => '名称必须',
            'nick_name' => '昵称必须',
            'cate' => '大类拼音必须',
            'cate_des' => '大类必须'
        ];
    }
}