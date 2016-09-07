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
  echo "데이터베이스 테이블 board_free가 삭제되었습니다!";
 else
  echo "데이터베이스 테이블 삭제 에러!!!";
 
 mysql_close();
?>
</body> 
</html>