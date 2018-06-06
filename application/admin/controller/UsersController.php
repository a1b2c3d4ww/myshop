<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Users;

class UsersController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $req)
    {
        $Date = $req->get();
        $condition=[];
        if(!empty($sex=$req->get('sex'))){
            $condition[]=['sex','=',$sex];
        }
          if(!empty($uname=$req->get('uname'))){
            $condition[]=['uname','like',"%$uname%"];
        }
        $users = Users::where($condition)->paginate(3)->appends($req->get());
        $pages = $users->render();
        return view('user/index',['users'=>$users,'pages'=>$pages]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('user/create');
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
        if(empty($req->post('upwd'))||empty($req->post('reupwd'))){
            return $this->error('密码不能为空');
        }
        if($req->post('upwd')!=$req->post('reupwd')){
            return $this->error('密码不一致');
        }
        $form_Data['upwd'] = md5($form_Data['upwd']);
        $form_Data['regtime'] = time();
            Users::create($form_Data,['uname','sex','auth','regtime','upwd','tel']);
        try{
        
        }catch(\Exception $e){
            return $this->error('创建失败');
        }
            return $this->success('创建成功','/user-create');
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
        $user = Users::get($id);
        return view('user/edit',['user'=>$user]);
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
        if(empty($req->post('upwd'))||empty($req->post('reupwd'))){
            return $this->error('密码不能为空');
        }
        if($req->post('upwd')!=$req->post('reupwd')){
            return $this->error('密码不一致');
        
         }
         $data['upwd'] = md5($data['upwd']);
         // dump($data);die;
       try{
            Users::update($data,['uid'=>$id]);
       }catch(\Exception $e){
        return $this->error('修改失败');  
       }
        return $this->success('修改成功','/user-index');
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
            Users::destroy($id);
        }catch(\Exception $e){
            return $this->error('删除失败');
        }
            return $this->success('删除成功');
    }
}
