<?php
/**
 * admin模型类
 */
class studentModel extends model{
    /**
     * 信息列表
     */
    public function getAll($limit){
      $sql = "select * from Course order by cno limit $limit";
      $data = $this->db->fetchAll($sql);
      return $data;
    }
    /**
   	  * 信息总数
	  */
    public function getNumber(){
  	  $data = $this->db->fetchRow("select count(*) from `Course`");
	  return $data['count(*)'];
    }
    /**
     * 获取已选课程信息总数
     */
    public function getCourseNumber(){
//  	$sno = $_GET['sno'];
//  	session_start();
		$sno = $_SESSION['student'];
    	$sql = "select count(*) 
    			from student a,course b,score c
    			where a.sno=c.sno and c.cno=b.cno and a.sno=$sno";
    	$data = $this->db->fetchRow($sql);
    	return $data['count(*)'];
    }
	/**
	 * 取得指定学号数据
	 */
    public function getBySno(){
   		$sno = $_SESSION['student'];
		$sql = "select * from `student` where sno=$sno";
		$data = $this->db->fetchAll($sql);
		//处理换行符
//		if($data!=false){
//  		$data['comment'] = str_replace('<br />','',$data['comment']);
//			$data['reply'] = str_replace('<br />','',$data['reply']);
//		}
		return $data;
    }
       /**
	  * 取得指定cno记录
	  */
    public function getByCno(){
	  $cno = (int)$_GET['cno'];
	  $sql = "select * from `Course` where cno=$cno";
	  $data = $this->db->fetchRow($sql);
	  //处理换行符
//	  if($data!=false){
//		  $data['comment'] = str_replace('<br />','',$data['comment']);
//		  $data['reply'] = str_replace('<br />','',$data['reply']);
//	  }
	  return $data;
    }
    /**
     * 获取已选课程总数
     */
    public function getCourseBySnoTwo(){
//  	$sno = $_GET['sno'];
//  	session_start();
		$sno = $_SESSION['student'];
    	$sql = "select b.* 
    			from student a,course b,score c
    			where a.sno=c.sno and c.cno=b.cno and a.sno=$sno";
    	$data = $this->db->query($sql);
    	return $data;
    }

    /**
     * 获取已选课程数据
     */
    public function getCourseBySno($limit){
//  	$sno = $_GET['sno'];
//  	session_start();
		$sno = $_SESSION['student'];
    	$sql = "select b.* 
    			from student a,course b,score c
    			where a.sno=c.sno and c.cno=b.cno and a.sno=$sno
    			order by cno limit $limit";
    	$data = $this->db->query($sql);
    	return $data;
    }
    /**
     * 查询课程
     */
    public function getCourseByCname($limit){
		$cname = $_POST['cname'];
	  	$sql = "select * from `Course` where cname='$cname'
	  			order by cno limit $limit";
	  	$data = $this->db->fetchAll($sql);
	  //处理换行符
//	  if($data!=false){
//		  $data['comment'] = str_replace('<br />','',$data['comment']);
//		  $data['reply'] = str_replace('<br />','',$data['reply']);
//	  }
	 	 return $data;
    }
    /**
     * 课程分数
     */
    public function getCourseScore($limit){
//  	$sno = $_GET['sno'];
//  	session_start();
		$sno = $_SESSION['student'];
    	$sql = "select b.cno,b.cname,c.grade 
    			from student a,course b,score c
    			where a.sno=c.sno and c.cno=b.cno and a.sno=$sno
    			order by cno limit $limit";
    	$data = $this->db->query($sql);
    	return $data;
    }
    /**
     * 选课
     */
    public function insertPickCourse(){
    
    	$data['sno'] = $_SESSION['student'];
    	$data['cno'] = $_GET['cno'];


		$sql = "insert into `score` set ";
		foreach($data as $k=>$v){
			$sql .= "`$k`=:$k,";
		}
		$sql = rtrim($sql,',');//去掉最右边的逗号
//		return $sql;
//		通过预处理执行SQL
		$this->db->execute($sql,$data,$flag);
	
    	return $flag;    
    }
	
	/**
     * 退选课程
     */
    public function cancelSelect(){
		$cno = $_GET['cno'];
		$sno = $_SESSION['student'];
		$sql = "delete from `score` where cno=:cno and sno=:sno";
		//通过预处理执行SQL
		$this->db->execute($sql,array(':cno'=>$cno,':sno'=>$sno),$flag);
		//返回是否执行成功
		return $flag;
	}
	/**
	 * 修改密码
	 */
	public function updatePassword(){
		$sno = $_SESSION['student'];
		$newpass = $_POST['newpass'];
		
		$sql = "update `student` set password=:password where sno=:sno ";
		//通过预处理执行SQL
		$this->db->execute($sql,array(':password'=>$newpass,':sno'=>$sno),$flag);
	

		//拼接sql语句
//		$sql = "update `student` set ";
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
	 * 课程作业列表
	 */
	public function getWorkBySno(){
		$sno = $_SESSION['student'];
		$sql = "select c.*
    			from student a,score b,teacher_work c
    			where a.sno=b.sno and b.cno=c.cno and a.sno=$sno";
	    $data = $this->db->query($sql);
    	return $data;
	}
	
	/**
	 * 完成作业上传
	 */
	public function insertUploadWork(){
		$data['wname'] = $_POST['wname'];
		$data['uploaddate']=date("Y-m-d H:i:s",time());
		$data['sno'] = $_SESSION['student'];
		//文件上传操作
		$arr=$_FILES['workfile'];
		$arr['tmp_name'];
		$data['address']="./public/student_work/".$arr['name'];
		move_uploaded_file($arr['tmp_name'],$data['address']);
		//获取学生姓名
		$data1 = $this->getBySno();
		foreach($data1 as $vv);
		$data['sname'] = $vv['sname'];
		
		
//		$sql1 = "select cno from `course` where tno={$data['tno']}";
//		$data1 = $this->db->fetchAll($sql1);		
//		foreach($data1 as $vv);		
		$data['cno'] = $_POST['cno'];	
	    //sql语句拼接
		$sql = "insert into `student_work` set ";
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
	public function getStudentWorkList(){
		$sno = $_SESSION['student'];
		$sql = "select * from `student_work` where sno=$sno";
		$data = $this->db->fetchAll($sql);
		
		
		return $data;	
	}
	/**
	 * 删除作业
	 */
	public function deleteWorkById(){
		$id = (int)$_GET['id'];
		$sql = "select `address` from `student_work` where id=$id";
		$data = $this->db->fetchRow($sql);
	
		if(unlink($data['address'])){
			$sql = "delete from `student_work` where id=:id";
			//通过预处理执行SQL
			$this->db->execute($sql,array(':id'=>$id),$flag);
			//返回是否执行成功
			return $flag;
		}
	}
	
	/**
	 * 课程资料列表
	 */
	public function getMaterialBySno(){
		$sno = $_SESSION['student'];
		$sql = "select c.*
    			from student a,score b,course_material c
    			where a.sno=b.sno and b.cno=c.cno and a.sno=$sno";
	    $data = $this->db->query($sql);
    	return $data;
	}

	
	
	
	
	
	
}
