<?php


$index = @$_GET['index'] ? $_GET['index'] : 1;
$size = @$_GET['size'] ? $_GET['size'] : 5;
$index = ($index-1)*$size;

$output = array();

//需要执行的SQL语句
$sql="SELECT * FROM tb_template limit ".$index.",".$size;
//调用conn.php文件进行数据库操作 
require('conn.php'); 

//提示操作成功信息，注意：$result存在于conn.php文件中，被调用出来 
if($result) 
{ 

//	$array=mysql_fetch_array($result,MYSQL_ASSOC);
	
		
	/*数据集	*/
	$i=0;
	while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
		//echo $row['id'].'-----------'.$row['name'].'</br>';
		$output[$i]=$row;
		$i++;
	}

	echo json_encode(array('code'=>200,'msg'=>'成功','data'=>$output));

	/*单条数据
	$row=mysql_fetch_row($result);
	echo json_encode(array('jsonObj'=>$row));*/
} else {
	echo json_encode(array('code'=>400,'msg'=>'查询失败','data'=>$output));
}

mysql_free_result($result);
//释放结果
mysql_close();
//关闭连接
?>