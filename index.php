<?php 
require_once("conn.php");
require_once("lib/login_chk.php");

$title="친구";
//내계정
$sql="select * from account where _id=".$_SESSION['_id'];
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$name=$row['name'];

//친구 추리기
$sql="select * from account, friend_list where account._id=".$_SESSION['_id']." AND mem_id=".$_SESSION['_id'];
$result=mysqli_query($conn,$sql);
$friend_list='';

//친구 리스트 
$friend_cnt=0;
while($row=mysqli_fetch_array($result)){
	$friend_cnt++;
	$sql="select * from account where _id=".$row['target_mem_id'];
	$friend_result=mysqli_query($conn,$sql);
	$friend_row=mysqli_fetch_array($friend_result);
	$friend_list=$friend_list.
	'<div class="list">
		<div class="profile"><img src="images/profile.jpg" alt="프로필"></div>
		<div class="name">'.$friend_row['name'].'</div>
	</div>';
}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>
	<title>KakaoTalk</title>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500&display=swap" rel="stylesheet">
	<link href="css/header.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
	<link href="css/list.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">
	<link href="css/mediaQuery.css" rel="stylesheet">

	<!-- -->
</head>
<body>
	<?php  
		require_once("lib/over.php");
	?>
	<div class="wrapper">
		<?php  
			require_once("lib/header.php");
		?>
		<main>
			<div id="list-container">
				<div class="list" style="border-bottom: 1px solid #f4f3f8;">
					<div class="myProfile"><img src="images/profile.jpg" alt="프로필"></div>
					<div class="myName"><?=$name?></div>
				</div>
				<div class="title">친구 <?=$friend_cnt?></div>
				<!-- <div class="list">
					<div class="profile"><img src="images/profile.jpg" alt="프로필"></div>
					<div class="name">홍길동</div>
				</div> -->
				<?=$friend_list?>
				<hr style="border: solid 1px #f4f3f8;">
			</div>
		</main>
		<?php  
			require_once("lib/footer.php");
		?>
	</div>
</body>
</html>