<?php
/**
 * 管理员模块控制器类
 */
class studentController extends platformController{
    /**
     * 构造方法
     */
	public function __construct(){
		$this->studentCheckLogin();
	}
	
	/**
	 * 验证是否登录 
	 */
	private function studentCheckLogin(){
		//login方法不需要验证
		if(CONTROLLER=='student' && (ACTION=='login' || ACTION=='captcha')){

		return ;
	}	
		//通过SESSION判断是否登录
		session_start();
		if(!isset($_SESSION['student'])){
			//未登录跳转到login方法
			$this->jump('index.php?p=home&c=platform&a=login');
		}
	}
	
	/**
	 * 生成验证码
	 */
	public function captchaAction(){

		$captcha = new captcha();

		$captcha->generate();

	}
	
	
	/**
	 * 学生主界面
	 */
	function student_homeAction(){
		require './application/home/view/student_home.html';
		//header("location:index.php?p=admin");
	}
	
	/**
	 * 学生导航界面
	 */
		 
	function student_menuAction(){
		require './application/home/view/student_menu.html';
		//header("location:index.php?p=admin");
	}
		
	/**
	 * 学生信息界面
	 */	
	function student_infoAction(){
		require './application/home/view/student_info.html';
		//header("location:index.php?p=admin");
	}
	
	
	
	/**
	 * 学生信息
	 */
	public function infoAction(){
		//实例化student模型
		$studentModel = new studentModel();
		//取得留言总数
		$num = $studentModel->getNumber();
		//实例化分页类
		$page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
		//取得所有留言数据
		$data = $studentModel->getAll($page->getLimit());
		//取得分页导航链接
		$pageList = $page->getPageList();
		//载入视图文件
		require './application/home/view/student_home.html';
	}
	/**
	 * 已选课程
	 */
	public function selectedCourseAction(){
		$studentModel = new studentModel();
		
		$data = $studentModel->getCourseBySno();
		//取得总数
		$num = $studentModel->getNumber();
		//实例化分页类
		$page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
		//取得分页导航链接	
		$pageList = $page->getPageList();
		require './application/home/view/student_selected_course.html';
	}



	/**
	 * 课程列表
	 */
	public function courseListAction(){
		//实例化comment模型
		$studentModel = new studentModel();
		//取得留言总数
		$num = $studentModel->getNumber();
		//实例化分页类
		$page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
		//取得所有留言数据
		$data = $studentModel->getAll($page->getLimit());
		//取得分页导航链接
		$pageList = $page->getPageList();
		//载入视图文件
		require './application/home/view/course_list.html';
	}
	/**
	 * 查询课程
	 */
	public function selectCourseAction(){
	
		//判断是否有表单提交
		if(!empty($_POST)){
		$studentModel = new studentModel();
		
		$num = $studentModel->getNumber();
		//实例化分页类
		$page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
		//取得分页导航链接
		$pageList = $page->getPageList();
		
		$data = $studentModel->getCourseByCname();
		
		
		require './application/home/view/course_list.html';
		
		die();
		
		}
		require './application/home/view/course_select.html';

	}
	/**
	 * 课程分数
	 */
	public function courseScoreAction(){
		$studentModel = new studentModel();
		
		$data = $studentModel->getCourseScore();
		//取得总数
		$num = $studentModel->getNumber();
		//实例化分页类
		$page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
		//取得分页导航链接	
		$pageList = $page->getPageList();
		require './application/home/view/course_score.html';
	}
	/**
	 * 学生选课
	 */
	public function pickCourseAction(){
		$studentModel = new studentModel();
		$pass = $studentModel->insertPickCourse();
		//判断是否执行成功
		if($pass){
				echo "<script>alert('选课成功');location.href='index.php?p=home&c=student&a=courseList';</script>";
			}else{
				echo "<script>alert('不能重复选课或数据库故障');location.href='index.php?p=home&c=student&a=courseList';</script>";
			}
	}
	/**
	 * 退选课程
	 */
	public function cancelSelectAction(){
		$studentModel = new studentModel();
		$pass = $studentModel->cancelSelect();
			//判断是否执行成功
		if($pass){
				echo "<script>alert('退选成功');location.href='index.php?p=home&c=student&a=courseList';</script>";
			}else{
				echo "<script>alert('你还没有选择此课程或数据库故障');location.href='index.php?p=home&c=student&a=courseList';</script>";
			}
	}
	/**
	 * 学生个人信息
	 */	
	public function studentInfoAction(){
		$studentModel = new studentModel();
		$data = $studentModel->getBySno();
		require './application/home/view/student_info.html';
	
	}
	/**
	 * 修改密码
	 */
	public function updatePasswordAction(){
		if(!empty($_POST)){
		
		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$newpasstwice = $_POST['newpasstwice'];
		
    	$studentModel = new studentModel();
		$data = $studentModel->getBySno();
//		var_dump($data);
//		echo $data["sno"];
		
		foreach($data as $v);
		
		
		
		if($oldpass == $v['password'] && $newpass == $newpasstwice){
		
			$pass = $studentModel->updatePassword();		
		}
		
//		$studentModel->updatePassword();
		if($pass){
				echo "<script>alert('修改成功');location.href='index.php?p=home&c=student&a=studentInfo';</script>";
			}else{
				echo "<script>alert('修改失败或数据库故障');location.href='index.php?p=home&c=student&a=studentInfo';</script>";
			}		
			
		}
		require './application/home/view/student_update_password.html';
		
	}
	
	


}

