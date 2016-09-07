<?php
	//header('Content-Type: text/html; charset=utf-8');

//from kosc_web
//include $_SERVER[DOCUMENT_ROOT]."/include/header.html";
//include $_SERVER[DOCUMENT_ROOT]."/include/functions.php";

//echo "$dbHost_game,$dbUser,$dbPasswd,$dbName_game";

//$db = new mysqli($dbHost_game,$dbUser,$dbPasswd,$dbName_game);
$db = new mysqli("localhost","hjm","4321","pre_regi_db");

//echo $db;

	if ($db->connect_error) {
		echo  "$db->connect_errno\n";
		echo  "$db->connect_error\n";
		die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');
	}

	$db->set_charset('utf8');
?>