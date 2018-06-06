<?php

namespace app\common\model;

use think\Model;

class Goods extends Model
{
    protected $table = 'shop_goods';
    protected $pk = 'gid';

    public function cates()
    {
    	return $this->belongsTo('Cates','cid')->bind('cname');
    }
}
