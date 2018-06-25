<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/6/4
 * Time: 10:45
 */

namespace app\admin\controller;
use app\index\model\Photo as PhotoModel;

class Photo extends BaseAdmin
{
    public function index($id){
        $photos = PhotoModel::where('taotu_id','=',$id)->select();
        $this->assign('photos',$photos);
        $this->assign('title','图片管理');
        return $this->fetch();
    }

    public function delete($id){
        $photo = PhotoModel::get($id);
        $result = $photo->delete();
        if ($result){
            $this->success('删除成功','','',1);
        }else{
            $this->error('删除失败','','',1);
        }

    }
}