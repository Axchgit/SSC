<?php
			
	foreach($cno_data as $vv):
	$cno[] = $vv['cno'];
	endforeach;


		foreach($data as $v):
		
		echo $v['cno'];
		
		if(in_array($v['cno'],$cno)){
			echo '匹配';
			echo $v['cno'];
			
		}else{
			echo '不匹配';
			echo $v['cno'];
		}
		
	endforeach;
//	}
//
//	
	 

?>