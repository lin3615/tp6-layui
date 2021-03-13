<?php
declare (strict_types = 1);

namespace app\command\order\walmart;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\facade\Db;
use Lin3615\WalmartOrders\Orders as WalmartOrders;
use diyclass\Logs;

class WalmartOrderDownload extends Command
{
    private $filename;
    protected function configure()
    {
        // 指令配置
        $this->setName('orderdownload')
            ->addArgument('account',1,'账号名称')
            ->addArgument('status',2,'订单状态,以下几个值,Created, Acknowledged, Shipped, Delivered, Cancelled','')
            ->setDescription('沃尔玛订单下载');
    }

    protected function execute(Input $input, Output $output)
    {
       $account = urldecode($input->getArgument('account'));
       $status = urldecode($input->getArgument('status'));
       $accountInfo = $this->getAccountInfo($account);
       $clientId = $accountInfo['AWS_ACCESS_KEY_ID'];
       $clientSecret = $accountInfo['AWS_SECRET_ACCESS_KEY'];
       $param = array('status' => $status,'createdStartDate' => date('Y-m-d',strtotime('-1 day')),'limit' => 2);

        $walmartOrders = new WalmartOrders();
        $orderList = $walmartOrders->allOrdersUs($clientId,$clientSecret,$param);
        print_r($orderList);
    }

    private function getAccountInfo($account) {
        $result = Db::table('account')->where(['ebay_account' => $account])->find();
        return $result;
    }


}
