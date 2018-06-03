<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::rule('/', 'index/home/index');
Route::rule('/taotu/:id', 'index/taotu/index');
Route::rule('/brand/:id', 'index/brand/index');
Route::rule('/brandlistall/:cate', 'index/brand/listall');
Route::rule('/brand/newest', 'index/brand/newest');
Route::rule('/taotu/newest', 'index/taotu/newest');
Route::rule('/admin$', 'admin/site/index');