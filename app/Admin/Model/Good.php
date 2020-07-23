<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/6/29
 * Time: 13:58
 */

namespace App\Admin\Model;
use Illuminate\Database\Eloquent\Model;


class Good extends Model
{
    const UPDATED_AT = null;
    //const CREATED_AT = null;
    public $timestamps = true;
    protected $table = 'goods';
}