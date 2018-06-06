<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Cates;
use app\common\model\Goods;
class CartController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $req,$id)
    {
        $goods = Goods::get($id);

        $goods->cnt=$req->post('cnt');
          // dump($goods);
        session('carts.'.$id,$goods);  
        // dump(session('carts'));die;
        return view('cart/index',['goods'=>$goods]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add($id)
    {
        session('carts.'.$id)->cnt++;
        return redirect('/cart/save');
        
    }
    public function sub($id)
    {
        session('carts.'.$id)->cnt--;
        if(session('carts.'.$id)->cnt==0){
            session('carts.'.$id)->cnt=1;
        }
        return redirect('/cart/save');
    }
    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $carts = session('carts');

        if(empty($carts)){
            $carts = [];
        }
        $cnt = 0;
        $sum = 0;
        foreach($carts as $k=>$v){
            $cnt += $v['cnt'];
            $sum += $v['cnt'] *$v['price'];
        }
        // dump($cnt);
        // dump($sum);die;
        // halt($carts);
        session('orders.sum',$sum);
        session('orders.cnt',$cnt);
        return view('cart/save',['carts'=>$carts,'cnt'=>$cnt,'sum'=>$sum]);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        session('carts.'.$id,null);
        return redirect('/cart/save');
    }
}
