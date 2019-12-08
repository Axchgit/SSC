<?php
/**
 * 管理员模块控制器类
 */
class teacherController extends platformController{
    /**
     * 构造方法
     */
	public function __construct(){
		$this->teacherCheckLogin();
	}
	
	/**
	 * 验证是否登录 
	 */
	private function teacherCheckLogin(){
		//login方法不需要验证
//		if(CONTROLLER=='teacher' && (ACTION=='login' || ACTION=='captcha')){
//
//		return ;
//	}	
		//通过SESSION判断是否登录
		session_start();
		if(!isset($_SESSION['teacher'])){
			//未登录跳转到login方法
			$this->jump('index.php?p=home&c=platform&a=login');
		}
	}
	
	/**
	 * 学生主界面
	 */
	function teacher_homeAction(){
		require './application/home/view/teacher_home.html';
		//header("location:index.php?p=admin");
	}
	
	/**
	 * 学生导航界面
	 */
		 
	function teacher_menuAction(){
		require './application/home/view/teacher_menu.html';
		//header("location:index.php?p=admin");
	}
		
	/**
	 * 学生信息界面
	 */	
	function teacher_infoAction(){
		require './application/home/view/teacher_info.html';
		//header("location:index.php?p=admin");
	}
	
	
	
	/**
	 * 学生信息
	 */
	public function infoAction(){
		//实例化teacher模型
		$teacherModel = new teacherModel();
		//取得留言总数
		$num = $teacherModel->getNumber();
		//实例化分页类
		$page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
		//取得所有留言数据
		$data = $teacherModel->getAll($page->getLimit());
		//取得分页导航链接
		$pageList = $page->getPageList();
		//载入视图文件
		require './application/home/view/teacher_home.html';
	}

	/**
	 * 登录方法
	 */
//	public function loginAction(){
//		//判断是否有表单提交
//		if(!empty($_POST)){
//			$captcha=new captcha();
//
//			//判断验证码是否正确
//
//			if(!$captcha->checkCode(strtolower($_POST['captcha']))){
//				//验证失败
//				die('输入的验证码不正确。');
//				}
//			//实例化teacher模型
//			$teacherModel = new teacherModel();
//			//调用验证方法
//			if($teacherModel->checkByLogin()){
//				//登录成功
//				session_start();
//				$_SESSION['teacher'] = 'yes';
//				//跳转
//				$this->jump('index.php?p=home&c=teacher&a=teacher_home');
//			}else{
//				//登录失败
//				die('登录失败，用户名或密码错误。');
//			}
//		}
//		//载入视图文件
//		require('./application/home/view/user_login.html');
//	}
	/**
	 * 退出方法
	 */
//	public function logoutAction(){
//		$_SESSION = null;
//		session_destroy();
//		//跳转
//		$this->jump('index.php?p=home');
//	}
	/**
	 * 生成验证码
	 */
	public function captchaAction(){

		$captcha = new captcha();

		$captcha->generate();

}


}
