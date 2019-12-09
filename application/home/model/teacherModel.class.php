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
    
    
}
