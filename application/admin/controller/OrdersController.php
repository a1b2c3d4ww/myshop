<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Orders;
use app\common\model\Details;
class OrdersController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $orders = Orders::select();
        return view('order/index',['orders'=>$orders]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
   
        $details = Details::with('goods')->where('oid','=',$id)->select();
        // halt($detail);
        return view('order/read',['details'=>$details]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $order = Orders::get($id);

        return view('order/edit',['order'=>$order]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $req, $id)
    {
        $formData = $req->post();
        try{
            Orders::update($formData,['oid'=>$id]);
        }catch(\Exception $e){
            return $this->error('修改失败');
        }
            return $this->success('修改成功','/order/index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
       // $row =  Orders::destroy($id);
       $data = Details::where('oid','=',$id)->select();
       // halt($data);
       $did=[];
       foreach($data as $k=>$v){
            $did[]=$v['did'];
       }
       $ord = Orders::destroy($id);
       $det = Details::destroy($did);
       if($ord&&$det){
            return $this->success('删除订单成功');
       }
            return $this->error('订单删除失败');

    }
}
