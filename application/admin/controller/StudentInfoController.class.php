<?php
/**
 * 留言模块控制器类
 */
class StudentInfoController extends platformController{
	/**
	 * 留言列表
	 */
	public function listAction(){
		//实例化comment模型
		$StudentInfoModel = new StudentInfoModel();
		//取得留言总数
		$num = $StudentInfoModel->getNumber();
		//实例化分页类
		$page = new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);
		//取得所有留言数据
		$data = $StudentInfoModel->getAll($page->getLimit());
		//取得分页导航链接
		$pageList = $page->getPageList();
		//载入视图文件
		require './application/admin/view/StudentInfo_list.html';
	}
	
	function homeAction(){
			require './application/admin/view/home.html';
			//header("location:index.php?p=admin");
	}
		
	function menuAction(){
			require './application/admin/view/menu.html';
			//header("location:index.php?p=admin");
	}
	function addViewAction(){
			require './application/admin/view/StudentInfo_add.html';
			//header("location:index.php?p=admin");
	}
	
	
	function updateViewAction(){
	
	$StudentInfoModel = new StudentInfoModel();
	$data = $StudentInfoModel->getById();

			require './application/admin/view/StudentInfo_update.html';
			//header("location:index.php?p=admin");
	}
		
		
	public function addAction(){
		//判断是否是POST方式提交
		if(empty($_POST)){
			return false;
		}
		//实例化comment模型
		$StudentInfoModel = new StudentInfoModel();
		//调用insert方法
		$pass = $StudentInfoModel->insert();
		//判断是否执行成功
		if($pass){
				echo "<script>alert('操作成功');location.href='index.php?p=admin&c=StudentInfo&a=list';</script>";
			}else{
				echo "<script>alert('操作不成功');location.href='index.php?p=admin&c=StudentInfo&a=updateView';</script>";
			}
//		if($pass){
//			//成功时
//			$this->jump('index.php?p=admin&c=StudentInfo&a=home','发表留言成功');
//		}else{
//			//失败时
//			$this->jump('index.php?p=admin&c=StudentInfo&a=home','发表留言失败');
//		}
	}
	
		public function updateAction(){
		//判断是否是POST方式提交
		if(empty($_POST)){
			return false;
		}
		//实例化comment模型
		$StudentInfoModel = new StudentInfoModel();
		//调用insert方法
		$pass = $StudentInfoModel->save();
		//判断是否执行成功
		if($pass){
				echo "<script>alert('操作成功');location.href='index.php?p=admin&c=StudentInfo&a=list';</script>";
			}else{
				echo "<script>alert('操作不成功');location.href='index.php?p=admin&c=StudentInfo&a=addView';</script>";
			}

	}
	
	
	
	public function deleteAction(){
		if(!isset($_GET['sno'])){
			return false;
		}
		//实例化comment模型
		$StudentInfoModel = new StudentInfoModel();
		//删除指定ID记录
		if( $StudentInfoModel->deleteById() ){
			//完成后跳转
			$this->jump('index.php?p=admin&c=StudentInfo&a=list');
		}else{
			die('删除留言失败。');
		}
	}
	
	public function testAction(){
	    if(empty($_POST)){
			return false;
		}
		//实例化comment模型
		$StudentInfoModel = new StudentInfoModel();
		//调用insert方法
		$pass = $StudentInfoModel->save();
		//判断是否执行成功
		echo $pass;
			
			}
	
	
	
	/**
	 * 回复/修改
	 */
//	public function replyAction(){
//		if(!isset($_GET['id'])){
//			return false;
//		}
//		//实例化comment模型
//		$commentModel = new commentModel();
//		//取得指定ID的记录
//		$data = $commentModel->getById();
//		if($data==false){
//			die('找不到这条记录。');
//		}
//		//载入视图文件
//		require './application/admin/view/comment_reply.html';
//	}
//	/**
//	 * 更新留言
//	 */
//	public function updateAction(){
//		if(empty($_POST)){
//			return false;
//		}
//		//实例化comment模型
//		$commentModel = new commentModel();
//		//更新记录
//		if( $commentModel->save() ){
//			$this->jump('index.php?p=admin&c=comment&a=list');
//		}else{
//			die('更新记录失败。');
//		}
//	}
//	/**
//	 * 删除留言
//	 */
//	public function deleteAction(){
//		if(!isset($_GET['id'])){
//			return false;
//		}
//		//实例化comment模型
//		$commentModel = new commentModel();
//		//删除指定ID记录
//		if( $commentModel->deleteById() ){
//			//完成后跳转
//			$this->jump('index.php?p=admin&c=comment&a=list');
//		}else{
//			die('删除留言失败。');
//		}
//	}
}
