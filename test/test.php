<?php
include 'connMysql.php';  //���ݿ������ļ�
$output = array();
$a = @$_GET['a'] ? $_GET['a'] : '';
$uid = @$_GET['uid'] ? $_GET['uid'] : 0;
 if (empty($a)) {
    $output = array('data'=>NULL, 'info'=>'�ӵ���!', 'code'=>-201);
    exit(json_encode($output));
 }
 //�߽ӿ�
 if ($a == 'get_users') {
    // $mysql �����ݿ�
    $conn=mysql_connect($mysql_server_name, $mysql_username, $mysql_password);

	// �ӱ�����ȡ��Ϣ��sql���
    $strsql="SELECT * FROM tb_topic_type_base";
    // ִ��sql��ѯ
    $result=mysql_db_query($mysql_database, $strsql, $conn);
    // ��ȡ��ѯ���
    $row=mysql_fetch_row($result);

	//���ݼ� 
    $users=array(); 
    $i=0; 
    while($row=mysql_fetch_array($result,MYSQL_ASSOC)){ 
 
		echo $row['id'].'-----------'.$row['name'].'</br>'; 
		$users[$i]=$row; 
		$i++; 
 
    } 
    echo json_encode(array('dataList'=>$users)); 
	$mysql =$result

    /*��������  
    $row=mysql_fetch_row($result,MYSQL_ASSOC);  
    echo json_encode(array('jsonObj'=>$row)); */

	 // �ͷ���Դ
    mysql_free_result($result);
    // �ر�����
    mysql_close($conn);

    //��ѯ���ݿ�
    $userInfo = $mysql;
    
    //�������
    $output = array(
        'data' => array(
            'userInfo' => $userInfo,
            'isLogin' => true,//�Ƿ��״ε�½
            'unread' => 4,//δ����Ϣ����
            'untask' => 3,//δ�������
        ), 
        'info' => 'Here is the message which, commonly used in popup window', //��Ϣ��ʾ���ͻ��˳����ô���Ϊ��������Ϣ��
        'code' => 200, //�ɹ���ʧ�ܵĴ��룬һ�㶼���������߸���
    );
    exit(json_encode($output));

 } elseif ($a == 'get_games_result') {
    //...
    die('�����ڵ� get_games_result �ӿ�!');
 } elseif ($a == 'upload_avatars') {
    //....
    die('�����ڵ� upload_avatars �ӿ�!');
 }
