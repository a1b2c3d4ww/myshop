<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\captcha\Captcha;
use app\common\model\Users;

class LoginController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('login/index');
    }
    public function mkcode()
    {
        $captcha = new Captcha;
        $captcha->imageW =120;
        $captcha->imageH =30;
        $captcha->length =3;
        $captcha->useCurve =false;
        $captcha->useNoise =false;
        $captcha->fontSize =16;

        return $captcha->entry();
    }

    public function dologin(Request $req)
    {
        $data = $req->post();

        $cap = new Captcha;

       if (!$cap->check($data['code'])){
        return $this->error('验证码不正确');
       }
       $condition = [];
       if($uname=$data['uname']){
            $condition[] = ['uname','=',$uname];
       }
       if($upwd=$data['upwd']){
             $condition[] = ['upwd','=',md5($upwd)];
       }
       
       $users = Users::where($condition)->find();
       session('adminFLAG',true);
       session('admindata',$users);
       if($users){
            return $this->success('登录成功','/user-index');
       }else{
            return $this->error('账号密码错误');
       }

    }
    public function logout()
    {
         session('adminFLAG',false);
         session('admindata',null);
         return $this->success('正在退出','/admin/login');

    }
}
