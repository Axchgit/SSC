<?php
/**
 * info模型类
 */
class TeacherInfoModel extends model{
    /**
     * 信息列表
     */
    public function getAll($limit){
      $sql = "select * from teacher order by tno limit $limit";
      $data = $this->db->fetchAll($sql);
      return $data;
    }
    /**
   	  * 信息总数
	  */
    public function getNumber(){
  	  $data = $this->db->fetchRow("select count(*) from `teacher`");
	  return $data['count(*)'];
    }
    /**
	 * 取得指定tno记录
	 */
    public function getById(){
	  $tno = $_GET['tno'];
	  $sql = "select * from `teacher` where tno=$tno";
	  $data = $this->db->fetchRow($sql);
	  //处理换行符
//	  if($data!=false){
//		  $data['comment'] = str_replace('<br />','',$data['comment']);
//		  $data['reply'] = str_replace('<br />','',$data['reply']);
//	  }
	  return $data;
    }
    
    /**
     * 添加教师信息
     */    
	public function insertTeacherInfo(){
		//输入过滤
//		$this->filter(array('tno','sname','sbirthday','speciality','sclass','tc'),'htmlspecialchars');
//		$this->filter(array('teacher'),'nl2br');
		//接收输入数据
		$data['tno'] = $_POST['tno'];
		$data['tname'] = $_POST['tname'];
		$data['password'] = $_POST['password'];
		if($_POST['tsex'] =='man'){
		  $data['tsex'] = '男';		
		}else{
		  $data['tsex'] = '女';
		}
		$data['tbirthday'] = $_POST['tbirthday'];
		$data['title'] = $_POST['title'];
		$data['school'] = $_POST['school'];
//		$data['tc'] = $_POST['tc'];
	
	    //sql语句拼接
		$sql = "insert into `teacher` set ";
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
	 * 修改信息
	 */
	public function updateTeacherInfo(){
		//输入过滤
//		$this->filter(array('id'),'intval');
//		$this->filter(array('poster','mail','comment','reply'),'htmlspecialchars');
//		$this->filter(array('comment','reply'),'nl2br');
		//接收输入变量
		$data['tno'] = $_POST['tno'];
		$data['tname'] = $_POST['tname'];
		if($_POST['tsex'] =='man'){
		  $data['tsex'] = '男';		
		}else{
		  $data['tsex'] = '女';
		}
		$data['tbirthday'] = $_POST['tbirthday'];
		$data['title'] = $_POST['title'];
		$data['school'] = $_POST['school'];
//		$data['tc'] = $_POST['tc'];
		
		//拼接sql语句
		$sql = "update `teacher` set ";
		foreach($data as $k=>$v){
			$sql .= "`$k`=:$k,";
		}
		$sql = rtrim($sql,',');//去掉最右边的逗号
		$sql .= " where tno={$data['tno']}";
		//通过预处理执行SQL
		$this->db->execute($sql,$data,$flag);
		//返回是否执行成功
		return $flag;
	}
	
	/**
	 * 删除信息
	 */
	public function deleteById(){
		$tno = $_GET['tno'];
		$sql = "delete from `teacher` where tno=:tno";
		//通过预处理执行SQL
		$this->db->execute($sql,array(':tno'=>$tno),$flag);
		//返回是否执行成功
		return $flag;
	}

}

?>