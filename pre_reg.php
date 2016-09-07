<?php
	require_once("./dbconfig.php");
	
	/* 페이징 시작 */
	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	
	/* 검색 시작 */
	
	if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString .= '&amp;searchColumn=' . $searchColumn;
	}
	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString .= '&amp;searchText=' . $searchText;
	}
	
	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';
	}
	
	/* 검색 끝 */
	
	$sql = 'select count(*) as cnt from board_free' . $searchSql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	$allPost = $row['cnt']; //전체 게시글의 수
	
	if(empty($allPost)) {
		$emptyData = '<tr><td class="textCenter" colspan="5"></td></tr>';
	} else {

		$onePage = 10; // 한 페이지에 보여줄 게시글의 수.
		$allPage = ceil($allPost / $onePage); //전체 페이지의 수
		
		if($page < 1 && $page > $allPage) {
?>
			<script>
				alert("This page does not exist.");
				history.back();
			</script>
<?php
			exit;
		}
	
		$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
		$currentSection = ceil($page / $oneSection); //현재 섹션
		$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
		
		$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지
		
		if($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
		}
		
		$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
		
		$paging = '<ul>'; // 페이징을 저장할 변수
		
		//첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) { 
			$paging .= '<li class="page page_start"><a href="./pre_reg.php?page=1' . $subString . '">First</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) { 
			$paging .= '<li class="page page_prev"><a href="./pre_reg.php?page=' . $prevPage . $subString . '">Before</a></li>';
		}
		
		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<li class="page current">' . $i . '</li>';
			} else {
				$paging .= '<li class="page"><a href="./pre_reg.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}
		
		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) { 
			$paging .= '<li class="page page_next"><a href="./pre_reg.php?page=' . $nextPage . $subString . '">After</a></li>';
		}
		
		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) { 
			$paging .= '<li class="page page_end"><a href="./pre_reg.php?page=' . $allPage . $subString . '">Last</a></li>';
		}
		$paging .= '</ul>';
		
		/* 페이징 끝 */
		
		
		$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
		
		$sql = 'select * from board_free' . $searchSql . ' order by b_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$result = $db->query($sql);
	}
?>
<!DOCTYPE html>
<html lang="en">
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

	<!-- footer start -->
	<!-- ================ -->
	<footer id="footer">
		<div class="footer section" id="regist">
			<div class="container">
				<h3 class="title text-center">Attendance List</h3>
				<div class="row" style="padding-left:50px">
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="no">No.</th>
								<th scope="col" class="firstname">First Name</th>
								<th scope="col" class="lastname">Last Name</th>
								<th scope="col" class="institution">Institution/Company</th>
								<th scope="col" class="date">Date</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($emptyData)) {
							echo $emptyData;
						} else {								
							while($row = $result->fetch_assoc())
								{
								$datetime = explode(' ', $row['b_date']);
								$date = $datetime[0];
								$time = $datetime[1];
								if($date == Date('Y-m-d'))
									$row['b_date'] = $time;
								else
									$row['b_date'] = $date;
						?>
						<tr>
							<td class="no"><?php echo $row['b_no']?></td>
							<td class="firstname"><?php echo $row['b_first_name']?></td>
							<td class="lastname"><a href="./identification.php?bno=<?php echo $row['b_no']?>"><?php echo $row['b_last_name']?></a></td>
							<td class="institution"><?php echo $row['b_institution']?></td>
							<td class="date"><?php echo $row['b_date']?></td>	
						</tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>							
				</div>
			<div style="text-align:right; padding-top:5px; padding-right:10px"><a href="./write.php" class="btn btn-default">Write</a></div>
			</div>

	
			<div class="paging" style="padding-left:100px">
			<?php 
			echo $paging 
			?>
			</div>

	<!--
	<div align="right" style="padding-right:100px" class="footer-content>
		<form action="./pre_reg.php" method="get">
			<select name="searchColumn" style="font-size:12pt">
				<option <?php echo $searchColumn=='b_first_name'?'selected="selected"':null?> value="b_first_name">First Name</option>
				<option <?php echo $searchColumn=='b_last_name'?'selected="selected"':null?> value="b_last_name">Last Name</option>
				<option <?php echo $searchColumn=='b_institution'?'selected="selected"':null?> value="b_institution">Institution/Company</option>
			</select>
			<input type="text" name="searchText" size="30" style="font-size:11pt" value="<?php echo isset($searchText)?$searchText:null?>">
			<button type="submit" class="btn btn-default" style="font-size:8pt" >Search</button>
		</form>
	</div>
	-->
	</div>
	</footer>
	
</body>
</html>