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
		//通过SESSION判断是否登录
		session_start();
		if(!isset($_SESSION['teacher'])){
			//未登录跳转到login方法
			$this->jump('index.php?p=home&c=platform&a=login');
		}
	}
	
	/**
	 * 教师主界面
	 */
	function teacher_homeAction(){
		require './application/home/view/teacher/teacher_home.html';
		//header("location:index.php?p=admin");
	}
	
	/**
	 * 教师菜单界面
	 */
		 
	function teacher_menuAction(){
		require './application/home/view/teacher/teacher_menu.html';
		//header("location:index.php?p=admin");
	}
		
	/**
	 * 教师信息界面
	 */	
//	function teacher_infoAction(){
//		require './application/home/view/teacher/teacher_info.html';
//		//header("location:index.php?p=admin");
//	}
	
	
	
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
		require './application/home/view/teacher/teacher_home.html';
	}

	/**
	 * 生成验证码
	 */
	public function captchaAction(){

		$captcha = new captcha();

		$captcha->generate();

	}
	
	/**
	 * 个人信息
	 */
	public function teacherInfoAction(){
		$teacherModel = new teacherModel();
		
		$data = $teacherModel->getByTno();
		$cInfo = $teacherModel->getCourseByTno();
		require './application/home/view/teacher/teacher_info.html';
		
	}
	
	/**
	 * 修改密码
	 */
	public function updatePasswordAction(){
		if(!empty($_POST)){
		
		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$newpasstwice = $_POST['newpasstwice'];
		
    	$teacherModel = new teacherModel();
		$data = $teacherModel->getByTno();
//		var_dump($data);
//		echo $data["sno"];
		
		foreach($data as $v);
		
		
		
		if($oldpass == $v['password'] && $newpass == $newpasstwice){
		
			$pass = $teacherModel->updatePassword($newpass);		
		}
		
//		$teacherModel->updatePassword();
		if($pass){
				echo "<script>alert('修改成功');location.href='index.php?p=home&c=teacher&a=teacherInfo';</script>";
			}else{
				echo "<script>alert('修改失败或数据库故障');location.href='index.php?p=home&c=teacher&a=teacherInfo';</script>";
			}		
			
		}
		require './application/home/view/teacher/teacher_update_password.html';
		
	}


}
