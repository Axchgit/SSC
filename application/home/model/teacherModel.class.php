<?php

?><?php
/**
 * admin模型类
 */
class teacherModel extends model{
	/**
	 * 验证登录
	 */
	public function checkByLogin(){
		//过滤输入数据
//		$this->filter(array('username','password'),'trim');
		//接收输入数据
		$tno = $_POST['no'];
		$password = $_POST['password'];
		//通过用户名查询密码信息
		$sql = 'select `password` from `teacher` where `tno`=:tno';
		$data = $this->db->fetchRow($sql,array(':tno'=>$tno));
		//判断用户名和密码
		if(!$data){
			//用户名不存在
			return false;
		}else{
			return true;
		}
		//返回密码比较结果
//		return md5($password.$data['salt']) == $data['password'];  //md5比较
	}
	
	/**
	 * 获取个人信息
	 */
	public function getByTno(){
   		$tno = $_SESSION['teacher'];
		$sql = "select * from `teacher` where tno=$tno";
		$data = $this->db->fetchAll($sql);
		//处理换行符
//		if($data!=false){
//  		$data['comment'] = str_replace('<br />','',$data['comment']);
//			$data['reply'] = str_replace('<br />','',$data['reply']);
//		}
		return $data;
    }
    /**
	 * 获取个人信息
	 */
	public function getCourseByTno(){
   		$tno = $_SESSION['teacher'];
		$sql = "select cname from `course` where tno=$tno";
		$data = $this->db->fetchRow($sql);
		//处理换行符
//		if($data!=false){
//  		$data['comment'] = str_replace('<br />','',$data['comment']);
//			$data['reply'] = str_replace('<br />','',$data['reply']);
//		}
		return $data;
    }
    
    /**
	 * 修改密码
	 */
	public function updatePassword(){
		$tno = $_SESSION['teacher'];
		$newpass = $_POST['newpass'];
		
		$sql = "update `teacher` set password=:password where tno=:tno ";
		//通过预处理执行SQL
		$this->db->execute($sql,array(':password'=>$newpass,':tno'=>$tno),$flag);
	

		//拼接sql语句
//		$sql = "update `teacher` set ";
//		foreach($data as $k=>$v){
//			$sql .= "`$k`=:$k,";
//		}
//		$sql = rtrim($sql,',');//去掉最右边的逗号
//		$sql .= " where password={$data['password']}";
//		//通过预处理执行SQL
//		$this->db->execute($sql,$data,$flag);
		//返回是否执行成功
		return $flag;
	
	
	}
	
	/**
	 * 作业上传
	 */
	public function insertUploadWork(){
		$data['wname'] = $_POST['wname'];
		$data['uploaddate']=date("Y-m-d H:i:s",time());
		$data['tno'] = $_SESSION['teacher'];
		//文件上传操作
		$arr=$_FILES['workfile'];
		$arr['tmp_name'];
		$data['address']="./public/teacher_work/".$arr['name'];
		move_uploaded_file($arr['tmp_name'],$data['address']);
		//获取课程号
		$sql1 = "select cno from `course` where tno={$data['tno']}";
		$data1 = $this->db->fetchAll($sql1);		
		foreach($data1 as $vv);
		$data['cno'] = $vv['cno'];	
	    //sql语句拼接
		$sql = "insert into `teacher_work` set ";
		foreach($data as $k=>$v){
			$sql .= "`$k`=:$k,";
		}
		$sql = rtrim($sql,',');//去掉最右边的逗号
//		return $sql;
//		通过预处理执行SQL
		$this->db->execute($sql,$data,$flag);
//		//返回是否执行成功
//		
		return $flag;		
	}
	/**
	 * 已上传作业列表
	 */
	public function getTeacherWorkList(){
		$tno = $_SESSION['teacher'];
		$sql = "select * from `teacher_work` where tno=$tno";
		$data = $this->db->fetchAll($sql);
		
		
		return $data;	
	}
	/**
	 * 删除作业
	 */
	public function deleteWorkById(){
		$id = (int)$_GET['id'];
		$sql = "delete from `teacher_work` where id=:id";
		//通过预处理执行SQL
		$this->db->execute($sql,array(':id'=>$id),$flag);
		//返回是否执行成功
		return $flag;
	}
	/*
	 * 获得学生列表
	 */
	public function getStudentListByTno(){
		$tno = $_SESSION['teacher'];
		$sql = "select a.*,c.grade,c.cno
    			from student a,course b,score c,teacher t
    			where a.sno=c.sno and c.cno=b.cno and b.tno=t.tno and t.tno=$tno";
    	$data = $this->db->query($sql);
    	return $data;
	}
	/**
	 * 学生评分
	 */
	public function updateStudentMark(){
		
//		$data1 = $this->getStudentListByTno();
//	
//		foreach($data1 as $vv);
		$sno = $_GET['sno'];
		$cno = $_GET['cno'];
		
		
		$data['grade'] = $_POST['grade'];

		
			//拼接sql语句
		$sql = "update `score` set ";
		foreach($data as $k=>$v){
			$sql .= "`$k`=:$k,";
		}
		$sql = rtrim($sql,',');//去掉最右边的逗号
		$sql .= " where sno=$sno and cno=$cno";
		//通过预处理执行SQL
		$this->db->execute($sql,$data,$flag);
		//返回是否执行成功
		return $flag;
	
	}
	
	/**
	 * 课程资料上传
	 */
	public function insertUploadMeterial(){
		$data['mname'] = $_POST['mname'];
		$data['uploaddate']=date("Y-m-d H:i:s",time());
		$data['tno'] = $_SESSION['teacher'];
		//文件上传操作
		$arr=$_FILES['meterialfile'];
		$arr['tmp_name'];
		$data['address']="./public/course_meterial/".$arr['name'];
		move_uploaded_file($arr['tmp_name'],$data['address']);
		//获取课程号
		$sql1 = "select cno from `course` where tno={$data['tno']}";
		$data1 = $this->db->fetchAll($sql1);		
		foreach($data1 as $vv);
		
		$data['cno'] = $vv['cno'];	
	    //sql语句拼接
		$sql = "insert into `course_meterial` set ";
		foreach($data as $k=>$v){
			$sql .= "`$k`=:$k,";
		}
		$sql = rtrim($sql,',');//去掉最右边的逗号
//		return $sql;
//		通过预处理执行SQL
		$this->db->execute($sql,$data,$flag);
//		//返回是否执行成功
//		
		return $flag;		
	}
	/**
	 * 课程资料列表
	 */
	public function getCourseMeterialList(){
	
		$tno = $_SESSION['teacher'];
		$sql = "select * from `course_meterial` where tno=$tno";
		$data = $this->db->fetchAll($sql);
		
		
		return $data;	
	
	
	}
	
	
	
    
    
}
