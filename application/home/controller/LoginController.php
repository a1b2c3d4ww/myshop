<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Users;
use think\captcha\Captcha;
class LoginController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function login()
    {
        return view('login/login');
    }

   
     public function dologin(Request $req)
    {
        $condition = [];
        if(!empty($uname = $req->post('uname'))){
            $condition[] = ['uname','=',$uname];
        }
        if(!empty($upwd =$req->post('upwd'))){
            $condition[] = ['upwd','=',md5($upwd)];
        }
        $user = Users::where($condition)->find();

        if($user){
            session('userInfo',$user);
            session('userFlag',true);
            $url = session('backurl');
            if($url){
                return $this->success('登录成功',$url);
            }
            return $this->success('登录成功','/');
        }
            return $this->error('账号或密码不正确');


    }
    public function logout()
    {
        session('userInfo',null);
        session('userFlag',false);
        session('carts',null);
        return view('login/login');       
    }

    public function register()
    {
        return view('login/register');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $req)
    {
        // halt($req->post());
        $cap = new Captcha;
        if(!$cap->check($req->post('code'))){
            return $this->error('验证码不正确');
        }
        if(empty($req->post('upwd'))||empty($req->post('reupwd'))){
            return $this->error('密码不能为空');
        }
        if($req->post('upwd')!=$req->post('reupwd')){
            return $this->error('密码不一致');
        }
        $formData = $req->post();
        $formData['upwd'] = md5($formData['upwd']);
        $formData['regtime'] = time();
        try{
            Users::create($formData,['uname','upwd','tel','regtime']);
        }catch(\Exception $e){
            return $this->error('注册失败');
        }
            return $this->success('注册成功','/home/login');

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
