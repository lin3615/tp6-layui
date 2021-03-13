<?php 

namespace app\order\model;

use app\common\model\CommonModel;
use think\facade\Db;

class Order extends CommonModel {
    public function getTest() {
        $result = Db::table('ea_system_menu')->where('status',1)->limit(0,2)->select()->toArray();
        return $result;
    }


    public function getOtherDbTest() {
        $result = Db::connect('order_mysql')->table('t_user')->where('id',1)->find();
        return $result;
    }

    public function getQueryDbTest() {
        $result = Db::connect('order_mysql')->query("select * from t_user where id = :id",['id' => 2]);
        return $result;
    }

}