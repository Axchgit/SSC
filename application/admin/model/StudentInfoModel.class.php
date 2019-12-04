<?php
/**
 * info模型类
 */
class StudentInfoModel extends model{
    /**
     * 信息列表
     */
    public function getAll(){
      $sql = "select * from student";
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
	  $id = (int)$_GET['sno'];
	  $sql = "select * from `student` where sno=$sno";
	  $data = $this->db->fetchRow($sql);
	  //处理换行符
//	  if($data!=false){
//		  $data['comment'] = str_replace('<br />','',$data['comment']);
//		  $data['reply'] = str_replace('<br />','',$data['reply']);
//	  }
	  return $data;
  }

}

?>