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
 
 
 $sql="create table board_free (";
 $sql.="b_no int unsigned not null primary key auto_increment, ";
 $sql.="b_first_name varchar(20) not null, ";
 $sql.="b_last_name varchar(20) not null, ";
 $sql.="b_country varchar(20) not null, ";
 $sql.="b_institution varchar(40) not null, ";
 $sql.="b_position varchar(20) not null, ";
 $sql.="b_email varchar(20) not null, ";
 $sql.="b_presentation varchar(40) not null, ";
 $sql.="b_password varchar(100) not null, ";
 $sql.="b_date datetime not null );";
 
 $result=mysql_query($sql, $connect);
 
 if ($result)
  echo "데이터베이스 테이블 board_free가 생성되었습니다!";
 else
  echo "데이터베이스 테이블 생성 에러!!!";
 
 mysql_close();
?>
</body> 
</html>