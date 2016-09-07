<?php
	require_once("./dbconfig.php");
	$bNo = $_GET['bno'];
	$bPassword = $_GET['bPassword'];

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
	<div class="row" style="padding-left:250px">
		<div id="boardView">
		<?php
		if(isset($bNo)) {
		$sql = 'select count(b_password) as cnt from board_free where b_password=password("' . $bPassword . '") and b_no = ' . $bNo;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		if($row['cnt']) {
			$sql = 'select b_first_name, b_last_name, b_country, b_institution, b_position, b_email, b_presentation from board_free where b_no = ' . $bNo;
			$result = $db->query($sql);
			$row = $result->fetch_assoc();	
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
		?>
		

		
			  <div class="col-md-9">
				<table class="table">
					<tbody>
						<tr>
							<th scope="row"><label for="bFirstname">First Name : </label></th>
							<td class="firstname" ><?php echo $row['b_first_name']?></td>
						</tr>
						<tr>
							<th scope="row"><label for="bFirstname">Last Name : </label></th>
							<td class="lastname"><?php echo $row['b_last_name']?></td>
						</tr>
						<tr>
							<th scope="row"><label for="bFirstname">Country: </label></th>
							<td class="country"><?php echo $row['b_country']?></td>
						</tr>
						<tr>
							<th scope="row"><label for="bFirstname">Institution/Company : </label></th>
							<td class="institution"><?php echo $row['b_institution']?></td>
						</tr>
						<tr>
							<th scope="row"><label for="bFirstname">Position : </label></th>
							<td class="position"><?php echo $row['b_position']?></td>
						</tr>
						<tr>
							<th scope="row"><label for="bFirstname">E-mail : </label></th>
							<td class="email"><?php echo $row['b_email']?></td>
						</tr>
						<tr>
							<th scope="row"><label for="bPresentation">Type of Presentation : </label></th>
							<td class="presentation"><?php echo $row['b_presentation']?></td>
						</tr>
					</tbody>
				</table>
			</div>
	<div class="space"></div>
	<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
<div class="space"></div>
	<div class="space"></div>
			<div style="padding-top:25px; padding-left:200px">
				<a href="./write.php?bno=<?php echo $bNo?>" class="btn btn-default">Modify</a>
				<a href="./delete.php?bno=<?php echo $bNo?>" class="btn btn-default">Delete</a>
				<a href="./pre_reg.php" class="btn btn-default">Back</a>
			</div>
		</div>

</body>
</html>