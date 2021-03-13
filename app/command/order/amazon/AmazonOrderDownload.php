<?php
declare (strict_types = 1);

namespace app\command\order\amazon;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\facade\Db;
use MCS\MWSClient;
use diyclass\Logs;

class AmazonOrderDownload extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('orderdownload')
            ->addArgument('account',1,'账号名称')
            ->setDescription('亚马逊订单下载');
    }

    protected function execute(Input $input, Output $output)
    {
        $account = urldecode($input->getArgument('account'));
        $accountInfo = $this->getAccountInfo($account);
        $param = array('Marketplace_Id' => $accountInfo['Marketplace_Id'],
                        'Seller_Id' => $accountInfo['Seller_Id'],
                        'Access_Key_ID' => $accountInfo['Access_Key_ID'],
                        'Secret_Access_Key' => $accountInfo['Secret_Access_Key'],
                        'MWSAuthToken' => $accountInfo['MWSAuthToken'] 
        );
        $amazonOrders = new MWSClient($param);
        $startDate = date('Y-m-d',strtotime('-1 day'));
        $fromDate = new \DateTime($startDate);
        $orders = $amazonOrders->ListOrders($fromDate);
        foreach ($orders as $kk=> $order) {
            $items = $amazonOrders->ListOrderItems($order['AmazonOrderId']);
            Logs::debug($order,'/order/amazon/logs/',1,'主订单信息');
            Logs::debug($items,'/order/amazon/logs/',1,'详情信息');
            print_r($order);
            print_r($items);
        }

    }

    private function getAccountInfo($account) {
        $result = Db::table('account')->where(['ebay_account' => $account])->find();
        return $result;
    }
}
