<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-lr" />
<title>create table</title>
</head>
<body>
<?php

//from kosc_web
include $_SERVER[DOCUMENT_ROOT]."/include/header.html";
include $_SERVER[DOCUMENT_ROOT]."/include/functions.php";

 $connect=mysql_connect($dbHost_game,$dbUser,$dbPasswd);
 $dbconn=mysql_select_db($dbName_game, $connect);
 
 
 $sql="drop table board_free ;";
 
 $result=mysql_query($sql, $connect);
 
 if ($result)
  echo "�����ͺ��̽� ���̺� board_free�� �����Ǿ����ϴ�!";
 else
  echo "�����ͺ��̽� ���̺� ���� ����!!!";
 
 mysql_close();
?>
</body> 
</html>