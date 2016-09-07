<?php
	require_once("./dbconfig.php");

	//$_GET['bno']이 있을 때만 $bno 선언
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
		 
	if(isset($bNo)) {
		$sql = 'select b_first_name, b_last_name, b_country, b_institution, b_position, b_email, b_presentation from board_free where b_no = ' . $bNo;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
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
		<div>
			<form action="./write_update.php" method="post">
				<?php
				if(isset($bNo)) {
					echo '<input type="hidden" name="bno" value="' . $bNo . '">';
				}
				?>
				<div class="row" style="padding-left:300px">
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="bFirstname">First Name</label></th>
							<td class="form-group has-feedback"><input type="text" class="form-control" name="bFirstname" id="bFirstname" placeholder="First Name" value="<?php echo isset($row['b_first_name'])?$row['b_first_name']:null?>" required></td>
						</tr>
						<tr>
							<th scope="row"><label for="bLastname">Family/Last Name</label></th>
							<td class="form-group has-feedback"><input type="text" class="form-control" name="bLastname" id="bLastname" placeholder="Last / Family Name" value="<?php echo isset($row['b_last_name'])?$row['b_last_name']:null?>" required></td>

						</tr>
						<tr>
							<th scope="row"><label for="bPassword">Password</label></th>
							<td class="form-group has-feedback">
								<input type="password" class="form-control" name="bPassword" placeholder="Password" id="bPassword" value="" required></td>
						</tr>
						<tr>
							<th scope="row"><label for="bCountry">Country</label></th>
							<td class="form-group has-feedback"><input type="text" class="form-control" name="bCountry" placeholder="Country" id="bCountry" value="<?php echo isset($row['b_country'])?$row['b_country']:null?>" required></td>
						</tr>
						<tr>
							<th scope="row"><label for="bInstitution">Institution/Company</label></th>
							<td class="form-group has-feedback"><input type="text" class="form-control" name="bInstitution" placeholder="Institution / Company"  id="bInstitution" value="<?php echo isset($row['b_institution'])?$row['b_institution']:null?>" required></td>
						</tr>
						<tr>
							<th scope="row"><label for="bPosition">Position</label></th>
							<td class="form-group has-feedback"><input type="text" class="form-control" name="bPosition"  placeholder="Position" id="bPosition" value="<?php echo isset($row['b_position'])?$row['b_position']:null?>" required></td>
						</tr>
						<tr>
							<th scope="row"><label for="bEmail">E-mail</label></th>
							<td class="form-group has-feedback"><input type="text" class="form-control" name="bEmail" placeholder="E-mail" id="bEmail" value="<?php echo isset($row['b_email'])?$row['b_email']:null?>" required></td>
						</tr>
						<tr>
							<th><br></th>
							<td><br></td>
						</tr>
						<tr>
							<th scope="row"><label for="bPresentation"><font color="red">Type Of Attendance</font></label></th>
							<td class="form-group has-feedback">
								<input type="radio" name="bPresentation" id="bPresentation" value="Attend without Presentation" checked>Attend without Presentation
								<input type="radio" name="bPresentation" id="bPresentation" value="Oral / Poster Presentation"> Oral / Poster Presentation
							</td>
						</tr>
					</tbody>
				</table>
				<div style="padding-top:20px; padding-left:250px">
					<button type="submit" class="btn btn-default">
						<?php echo isset($bNo)?'Modify':'Write'?>
					</button>
					<a href="./pre_reg.php" class="btn btn-default">Back</a>
				</div>
				</div>
			</form>
		</div>
</body>
</html>