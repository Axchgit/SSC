<?php
/**
 * admin模型类
 */
class studentModel extends model{
	/**
	 * 验证登录
	 */
	public function checkByLogin(){
		//过滤输入数据
//		$this->filter(array('username','password'),'trim');
		//接收输入数据
		$sno = $_POST['no'];
		$password = $_POST['password'];
		//通过用户名查询密码信息
		$sql = 'select `password` from `student` where `sno`=:sno';
		$data = $this->db->fetchRow($sql,array(':sno'=>$sno));
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
	

	
	
	
	
	
	
}
