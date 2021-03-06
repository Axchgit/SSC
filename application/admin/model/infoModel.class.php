<?php
/**
 * info模型类
 */
class infoModel extends model{
    /**
     * 信息列表
     */
    public function getAll($limit){
      $sql = "select * from student order by sno limit $limit";
      $data = $this->db->fetchAll($sql);
      return $data;
    }
    /**
   	  * 信息总数
	  */
    public function getNumber(){
  	  $data = $this->db->fetchRow("select count(*) from `student`");
	  return $data['count(*)'];
    }
    /**
	  * 取得指定sno记录
	  */
    public function getById(){
	  $v = $_GET['v'];
	  $n = $_GET['n'];
	  $no = $_POST['no'];
	 
	  $sql = "select * from `$v` where $n=$no";
	  $data = $this->db->fetchAll($sql);
	  //处理换行符
//	  if($data!=false){
//		  $data['comment'] = str_replace('<br />','',$data['comment']);
//		  $data['reply'] = str_replace('<br />','',$data['reply']);
//	  }
	  return $data;
    }
    
    
       public function test(){
       	  $v = $_GET['v'];
	  $n = $_GET['n'];
	  $no = $_POST['no'];
	 
	  $sql = "select * from `$v` where $n=$no";
	  $data = $this->db->fetchRow($sql);
	  //处理换行符
//	  if($data!=false){
//		  $data['comment'] = str_replace('<br />','',$data['comment']);
//		  $data['reply'] = str_replace('<br />','',$data['reply']);
//	  }
	  echo $data['sname'];
	  
	  
	  }
    
    /**
     * 添加学生信息
     */
    
	public function insert(){
		//输入过滤
//		$this->filter(array('sno','sname','sbirthday','speciality','sclass','tc'),'htmlspecialchars');
//		$this->filter(array('student'),'nl2br');
		//接收输入数据
		$data['sno'] = $_POST['sno'];
		$data['sname'] = $_POST['sname'];
		if($_POST['ssex'] =='man'){
		  $data['ssex'] = '男';		
		}else{
		  $data['ssex'] = '女';
		}
		$data['sbirthday'] = $_POST['sbirthday'];
		$data['speciality'] = $_POST['speciality'];
		$data['sclass'] = $_POST['sclass'];
		$data['tc'] = $_POST['tc'];
	
	    //sql语句拼接
		$sql = "insert into `student` set ";
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
	
	
	public function save(){
		//输入过滤
//		$this->filter(array('id'),'intval');
//		$this->filter(array('poster','mail','comment','reply'),'htmlspecialchars');
//		$this->filter(array('comment','reply'),'nl2br');
		//接收输入变量
		$data['sno'] = $_POST['sno'];
		$data['sname'] = $_POST['sname'];
		if($_POST['ssex'] =='man'){
		  $data['ssex'] = '男';		
		}else{
		  $data['ssex'] = '女';
		}
		$data['sbirthday'] = $_POST['sbirthday'];
		$data['speciality'] = $_POST['speciality'];
		$data['sclass'] = $_POST['sclass'];
		$data['tc'] = $_POST['tc'];
		
		//拼接sql语句
		$sql = "update `student` set ";
		foreach($data as $k=>$v){
			$sql .= "`$k`=:$k,";
		}
		$sql = rtrim($sql,',');//去掉最右边的逗号
		$sql .= " where sno={$data['sno']}";
		//通过预处理执行SQL
		$this->db->execute($sql,$data,$flag);
		//返回是否执行成功
		return $flag;
	}
	
	
	public function deleteById(){
		$sno = (int)$_GET['sno'];
		$sql = "delete from `student` where sno=:sno";
		//通过预处理执行SQL
		$this->db->execute($sql,array(':sno'=>$sno),$flag);
		//返回是否执行成功
		return $flag;
	}

}

?>