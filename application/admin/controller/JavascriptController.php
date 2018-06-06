<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Users;
use app\common\model\Cates;
class JavascriptController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }
    public function js1()
    {
        return view('javascript/js1');
    }
    public function js2()
    {
        return view('javascript/js2');
    }
    public function ajax($id)
    {
        
        // echo  '12345';

        // var_dump('123456789');

        // echo $id;  
        // // 关联数组
        $res = Users::get($id);


        //索引数组
        $res = ['apple','banana','lemon','pear','orange'];


        //二维数组
        $res = Cates::select();

        // var_dump($res); 
        //把php数组 装换成json字符串
        // $data = json_encode($res);
        // echo $data;

        return json($res);


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
