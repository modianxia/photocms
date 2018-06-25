<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/6/4
 * Time: 10:45
 */

namespace app\admin\controller;
use app\index\model\Photo as PhotoModel;
use think\Request;

class Photo extends BaseAdmin
{
    public function index($id){
        $photos = PhotoModel::where('taotu_id','=',$id)->select();
        $this->assign('photos',$photos);
        $this->assign('taotu_id',$id);
        $this->assign('title','图片管理');
        return $this->fetch();
    }

    public function delete(Request $request){
        $photo = PhotoModel::get($request->get('id'));
        $result = $photo->delete();
        $taotu_id = $request->get('taotu_id');
        if ($result){
            $this->success('删除成功','/admin/photo/index/id/'.$taotu_id,'',1);
        }else{
            $this->error('删除失败','/admin/photo/index/id/'.$taotu_id,'',1);
        }
    }

    public function upload(Request $request){
        $taotu_id = $request->post('taotu_id');
        if (!$taotu_id){
            $this->error('没有选择套图');
        }
        $files = $request->file('image');
        $flag = true;
        foreach($files as $file){
            $photo = new PhotoModel();
            $photo->taotu_id = $taotu_id;
            $result = $photo->save();
            if ($result){
                $dir = ROOT_PATH . 'public/static/upload/photos/'.$taotu_id;
                if (!file_exists($dir)){
                    mkdir($dir,0777,true);
                }
                $info = $file->validate(['size'=>512000,'ext'=>'jpg'])
                    ->move($dir,$photo->id.'.jpg');
                if(!$info){
                    $flag = false;
                }
            }
        }
        if ($flag){
            $this->success('上传成功','index/'.$taotu_id,'',1);
        }
    }
}