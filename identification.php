<?php
	require_once("./dbconfig.php");

	//$_GET['bno']이  있어야만 글삭제가 가능함.
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="Worthy a Bootstrap-based, Responsive HTML5 Template">
<meta name="author" content="htmlcoder.me">

<!-- Mobile Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.ico">

<!-- Web Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>

<!-- Bootstrap core CSS -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Font Awesome CSS -->
<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

<!-- Plugins -->
<link href="css/animations.css" rel="stylesheet">

<!-- Worthy core CSS file -->
<link href="css/style.css" rel="stylesheet">

<!-- Custom css -->
<link href="css/custom.css" rel="stylesheet">
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/googlemap.js"></script>
</head>
<body>
	<div class="row" style="padding-left:300px">
		<?php
			if(isset($bNo)) {
				$sql = 'select count(b_no) as cnt from board_free where b_no = ' . $bNo;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				if(empty($row['cnt'])) {
		?>
		<script>
			alert('Pre-registraion does not exist.');
			history.back();
		</script>
		<?php
			exit;
				}
				
				$sql = 'select b_last_name from board_free where b_no = ' . $bNo;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
		?>
			<form action="./view.php" method="get">
				<input type="hidden" name="bno" value="<?php echo $bNo?>">
				<table id="table">					
					<tbody>
						<tr>
							<th scope="row" style="padding-right:30px">Last Name</th>
							<td><font size= "5px"><?php echo $row['b_last_name']?></font></td>
						</tr>
						<tr>
							<th scope="row"><label for="bPassword">Password</label></th>
							<td><input style="font-size:20px;" type="password" name="bPassword" id="bPassword"></td>
						</tr>
					</tbody>
				</table>
				<div style="padding-top:25px; padding-left:250px">
					<button type="submit" class="btn btn-default">View</button>
					<a href="./pre_reg.php" class="btn btn-default">Back</a>
				</div>
	</div>

	<?php
		//$bno이 없다면 삭제 실패
		} else {
	?>
		<script>
			alert('Please use the normal route.');
			history.back();
		</script>
	<?php
			exit;
		}
	?>
</body>
</html>