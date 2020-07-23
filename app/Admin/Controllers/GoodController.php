<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/17
 * Time: 9:52
 */

namespace App\Admin\Controllers;

use App\Admin\Model\Good;
use Dcat\Admin\Grid;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use App\Admin\Actions\AddShoppingCart;

class GoodController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->header('商品列表')
            ->description('这是一个描述')
            ->body($this->grid());
    }

    protected function grid()
    {
        return Grid::make(new Good(), function (Grid $grid) {
            // 第一列显示id字段，并将这一列设置为可排序列
            //$grid->id->code()->sortable();
            $grid->img('图片')->image('http://shopping/img',100,100);
            $grid->id('ID')->sortable()->setAttributes(['style' => 'font-size:10px']);
            $grid->name('名称')->label();
            $grid->price('价格');
            $grid->count('数量');
            $grid->craeted_at('创建时间');
            $grid->updated_at('更新时间');
            //添加购物车
            $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->actions(new AddShoppingCart());
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableQuickEdit();
            });

        });

    }


}