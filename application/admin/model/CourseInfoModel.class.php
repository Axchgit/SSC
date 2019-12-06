<?php
/**
 * info模型类
 */
class CourseInfoModel extends model{
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
	  * 取得指定cno记录
	  */
    public function getById(){
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
     * 添加学生信息
     */
    
	public function insert(){
		//输入过滤
//		$this->filter(array('cno','sname','credit','tno','sclass','tc'),'htmlspecialchars');
//		$this->filter(array('Course'),'nl2br');
		//接收输入数据
		$data['cno'] = $_POST['cno'];
		$data['cname'] = $_POST['cname'];
		$data['credit'] = $_POST['credit'];
		$data['tno'] = $_POST['tno'];
	
	
	    //sql语句拼接
		$sql = "insert into `course` set ";
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
		$data['cno'] = $_POST['cno'];
		$data['cname'] = $_POST['cname'];
	
		$data['credit'] = $_POST['credit'];
		$data['tno'] = $_POST['tno'];
	
		//拼接sql语句
		$sql = "update `course` set ";
		foreach($data as $k=>$v){
			$sql .= "`$k`=:$k,";
		}
		$sql = rtrim($sql,',');//去掉最右边的逗号
		$sql .= " where cno={$data['cno']}";
		//通过预处理执行SQL
		$this->db->execute($sql,$data,$flag);
		//返回是否执行成功
		return $flag;
	}
	
	
	public function deleteById(){
		$cno = $_GET['cno'];
		$sql = "delete from `course` where cno=:cno";
		//通过预处理执行SQL
		$this->db->execute($sql,array(':cno'=>$cno),$flag);
		//返回是否执行成功
		return $flag;
	}

}

?>