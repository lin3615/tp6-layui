<?php 

namespace app\common\controller;
use app\BaseController;

class BackController extends BaseController 
{
    /**
     * 模板布局, false取消
     * @var string|bool
     */
    protected $layout = '../../../view/layout/default';
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        $this->app->view->engine()->layout($this->layout);
    }

    /**
     * 模板变量赋值
     * @param string|array $name 模板变量
     * @param mixed $value 变量值
     * @return mixed
     */
    public function assign($name, $value = null)
    {
        return $this->app->view->assign($name, $value);
    }

    /**
     * 解析和获取模板内容 用于输出
     * @param string $template
     * @param array $vars
     * @return mixed
     */
    public function fetch($template = '', $vars = [])
    {
        return $this->app->view->fetch($template, $vars);
    }
}