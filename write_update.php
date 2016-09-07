<?php
	require_once("./dbconfig.php");

	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}

	//bno이 없다면(글 쓰기라면) 변수 선언
	if(empty($bNo)) {
		$bLastname = $_POST['bLastname'];
		$date = date('Y-m-d H:i:s');
	}

	//항상 변수 선언
	$bPassword = $_POST['bPassword'];
	$bFirstname = $_POST['bFirstname'];
	$bCountry = $_POST['bCountry'];
	$bInstitution = $_POST['bInstitution'];
	$bPosition = $_POST['bPosition'];
	$bEmail = $_POST['bEmail'];
	$bPresentation = $_POST['bPresentation'];
	
//글 수정
if(isset($bNo)) {
	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(b_password) as cnt from board_free where b_password=password("' . $bPassword . '") and b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	//비밀번호가 맞다면 업데이트 쿼리 작성
	if($row['cnt']) {
		$sql = 'update board_free set b_first_name="' . $bFirstname . '", b_country="' . $bCountry . '", b_institution="' . $bInstitution . '", b_position="' . $bPosition . '", b_email="' . $bEmail . '", b_presentation="' . $bPresentation . '" where b_no = ' . $bNo;
		$msgState = 'Modify';
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
	
//글 등록
} else {
	$sql = 'insert into board_free (b_no, b_first_name, b_last_name, b_country, b_institution, b_position, b_email, b_presentation, b_password, b_date) values(null, "' . $bFirstname . '", "' . $bLastname . '", "' . $bCountry . '",  "' . $bInstitution . '", "' . $bPosition . '", "' . $bEmail . '", "' . $bPresentation . '" , password("' . $bPassword . '"), "' . $date . '")';
	$msgState = 'Registration';
}

//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $db->query($sql);
	
	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = $msgState . ' Success.';
		if(empty($bNo)) {
			$bNo = $db->insert_id;
		}
		$replaceURL = './pre_reg.php';
	} else {
		$msg = $msgState . ' Fail.';
?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
<?php
		exit;
	}
}

?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>