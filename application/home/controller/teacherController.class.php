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
//			var_dump($data);
//			echo $data["sno"];
		
			foreach($data as $v);
					
			if($oldpass == $v['password'] && $newpass == $newpasstwice){		
				$pass = $teacherModel->updatePassword($newpass);		
			}
		
//			$teacherModel->updatePassword();
			if($pass){
				echo "<script>alert('修改成功');location.href='index.php?p=home&c=teacher&a=teacherInfo';</script>";
			}else{
				echo "<script>alert('修改失败或数据库故障');location.href='index.php?p=home&c=teacher&a=teacherInfo';</script>";
			}		
			
		}
		require './application/home/view/teacher/teacher_update_password.html';
		
	}
	
	/**
	 * 作业上传
	 */
	public function teacherWorkUploadAction(){
		if(!empty($_POST)){
		
		$teacherModel = new teacherModel();
		$pass = $teacherModel->insertUploadWork();
		
		if($pass){
				echo "<script>alert('上传成功');location.href='index.php?p=home&c=teacher&a=teacherWorkList';</script>";
			}else{
				echo "<script>alert('上传失败或数据库故障');location.href='index.php?p=home&c=teacher&a=teacherWorkList';</script>";
			}		
			
		}
		require './application/home/view/teacher/teacher_work_upload.html';			
	}
	/**
	 * 已上传作业列表
	 */
	public function teacherWorkListAction(){
		$teacherModel = new teacherModel();
		$data = $teacherModel->getTeacherWorkList();
		require './application/home/view/teacher/teacher_work_list.html';			
		
	
	}
	/**
	 * 删除作业
	 */
	public function deleteWorkAction(){		
		$teacherModel = new teacherModel();
		$pass = $teacherModel->deleteWorkById();
		
		if($pass){
			echo "<script>alert('删除成功');location.href='index.php?p=home&c=teacher&a=teacherWorkList';</script>";
		}else{
			echo "<script>alert('删除失败或数据库故障');location.href='index.php?p=home&c=teacher&a=teacherWorkList';</script>";
		}		
				
	}
	/**
	 * 学生列表
	 */
	public function studentListAction(){
		$teacherModel = new teacherModel();
		$data = $teacherModel->getStudentListByTno();
//		foreach($data as $v);
		
//		echo $data['grade'];

		require './application/home/view/teacher/teacher_student_list.html';			
		
	}
	/**
	 * 学生评分
	 */
	public function studentMarkAction(){
		if(!empty($_POST)){	
			$teacherModel = new teacherModel();
			$pass = $teacherModel->updateStudentMark();
			if($pass){
				echo "<script>alert('打分成功');location.href='index.php?p=home&c=teacher&a=studentList';</script>";
			}else{
				echo "<script>alert('数据库故障');location.href='index.php?p=home&c=teacher&a=studentList';</script>";
			}
		}
	
		
		require './application/home/view/teacher/teacher_student_mark.html';			
		
	}
	
	/**
	 * 作业上传
	 */
	public function courseMaterialUploadAction(){
		if(!empty($_POST)){
		
		$teacherModel = new teacherModel();
		$pass = $teacherModel->insertUploadMaterial();
		
		if($pass){
				echo "<script>alert('上传成功');location.href='index.php?p=home&c=teacher&a=courseMaterialList';</script>";
			}else{
				echo "<script>alert('上传失败或数据库故障');location.href='index.php?p=home&c=teacher&a=courseMaterialList';</script>";
			}		
			
		}
		require './application/home/view/teacher/teacher_Material_upload.html';			
	}
	/**
	 * 课程资料列表
	 */
	public function courseMaterialListAction(){
	
		$teacherModel = new teacherModel();
		$data = $teacherModel->getCourseMaterialList();
		require './application/home/view/teacher/teacher_Material_list.html';		
	
	}
	
	/**
	 * 文件下载    文件下载直接点击地址链接即可
	 */
//	public function downloadMaterialAction(){
//	
//			
//		$teacherModel = new teacherModel();
//		$v = $teacherModel->getMaterialAddressByID();	
//		$data = mb_convert_encoding($v, 'UTF-8');
//		echo $data;			
//	
////		header("location:.$data");	//提示：此方法获取的地址中文部分为乱码
//	 
//	}
	
	/**
	 * 删除课程资料
	 */
	public function deleteMaterialAction(){		
		$teacherModel = new teacherModel();
		$pass = $teacherModel->deleteMaterialById();
		
		if($pass){
			echo "<script>alert('删除成功');location.href='index.php?p=home&c=teacher&a=courseMaterialList';</script>";
		}else{
			echo "<script>alert('删除失败或数据库故障');location.href='index.php?p=home&c=teacher&a=courseMaterialList';</script>";
		}		
				
	}
	/**
	 * 学生上传作业
	 */
	public function studentWorkListAction(){
		$teacherModel = new teacherModel();
		$data = $teacherModel->getStudentWorkByCno();
		require './application/home/view/teacher/student_work_list.html';		
		
	
	}
	/**
	 * 作业批改
	 */
	public function studentWorkMarkAction(){
	
		if(!empty($_POST)){	
			$teacherModel = new teacherModel();
			$pass = $teacherModel->updateStudentWorkMark();
			if($pass){
				echo "<script>alert('打分成功');location.href='index.php?p=home&c=teacher&a=studentWorkList';</script>";
			}else{
				echo "<script>alert('数据库故障');location.href='index.php?p=home&c=teacher&a=studentWorkList';</script>";
			}
		}
	
		
		require './application/home/view/teacher/student_work_mark.html';			
		
	
	
	}
	


}
