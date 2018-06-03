<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/5/17
 * Time: 23:10
 */

namespace app\admin\controller;

use QL\QueryList;
use think\Controller;
use think\Db;
use think\Log;
use think\Request;
use app\index\model\Taotu as TaotuModel;
use app\index\model\Photo as PhotoModel;

class Crawl extends BaseAdmin
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        Log::init([
            'type' => 'file',
            // error和sql日志单独记录
            'apart_level' => ['error', 'sql'],
        ]);
    }

    //爬取写真页
    protected function taotu(Request $request)
    {
        $ql = QueryList::getInstance();
        $rules1 = array(
            'title' => ['a', 'title', '', function ($content) {
                return trim($content);
            }],
            'img' => ['a>img', 'lazysrc'],
            'url' => ['a', 'href']
        );
        $raw_url = $request->param('url');
        $cate = $request->param('cate');
        $start = intval($request->param('start'));
        $end = intval($request->param('end'));
        for ($i = $start; $i <= $end; $i++) {
            if ($i==1){
                $url = str_replace('/{i}_html','',$raw_url);
            }
            else{
                $url = str_replace('{i}', $i, $raw_url);
            }
            $html = $ql->get($url)->getHtml();
            $data = $ql->html($html)->rules($rules1)->range('li.min-h-imgall')->query()->getData()->all();
            foreach ($data as $item) {
                $taotu = TaotuModel::where('title', $item['title'])->find();
                if ($taotu) { //如果存在该套图，则update
                    if (!strstr($taotu->tags, $cate)) {
                        $taotu->tags = $taotu->tags . '|' . $cate;
                    }
                    $taotu->save();
                } else { //否则新增
                    $taotu = new TaotuModel();
                    $taotu->title = $item['title'];
                    $taotu->tags = $cate;
                    $taotu->source_url = $item['url'];
                    $taotu->save();
                    $this->saveImg($taotu->id, $item['img']);
                }
            }
        }
        $ql->destruct();
        return view('taotuIndex', ['url' => $raw_url, 'title' => '采集', 'start' => 1]);
    }

    protected function saveImg($taotu_id, $img)
    {
        if (!is_dir($taotu_id)) { //如果目录不存在，则创建目录
            mkdir('./static/upload/taotu/' . $taotu_id, '0777');
        }
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_URL, $img);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $file_content = curl_exec($ch);
            curl_close($ch);
            $downloaded_file = fopen('./static/upload/taotu/' . $taotu_id . '/thumb.jpg', 'w');
            fwrite($downloaded_file, $file_content);
            fclose($downloaded_file);
        }catch (Error $e){
            Log::record('错误id:'.$taotu_id);
        }


    }

    public function taotuIndex()
    {
        $url = input('get.url');
        $this->assign('url', $url);
        $this->assign('title', '列表采集');
        $this->assign('start', 1);
        $this->assign('cate', '');
        return view('taotuIndex');
    }

    public function photoIndex(){
        $this->assign('title', '列表采集');
        return view('photoIndex');
    }

    public function photo(){
        $start = input('get.start');
        $end = input('get.end');
        $urls = Db::name("taotu")
            ->where('id','>=',$start)
            ->where('id','<=',$end)
            ->column('source_url','id');
        $ql = new QueryList();
        $rules = [
            'link' => ['a','href']
        ];
        foreach ($urls as $key => $value){
            $html = $ql->get($value)->getHtml();
            $data = $ql->html($html)->rules($rules)->range('ul.clearfix.gallery li')->query()->getData()->all();
            foreach ($data as $item){
                $this->getPhoto($item['link'],$key);
            }
        }
        $ql->destruct();
        return view('photoIndex');
    }

    protected function getPhoto($url,$id){
        $ql = new QueryList();
        $html = $ql->get($url)->getHtml();
        $data = $ql->html($html)->rules([
            'img'=>['#bigImg','src']
        ])->query()->getData()->all();
        $ql->destruct();
        foreach ($data as $item) {
            $photo = new PhotoModel();
            $photo->taotu_id = $id;
            $photo->img_name = $item['img'];
            $photo->save();
        }
    }
}