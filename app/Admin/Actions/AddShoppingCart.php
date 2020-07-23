<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/17
 * Time: 15:11
 */

namespace App\Admin\Actions;

use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Dcat\Admin\Grid;

class AddShoppingCart extends RowAction
{
    public function title()
    {
        return '添加购物车';
    }

    protected function script()
    {
        $id =$this->row->id;
        return <<<JS

$(".add-shopping-cart-{$id}").on('click', function () {
          var id = $id;
          $.ajax({
                type: 'POST',
                url: '../admin/good/shopping/' + id,
                data: {'_token':'{{csrf_token()}}'},
                success: function (resp) {
                    Dcat.success('商品'+id+'添加成功', null, {
    timeOut: 5000, // 5秒后自动消失
});
                },
                error: function (resp) {
                alert(resp.responseText)
                },
            });
    console.log($(this).data('id'));
    console.log(Dcat.grid.selected);
});
JS;
    }


    public function html()
    {
        // 获取当前行数据ID
        $id = $this->getKey();

        // 获取当前行数据的用户名
        $name = $this->row->name;

        // 这里需要添加一个class, 和上面script方法对应
        $this->setHtmlAttribute(['data-id' => $id, 'name' => $name, 'class' => 'add-shopping-cart-'.$id]);

        return parent::html();
    }

}