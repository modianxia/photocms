<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/23
 * Time: 16:28
 */

namespace app\admin\controller;

use app\index\model\Taotu as TaotuModel;
use think\Controller;

class Taotu extends BaseAdmin
{
    public function index(){
        $taotus = TaotuModel::where('id','>',0)->order('id','desc')
            ->paginate(10.,false,[
                'query'=>request()->param(),
                'type'      => 'util\AdminPage',
                'var_page'  => 'page'
            ]);
        $this->assign('taotus',$taotus);
        $this->assign('title','套图管理');
        return view();
    }

    public function edit(){
        $taotu = TaotuModel::get(input('get.id'));
        if (!$taotu){
            $this->error('找不到该套图！');
        }
        $this->assign('taotu',$taotu);
        $this->assign('title','套图编辑');
        return view();
    }

    public function editsave(){
        $taotu = TaotuModel::get(input('post.id'));
        if (!$taotu){
            $this->error('找不到该套图！');
        }
        $taotu->title = input('post.title');
        $taotu->tags = input('post.tags');
        $taotu->source_url = input('post.source_url');
        $result = $taotu->save();
        $file = $this->request->file('thumb');
        $info = $file->validate(['size'=>102400,'ext'=>'jpg'])
            ->move(ROOT_PATH . 'public/static/upload/taotu/'.$taotu->id.'/','thumb.jpg');
        if($result){
            if ($info){
                $this->success('编辑成功','index','',1);
            }else{
                $this->error('编辑成功，但图片上传失败，请编辑该项上传');
            }
        } else {
            if ($info){
                $this->success('修改缩略图成功','index','',1);
            }
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('编辑失败');
        }
    }

    public function add(){
        $this->assign('title','套图新增');
        return view();
    }

    public function addsave(){
        $taotu = new TaotuModel();
        $taotu->title = input('post.title');
        $taotu->tags = input('post.tags');
        $taotu->source_url = input('post.source_url');
        $result = $taotu->save();
        $file = request()->file('thumb');
        $info = $file->validate(['size'=>102400,'ext'=>'jpg'])
             ->move(ROOT_PATH . 'public/static/upload/taotu/'.$taotu->id.'/','thumb.jpg');
        if($result){
            if ($info){
                $this->success('添加成功','index','',1);
            }else{
                $this->error('添加成功，但图片上传失败，请编辑该项上传');
            }
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('添加失败');
        }
    }

    public function delete(){
        $taotu = TaotuModel::get(input('get.id'));
        if (!$taotu){
            $this->error('找不到该套图！');
        }
        $result = $taotu->delete();
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功','index','',1);
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败');
        }
    }
}