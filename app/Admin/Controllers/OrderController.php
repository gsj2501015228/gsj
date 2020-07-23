<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/17
 * Time: 16:38
 */

namespace App\Admin\Controllers;

use App\Admin\Model\OrderForm;
use App\Admin\Model\Shop;
use Dcat\Admin\Grid;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Row;
use App\Admin\Actions\AddShoppingCart;

class OrderController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->header('订单列表')
            ->description('这是一个描述')
            ->body($this->grid());
    }

    protected function grid()
    {
        return Grid::make(new OrderForm(), function (Grid $grid) {
            $user = Admin::user()->id;
            $grid->model()->where('user_name', '=', $user);
            // 第一列显示id字段，并将这一列设置为可排序列
            //$grid->id->code()->sortable();
            $grid->img('图片')->image('',100,100);
            $grid->id('ID')->sortable()->setAttributes(['style' => 'font-size:10px']);
            $grid->name('名称')->label();
            $grid->amount('价格');
            $grid->count('数量');

            $grid->time_action('日期');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableQuickEdit();
            });
        });

    }
}