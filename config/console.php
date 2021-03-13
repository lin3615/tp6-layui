<?php
// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------
return [
    // 指令定义
    'commands' => [
        'AmazonOrderDownload' => 'app\command\order\amazon\AmazonOrderDownload', // 亚马逊订单下载
        'AmazonOrderDownloadAccountList' => 'app\command\order\amazon\AmazonOrderDownloadAccountList', // 亚马逊账号列表
        'WalmartOrderDownload' => 'app\command\order\walmart\WalmartOrderDownload', // 沃尔玛订单下载
        'WalmartOrderDownloadAccountList' => 'app\command\order\walmart\WalmartOrderDownloadAccountList', // 沃尔玛账号列表
    ],
];
