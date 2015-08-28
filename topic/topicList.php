<?php

$index = @$_GET['index'] ? $_GET['index'] : 1;
$size = @$_GET['size'] ? $_GET['size'] : 20;
$type = @$_GET['type'] ? $_GET['type'] : 1;

$index = ($index-1)*$size;

$output = array();

//需要执行的SQL语句
$sql="SELECT * FROM tb_topic where type=".type." limit ".$index.",".$size;
//调用conn.php文件进行数据库操作 
require('../common/conn.php'); 

//执行SQL语句(查询) 
$result = mysql_query($sql) or die(json_encode(array('code'=>400,'msg'=>'数据库连接失败！错误原因：'.mysql_error()))); 

//提示操作成功信息，注意：$result存在于conn.php文件中，被调用出来 
if($result) 
{ 
	/*数据集	*/
	$i=0;
	while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
		//echo $row['id'].'-----------'.$row['name'].'</br>';
		$output[$i]=$row;
		$i++;
	}

	echo json_encode(array('code'=>200,'msg'=>'成功','data'=>$output));
} else {
	echo json_encode(array('code'=>400,'msg'=>'查询失败','data'=>$output));
}

mysql_free_result($result);
//释放结果
mysql_close();
//关闭连接
?>