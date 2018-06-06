<?php

namespace app\common\model;

use think\Model;

class Cates extends Model
{
    protected $table = 'shop_cates';
    protected $pk ='cid';

    public static function getzilei()
    {
        $cates = Cates::select();
        // halt($cates);
       
       
        return self::zilei($cates);
    }
    public static function zilei($cates,$pid=0)
    {         $arr = [];
        foreach ($cates as $k=>$v){
            if($v->pid==$pid){
            

                $v->sub = self::zilei($cates,$v->cid);
                  $arr[]=$v;

            }
        }
        return $arr;
    }
    public static function getsub($cid=0)
    {
        $cates = Cates::select();

        $arr=[];
        $arr[]=$cid;
        
        return self::getzileisub($cates,$arr,$cid);
    }
    public static function getzileisub($cates,&$arr,$cid=0)
    {  
        foreach ($cates as $k=>$v){
           if($v->pid==$cid){
            $arr[] = $v->cid;
            self::getzileisub($cates,$arr,$v->cid);
           }
        }
        return $arr;

    }

    public static function getcatesorder()
    {
    	$arr =[];
    	$cates = Cates::select();
    	return self::order($cates,$arr);
    }

    public static function order($cates,&$arr,$pid=0,$level=0)
    {
    	foreach($cates as $k=>$v){
    		if($v->cid==$pid){
    			$v['level'] = $level;
    			$arr[$v->cid]= $v;
    		}
    		if($v->pid==$pid){
    			$v['level'] = $level;
    			$arr[$v->cid]= $v;
    			self::order($cates,$arr,$v->cid,$level+1);
    		}

    	}
    	return $arr;
    }
}
