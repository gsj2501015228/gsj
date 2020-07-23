<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/6/24
 * Time: 16:48
 */

namespace App\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    //<-Model类查查看
    //定义table属性来定义自定义表明，否则默认类的小写复数形式为表名
    protected $table = 'user';



}