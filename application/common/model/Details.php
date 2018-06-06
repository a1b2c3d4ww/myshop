<?php

namespace app\common\model;

use think\Model;

class Details extends Model
{
    protected $table = 'shop_details';
    protected $pk = 'did';

    public function orders()
    {
    	return $this->belongsTo('Orders','oid');
    }
    public  function goods(){
        return $this->belongsTo('Goods','gid')->bind('gname,gpic');
    }
    protected static function init()
    {
    	self::afterInsert(function($details){
    		$goods = Goods::get($details->gid)->setDec('stock',$details->cnt);
    	});
    }
}
