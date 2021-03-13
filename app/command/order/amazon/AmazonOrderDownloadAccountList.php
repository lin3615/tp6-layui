<?php
declare (strict_types = 1);

namespace app\command\order\amazon;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\facade\Db;
use diyclass\Logs;

class AmazonOrderDownloadAccountList extends Command
{
    private $filename;
    protected function configure()
    {
        // 指令配置
        $this->setName('AmazonOrderDownloadAccountList')
            ->setDescription('获取要下载订单的亚马逊账号');
    }

    protected function execute(Input $input, Output $output)
    {
        $this->getAccountList();
    }
    /**
     * 获取账号列表
     */
    private function getAccountList() {
        $where = ['platform' => 'amazon'];
        $result = Db::table('account')->where($where)->select()->toArray();
        $str = '';
        if($result) {
            foreach($result as $row) {
                $str .= urlencode($row['ebay_account']) . "\n"; 
            }
        }
        $this->filename = __DIR__ . '/amazon_order_download_account.list';
        Logs::write_file($this->filename,$str);
    }
}
