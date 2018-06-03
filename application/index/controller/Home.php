<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/15
 * Time: 15:11
 */

namespace app\index\controller;
use think\Controller;
use app\index\model\Site as SiteModel;
use app\index\model\Taotu as TaotuModel;
use app\index\model\Brand as BrandModel;
use think\Db;

class Home extends Controller
{
    public function index(){
        $site = SiteModel::get(0);
        $lunbo = Db::query("SELECT ad1.id,brand_name,nick_name
FROM brand AS ad1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM brand)-(SELECT MIN(id) FROM brand))+(SELECT MIN(id) FROM brand)) AS id)
 AS t2 WHERE ad1.id >= t2.id ORDER BY ad1.id LIMIT 7;");
        $brands['jigou'] = BrandModel::where('cate','=','jigou')->select();
        $brands['meinvdalei'] = BrandModel::where('cate','=','meinvdalei')->select();
        $brands['diyufenbu'] = BrandModel::where('cate','=','diyufenbu')->select();
        $brands['shencaitizheng'] = BrandModel::where('cate','=','shencaitizheng')->select();
        $brands['zhuozhuangleixing'] = BrandModel::where('cate','=','zhuozhuangleixing')->select();
        $brands['tedingchangjing'] = BrandModel::where('cate','=','tedingchangjing')->select();
        $brands['mingxingmote'] = BrandModel::where('cate','=','mingxingmote')->select();
        $brands['tedingleixing'] = BrandModel::where('cate','=','tedingleixing')->select();
        foreach ($brands as $key => $cate){
            $cate['cate'] = $key;
        }
        $taotus = Db::query("SELECT ad1.id,title,update_time
FROM taotu AS ad1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM taotu)-(SELECT MIN(id) FROM taotu))+(SELECT MIN(id) FROM taotu)) AS id)
 AS t2 WHERE ad1.id >= t2.id ORDER BY ad1.id LIMIT 20");
        foreach ($taotus as &$taotu) {
            $list = Db::query("SELECT COUNT(id) as num FROM photo WHERE taotu_id =".$taotu['id'])[0];
            foreach ($list as $key=>$value) {
                $taotu['count'] = $value;
            }
        }
        $this->assign('site',$site);
        $this->assign('brands',$brands);
        $this->assign('taotus',$taotus);
        $this->assign('lunbo',$lunbo);
        if (isMobile()){
            return $this->fetch('mindex');
        }else{
            return $this->fetch();
        }

    }
}