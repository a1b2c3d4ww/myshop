<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Cates;
use app\common\model\Goods;
use app\common\model\Users;
use think\Image;
class FirstController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
      
       $cates = Cates::getzilei();
       // dump($cates);
        return view('first/index',['cates'=>$cates]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function list(Request $req,$id)
    {

       
        $condition =[];

        if(!empty($id)){
             $cid = Cates::getsub($id);
            $condition[]=['cid','in',$cid];
        }
        if(!empty($gname =$req->get('gname')))
        {
            $condition[] = ['gname','like',"%$gname%"];
        }
        // halt($condition);
        $goods = Goods::where($condition)->select();

        // halt($goods);

        return view('first/list',['goods'=>$goods]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $req)
    {
        $uid = session('userInfo.uid');
        $formData = $req->post();
        $file =$req->file('smallimg');
        if($file){
            $info = $file->move(config('save_path'));
            $fileName = $info->getsaveName();
            $formData['upic'] = $fileName;
            Image::open($file)->thumb(150,150)->save(config('save_path').$fileName.'sm.jpg');
        }

        try{
            Users::update($formData,['uid'=>$uid]);
        }catch(\Excption $e){
            return $this->error('修改失败');
        }
            // halt($formData);
            $user = Users::get($uid);
            session('userInfo',$user);
            return $this->success('修改完成','/');

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
       $good = Goods::get($id);
       // dump($good);
        return view('first/read',['good'=>$good]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function myjd()
    {
        // halt(session('userInfo'));
        $user = (session('userInfo'));

        // halt($user);
        return view('first/myjd',['user'=>$user]);
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
