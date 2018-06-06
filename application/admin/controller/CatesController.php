<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Cates;
class CatesController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($pid=0)
    {
        $cates = Cates::getcatesorder($pid);
        return view('cate/index',['cates'=>$cates]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create($id)
    {
        // dump($id);die;
        $cates = Cates::getcatesorder();
        // dump($cates);die;
        return view('cate/create',['cates'=>$cates,'id'=>$id]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $req)
    {
        $form_Data = $req->post();
        try{
            Cates::create($form_Data,true);
        }catch(\Exception $e){
            return $this->error('添加失败');
        }
            return $this->success('添加成功');
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
        $cate = Cates::get($id);
        return view('cate/edit',['cate'=>$cate]);
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
        $data = $req->post();
        try{
            Cates::update($data,['cid'=>$id]);
        }catch(\Exception $e){
            return $this->error('修改失败');
        }
            return $this->success('修改成功','/cate/index');

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $date = Cates::where('pid','=',$id)->find();
        if($date){
            return $this->error('父类不可删除');
        }
        try{
            Cates::destroy($id);
        }catch(\Exception $e){
            return $this->error('删除失败');
        }
            return $this->success('删除成功');
        
    }
}
