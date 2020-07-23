<?php
/**
 * Created by PhpStorm.
 * User: gsj
 * Date: 2020/7/9
 * Time: 16:07
 */

namespace App\Admin\Model;
use Illuminate\Database\Eloquent\Model;

class OrderForm extends Model
{
    const UPDATED_AT = null;
    //const CREATED_AT = null;
    public $timestamps = true;
    protected $table = 'order';
}