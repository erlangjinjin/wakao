<?php
include 'connMysql.php';  //数据库链接文件
$output = array();
$a = @$_GET['a'] ? $_GET['a'] : '';
$uid = @$_GET['uid'] ? $_GET['uid'] : 0;
 if (empty($a)) {
    $output = array('data'=>NULL, 'info'=>'坑爹啊!', 'code'=>-201);
    exit(json_encode($output));
 }
 //走接口
 if ($a == 'get_users') {
    // $mysql 是数据库
    $conn=mysql_connect($mysql_server_name, $mysql_username, $mysql_password);

	// 从表中提取信息的sql语句
    $strsql="SELECT * FROM tb_topic_type_base";
    // 执行sql查询
    $result=mysql_db_query($mysql_database, $strsql, $conn);
    // 获取查询结果
    $row=mysql_fetch_row($result);

	//数据集 
    $users=array(); 
    $i=0; 
    while($row=mysql_fetch_array($result,MYSQL_ASSOC)){ 
 
		echo $row['id'].'-----------'.$row['name'].'</br>'; 
		$users[$i]=$row; 
		$i++; 
 
    } 
    echo json_encode(array('dataList'=>$users)); 
	$mysql =$result

    /*单条数据  
    $row=mysql_fetch_row($result,MYSQL_ASSOC);  
    echo json_encode(array('jsonObj'=>$row)); */

	 // 释放资源
    mysql_free_result($result);
    // 关闭连接
    mysql_close($conn);

    //查询数据库
    $userInfo = $mysql;
    
    //输出数据
    $output = array(
        'data' => array(
            'userInfo' => $userInfo,
            'isLogin' => true,//是否首次登陆
            'unread' => 4,//未读消息数量
            'untask' => 3,//未完成任务
        ), 
        'info' => 'Here is the message which, commonly used in popup window', //消息提示，客户端常会用此作为给弹窗信息。
        'code' => 200, //成功与失败的代码，一般都是正数或者负数
    );
    exit(json_encode($output));

 } elseif ($a == 'get_games_result') {
    //...
    die('您正在调 get_games_result 接口!');
 } elseif ($a == 'upload_avatars') {
    //....
    die('您正在调 upload_avatars 接口!');
 }
