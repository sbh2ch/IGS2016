<?php
	require_once("./dbconfig.php");

	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}

	$bPassword = $_POST['bPassword'];

//글 삭제
if(isset($bNo)) {
	//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(b_password) as cnt from board_free where b_password=password("' . $bPassword . '") and b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	//비밀번호가 맞다면 삭제 쿼리 작성
	if($row['cnt']) {
		$sql = 'delete from board_free where b_no = ' . $bNo;
	//틀리다면 메시지 출력 후 이전화면으로
	} else {
		$msg = 'Password is not correct.';
	?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
	<?php
		exit;
	}
}

	$result = $db->query($sql);
	
//쿼리가 정상 실행 됐다면,
if($result) {
	$msg = 'Delete Success.';
	$replaceURL = 'pre_reg.php';
	//$replaceURL = './';
} else {
	$msg = 'Delete Fail.';
?>
	<script>
		alert("<?php echo $msg?>");
		history.back();
	</script>
<?php
	exit;
}


?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>