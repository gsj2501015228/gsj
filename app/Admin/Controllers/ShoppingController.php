<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/17
 * Time: 16:38
 */

namespace App\Admin\Controllers;

use App\Admin\Model\Shop;
use App\Admin\Model\Good;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use App\Admin\Actions\AddCount;
use App\Admin\Actions\ReduceCount;
use App\Admin\Actions\Statistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;

class ShoppingController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->header('购物车列表')
            ->description('这是一个描述')
            ->body($this->grid());
    }

    protected function grid()
    {

        return Grid::make(new Shop(), function (Grid $grid) {
            $user = Admin::user()->id;
            $grid->model()->where('user_name', '=', $user);
            // 第一列显示id字段，并将这一列设置为可排序列
            //$grid->id->code()->sortable();
            $grid->img('图片')->image('http://shopping/img',100,100);
            $grid->id('ID')->sortable()->setAttributes(['style' => 'font-size:10px']);
            $grid->name('名称')->label();
            $grid->good_id('商品id');
            $grid->price('价格');
            /*$grid->column('-')->display(function () {
                return "<button class=\"btn btn-info\" style='width: 10px'><</button>";
            });*/
            $grid->count('数量');
            /* $grid->column('+')->display(function () {
                 return "<button class=\"btn btn-info\" style='width: 10px'>></button>";
             });*/
            $grid->created_at('创建日期');
            $grid->actions(new AddCount());
            $grid->actions(new ReduceCount());
            $grid->batchActions([
                new ReleasePost('结算', 1),
            ]);
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableQuickEdit();
            });
            /*  $grid->header(function ($collection) {
                  // 自定义组件

                  return ;
              });*/
        });

    }

    protected function aff(Request $request, $id)
    {
       $user = Admin::user()->id;
        $time = Carbon::now()->toDateTimeString();
        $exit = Shop::where('good_id', $id)->get();
        if ($exit->isEmpty()) {
            $good = Good::where('id', $id)->first();
            Shop::insert([
                'user_name' => $user,
                'good_id' => $good->id,
                'seller_id' => $good->seller_id,
                'name' => $good->name,
                'price' => $good->price,
                'created_at' => $time,
                'check' => '0',
                'img' => $good->img,
            ]);
        } else {
            Shop::where('good_id', $id)->increment('count', 1);
            Shop::where('good_id', $id)->update([
                'created_at' => $time,
            ]);
        }
    }

    public function add(Request $request, $id)
    {
        Shop::where('id', $id)->increment('count', 1);

    }

    public function reduce(Request $request, $id)
    {
        Shop::where('id', $id)->decrement('count', 1);
    }

}