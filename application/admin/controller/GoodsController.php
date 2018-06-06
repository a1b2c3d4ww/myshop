<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Cates;
use think\Image;

class GoodsController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $req)
    {   
        $condition=[];
        if(!empty($status=$req->get('status'))){
            $condition[] = ['status','=',$status];
        }
        if(!empty($gname=$req->get('gname'))){
            $condition[] = ['gname','like',"%$gname%"];
        }

        $goods = Goods::with('cates')->where($condition)->paginate(10)->appends($req->get());
        $pages = $goods->render();
        dump($goods);

        return view('good/index',['goods'=>$goods,'pages'=>$pages]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $cates = Cates::getcatesorder();
        return view('good/create',['cates'=>$cates]);
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
        // halt($req->post());
        $file = $req->file('smallimg');
     
        if(empty($file)){
            return $this->error('未上传图片');
        }
        if(empty($form_Data['gname'])){
            return $this->error('商品名称不能为空');
        }
        $info = $file->move(config('save_path'));   
        $fileName = $info->getsaveName();
        $form_Data['gpic'] = $info->getsaveName();
        $form_Data['ctime'] = time();
        Image::open($file)->thumb(150,150)->save(config('save_path').$fileName.'sm.jpg');
        try{
            Goods::create($form_Data,true);
        }catch(\Exception $e){
            return $this->error('创建失败');
        }
            return $this->success('创建成功');
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
        $cates = Cates::getcatesorder();
        $good = Goods::get($id);
        return view('good/edit',['cates'=>$cates,'good'=>$good,'id'=>$id]);
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
        $form_data = $req->post();
        $file = $req->file('smallimg');
        if($file){
        $info = $file->move(config('save_path'));
        $fileName = $info->getsaveName();
        $form_data['gpic']=$fileName;
        Image::open($file)->thumb(150,150)->save(config('save_path').$fileName.'sm.jpg');
        }
        try{
            Goods::update($form_data,['gid'=>$id]);
        }catch(\Exception $e){
            return $this->error('修改失败');
        }
            return $this->success('修改成功','/good/index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        try{
            Goods::destroy($id);
        }catch(\Exception $e){
            return $this->error('删除失败');
        }
            return $this->success('删除成功');
    }
    public function upstatus($id)
    {
      $status=2;
        
        Goods::update(["status"=>$status],['gid'=>$id]);
        return  redirect('/good/index');
    }
     public function downstatus($id)
    {
         $status=3;
        
        Goods::update(["status"=>$status],['gid'=>$id]);
        return  redirect('/good/index');
    }
}
