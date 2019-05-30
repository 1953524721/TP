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

// +----------------------------------------------------------------------
// | 日志设置
// +----------------------------------------------------------------------
return [
    // 日志记录方式，内置 file socket 支持扩展
    'type'        => 'File',
    // 日志保存目录
    'path'        => '../public/log/',
    // 日志记录级别
    'level'       => [],
    // 单文件日志写入
    'single'      => false,
    // 独立日志级别
    'apart_level' => [],
    // 最大日志文件数量
    'max_files'   => 0,
    // 是否关闭日志写入
    'close'       => false,
];
//return [
//    // 日志记录方式，内置 file socket 支持扩展
//    'type'        => 'File',
//    // 日志保存目录
//    'path'        => '../public/log/',
//    // 日志记录级别
//    'level'       => [],
//    //日志的时间格式，默认是` c `
//    'time_format'   =>'c',
//    // 单文件日志写入
//    'single'      => false,
//    // 独立日志级别
//    'apart_level' => [],
//    // 最大日志文件数量
//    'max_files'   => 30,
//    //单个文件大小
//    'file_size'   	=>1024*1024*10,
//    // 是否关闭日志写入
//    'close'       => false,
//];