<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/21
 * Time: 16:56
 */

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Symfony\Component\HttpFoundation\Response;
use Dcat\Admin\Admin;
use App\Admin\Model\Good;
use Dcat\Admin\Layout\Content;
use Carbon\Carbon;

class GoodsAddForm extends Form
{
    public function handle(array $input)
    {
        $time = Carbon::now()->toDateTimeString();
        Good::insert([
            'img' => $input['img'],
            'seller_id' => $input['seller_id'],
            'name' => $input['name'],
            'price' => $input['price'],
            'count' => $input['count'],
            'craeted_at' => $time,
            'kind' => $input['kind'],
        ]);

        return $this->success('上架成功.');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('seller_id', '商品ID');
        $this->text('name', '商品名称');

        $this->image('img')->autoUpload();
        // 添加describe的textarea输入框
        $this->textarea('kind', '简介');
        $this->datetime('craeted_at', '发布时间');
        // 数字输入框
        $this->number('price', '价格');
        $this->number('count', '库存');



    }


}