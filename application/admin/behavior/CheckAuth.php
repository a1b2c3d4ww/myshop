<?php

namespace app\admin\behavior;
use think\Controller;
	class CheckAuth extends Controller
	{
		public function run()
		{
			if(empty(session('adminFLAG'))){
				return $this->error('请先登录','/admin/login');
			}
		}
	}

