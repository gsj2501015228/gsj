<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/20
 * Time: 15:06
 */

namespace App\Admin\Actions;

use Illuminate\Contracts\Support\Renderable;
use Dcat\Admin\Admin;

class Statistics implements Renderable
{
    public function script()
    {
    return<<<JS
    
console.log('');
JS;

    }
}