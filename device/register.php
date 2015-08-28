<?php

$device = @$_GET['device'] ? $_GET['device'] : 0;
$mac = @$_GET['mac'];
$appVersion = @$_GET['appVersion'];
$system = @$_GET['system'];
$phone = @$_GET['phone'];

//返回数据
$output = array();

//需要执行的SQL语句
$sql="SELECT id FROM tb_device where device='".$device."'";

$sqlIn="insert into tb_device (device,mac,appVersion,system,phone,createTime) values ('"
	.$device."','".$mac."','".$appVersion."','".$system."','".$phone."',now())";

//调用conn.php文件进行数据库操作 
require('../common/conn.php'); 

//执行SQL语句(查询) 
$result = mysql_query($sql); 

//提示操作成功信息，注意：$result存在于conn.php文件中，被调用出来 
if($result) 
{ 
	$num=mysql_num_rows($result);
	if($num<=0){
		$insert = mysql_query($sqlIn); 
		if($insert) {
			echo json_encode(array('code'=>200,'msg'=>'成功'));
		}
	}else{
		echo json_encode(array('code'=>201,'msg'=>'成功'));
	}
} else {
	echo json_encode(array('code'=>400,'msg'=>'查询失败'));
}


mysql_free_result($result);

//释放结果
mysql_close();
//关闭连接
?>