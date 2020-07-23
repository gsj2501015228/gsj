<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;
use Dcat\Admin\Layout\Navbar;
use Dcat\Admin\Layout\Menu;


Admin::navbar(function (Navbar $navbar) {

    $navbar->left('导航左');

});
Admin::menu(function (Menu $menu) {
    $menu->add([
        [
            'id' => '1', // 此id只要保证当前的数组中是唯一的即可
            'title' => '购物',
            'icon' => 'fa-file-text-o',
            'uri' => '',
            'parent_id' => 0,
        ],
        [
            'id' => '2', // 此id只要保证当前的数组中是唯一的即可
            'title' => '商品',
            'icon' => 'fa-file-text-o',
            'uri' => '../admin/goods',
            'parent_id' => 1,
        ],
        [
            'id' => '3', // 此id只要保证当前的数组中是唯一的即可
            'title' => '购物车',
            'icon' => 'fa-file-text-o',
            'uri' => '../admin/shopping',
            'parent_id' => 1,
        ],
        [
            'id' => '4', // 此id只要保证当前的数组中是唯一的即可
            'title' => '订单',
            'icon' => 'fa-file-text-o',
            'uri' => '../admin/order',
            'parent_id' => 1,
        ],

    ]);
});
/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
