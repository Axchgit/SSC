<?php
/**
 * home平台控制器
 */
class platformController{
	
	/**
	 * 载入登录视图
	 */
//	function user_loginViewAction(){
//		require './application/home/view/user_login.html';
//		//header("location:index.php?p=admin");
//	}
	
	/**
	 * 登录方法
	 */
	public function loginAction(){
		//判断是否有表单提交
		if(!empty($_POST)){
			$captcha=new captcha();

			//判断验证码是否正确

			if(!$captcha->checkCode(strtolower($_POST['captcha']))){
				//验证失败
//					$this->jump('index.php?p=home&c=student&a=login');
				
				die('输入的验证码不正确。');

				
				}
			//实例化student模型
			$platformModel = new platformModel();
			//调用验证方法
			if($platformModel->checkByLogin()){
				//登录成功
				if($_POST['user'] == 'student'){
					$sno = $_POST['no'];
					session_start();
					$_SESSION['student'] = $sno;
					//跳转
					$this->jump('index.php?p=home&c=student&a=student_home');
				}
				if($_POST['user'] == 'teacher'){
					$tno = $_POST['no'];
					session_start();
					$_SESSION['teacher'] = $tno;
					//跳转
					$this->jump('index.php?p=home&c=teacher&a=teacher_home');
				}
				
			}else{
				//登录失败
				die('登录失败，用户名或密码错误。');
			}
			
		
		}
		require './application/home/view/user_login.html';
		//载入视图文件
//		require('./application/home/view/user_login.html');
	}
	
	/**
	 * 退出方法
	 */
	public function logoutAction(){
	    session_start();
	    unset($_SESSION);
		$_SESSION = null;
		session_destroy();
		//跳转
		$this->jump('index.php?p=home&c=student&a=student_home');
	}


	/**
	 * 构造方法
	 */
//	public function __construct(){
//		$this->checkLogin();
//	}
	/**
	 * 验证当前用户是否登录
	 */
//	private function studentCheckLogin(){
//		//login方法不需要验证
//		if(CONTROLLER=='student' && (ACTION=='login' || ACTION=='captcha')){
//
//		return ;
//
//	}
//	
//		//通过SESSION判断是否登录
//		session_start();
//		if(!isset($_SESSION['student'])){
//			//未登录跳转到login方法
//			$this->jump('index.php?p=home&c=student&a=login');
//		}
//	}
//	
//	private function teacherCheckLogin(){
//		//login方法不需要验证
//		if(CONTROLLER=='teacher' && (ACTION=='login' || ACTION=='captcha')){
//
//		return ;
//
//	}
//	
//		//通过SESSION判断是否登录
//		session_start();
//		if(!isset($_SESSION['teacher'])){
//			//未登录跳转到login方法
//			$this->jump('index.php?p=home&c=student&a=login');
//		}
//	}

	/**
	 * 控制器选择
	 */
	
	function userViewAction(){
		$user = $_POST['user'];
		if($user == 'student'){
		$this->jump('index.php?p=home&c=student&a=login');
		
		}else{
		$this->jump('index.php?p=home&c=teacher&a=login');
		
		}

//		require './application/home/view/student_home.html';
		//header("location:index.php?p=admin");
	}

	/**
	 * 跳转方法
	 */
	protected function jump($url){
		header("Location: $url");
		die;
	}






//
//	/**
//	 * 跳转
//	 * @param $url     目标URL
//	 * @param $msg=''  提示信息
//	 * @param $time=2  提示停留秒数
//	 */
//	protected function jump($url,$msg='',$time=2){
//		if($msg==''){
//			//没有提示信息
//			header('Location: $url');
//		}else{
//			//有提示信息
//			require('./application/home/view/jump.html');
//		}
//		//终止脚本执行
//		die;
//	}
}
