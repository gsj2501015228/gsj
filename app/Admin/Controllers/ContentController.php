<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/22
 * Time: 11:13
 */

namespace App\Admin\Controllers;

use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Layout\Column;
use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Controllers\Dashboard;

class ContentController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->header('商品')
            ->description('这是一个描述')
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row(Dashboard::title());
                    $column->row(Dashboard::title());
                });

                $row->column(6, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(6, new Examples\NewUsers());
                        $row->column(6, new Examples\NewDevices());
                    });

                    $column->row(Dashboard::title());
                    $column->row(Dashboard::title());
                });
            });
    }

    public function cart()
    {


    }
}