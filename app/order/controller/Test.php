<?php
declare (strict_types = 1);

namespace app\order\controller;

use app\common\controller\BackController;
use think\facade\View;
use app\order\model\Order;

class Test extends BackController
{
    private $model;
    public function initialize() {
        parent::initialize();
        $this->model = new Order();
    }

    public function index()
    {
        echo __FILE__;
    }

    public function testView() {
        $this->assign('version','2021.03.10');
        return $this->fetch();
    }

    public function t() {
        $rs = $this->model->getTest();
        $otherDb = $this->model->getOtherDbTest();
        $queryDb = $this->model->getQueryDbTest();
        echo "<pre>";
        print_r($rs);
        print_r($otherDb);
        print_r($queryDb);
        echo "</pre>";
    }



   




}
