<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/21
 * Time: 15:32
 */

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Admin;
use App\Admin\Model\Good;
use Dcat\Admin\Layout\Content;
use App\Admin\Forms\GoodsAddForm;
use Dcat\Admin\Widgets\Card;

class GoodAddController
{
    public function index(Content $content){
        return $content
            ->header('商品添加')
            ->body(new Card(new GoodsAddForm()));
    }

    public function up(){


    }
}