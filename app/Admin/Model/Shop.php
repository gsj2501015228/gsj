<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/3
 * Time: 9:40
 */

namespace App\Admin\Model;
use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{
    const UPDATED_AT = null;
    public $timestamps = true;
    protected $table = 'shop';
}