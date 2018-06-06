<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Orders;

class OrdersController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function getinfo()
    {
        return view('order/getinfo');
    }
    public function finish()
    {   
        session('orders.oid',date('Ymd').rand(10000,100000));
        session('orders.uid',session('userInfo.uid'));
        session('orders.status',1);
        session('orders.otime',time());
        $date = session('orders');
        Orders::create($date)->details()->saveALL(session('carts'));
        session('carts',null);
        return view('order/finish',['orders'=>$date]);

        
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function myorder()
    {
        $uid = session('userInfo.uid');
        $orders = Orders::where(['uid'=>$uid])->select();
        // halt($orders);
        // halt($orders);
        return view('order/myorder',['orders'=>$orders]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $req)
    {
        session('orders.rec',$req->post('rec'));
        session('orders.addr',$req->post('addr'));
        session('orders.tel',$req->post('tel'));
        session('orders.umsg',$req->post('umsg'));
        $orders = session('orders');
        $carts = session('carts');
        // halt($carts);
        // halt($orders);
        return view('order/commit',['carts'=>$carts,'orders'=>$orders]);

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
        //
    }
}
