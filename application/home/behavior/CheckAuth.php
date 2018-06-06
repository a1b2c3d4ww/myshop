<?php
	namespace app\home\behavior;
	use think\Controller;
  class CheckAuth extends Controller
  {
  		function run(){
        $url = $_SERVER['REQUEST_URI'];
        session('backurl',$url);
  			if(empty(session('userFlag'))){
  				return $this->error('请登录','/home/login');
  			}else{
          session('backurl',null);
        }
  		} 
  }