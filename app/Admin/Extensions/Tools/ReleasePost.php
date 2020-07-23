<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/20
 * Time: 14:36
 */

namespace App\Admin\Extensions\Tools;

use Dcat\Admin\Grid\BatchAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Admin\Model\Shop;
use App\Admin\Model\Good;
use App\Admin\Model\OrderForm;
use Carbon\Carbon;

class ReleasePost extends BatchAction
{
    protected $action;

    // 注意action的构造方法参数一定要给默认值
    public function __construct($title = null, $action = 1)
    {
        $this->title = $title;
        $this->action = $action;
    }

    // 确认弹窗信息
    public function confirm()
    {
        return '您确定要支付' . '已选中的商品吗？';
    }

    // 处理请求
    public function handle(Request $request)
    {
        // 获取选中的文章ID数组
        $keys = $this->getKey();

        // 获取请求参数
        $action = $request->get('action');
        //结算
        $sum = 0;
        if ($action == 1) {
            foreach ($keys as $id) {
                DB::beginTransaction();
                try {
                    //获取商品ID、数量 查询合并
                    $order = Shop::where('id', $id)->first();
                    $goodid = Shop::where('id', $id)->value('good_id');
                    //获得店铺库存 原子性操作
                    $count_1 = Shop::where('id', $id)->value('count');
                    $time = Carbon::now()->toDateTimeString();
                    Good::where('id', $goodid)->update([
                        'updated_at' => $time,
                    ]);
                    Good::where('id', $goodid)->decrement('count', $count_1);
                    //获取订单的商品ID
                    $img = Good::where('id', $goodid)->value('img');
                    OrderForm::insert([
                        'order_id' => $id,
                        'count' => $order->count,
                        'good_id' => $order->good_id,
                        'amount' => $order->price,
                        'time_action' => $time,
                        'status' => "已支付",
                        'img' => $img,
                        'name' => $order->name,

                    ]);

                    DB::commit();
                    //成功，提交事务
                } catch (\Exception $e) {
                    DB::rollback();    //失败，回滚事务
                }

            }
            foreach ($keys as $id) {
                $shop = Shop::where('id', $id)->first();
                $sum += $shop->price * $shop->count;
            }
            foreach ($keys as $id) {
                Shop::where('id', $id)->delete();
            }
        }



        $message = $action ? '购买成功'.$sum : '￥' . $sum;

        return $this->response()->success($message)->refresh();
    }

    // 设置请求参数
    public function parameters()
    {
        return [
            'action' => $this->action,
        ];
    }
}