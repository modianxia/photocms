<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/6/22
 * Time: 17:08
 */

namespace app\admin\model;

use think\Validate;

class Brand extends Validate
{
    protected $rule = [
        'brand_name'  =>  'require',
        'nick_name' =>  'require',
        'cate' => 'require',
        'cate_des' => 'require'
    ];

    protected $message  =   [
        'brand_name.require' => '名称必须',
        'nick_name.require'     => '名称拼音必须',
        'cate.require' => '必须填写大类拼音',
        'cate_des.require' => '必须填写大类名称'
    ];
}