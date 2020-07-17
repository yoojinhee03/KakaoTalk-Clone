<?php  
require_once("conn.php");
require_once("lib/login_chk.php");

$show='';
$info='';
$go='';
$id='';
$name='';
$goButton='';
$target_mem_id='';

if(isset($_POST['id'])){
	$sql="select * from account where id like '".$_POST['id']."@%'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	$id=$row['_id'];
	$name=$row['name'];
	$target_mem_id=$row['_id'];
	// print_r($row);
	// print_r(1);
	if(!$row){
		// print_r("dd");
		$show='
		<div id="find-container">
			<span>사용자를 찾을 수 없습니다</span><br>
			<span style="font-size: 0.9rem; color: #aaaaaa">카카오톡 ID를 다시 확인해주세요.</span>
		</div>
		';
	}else{
		if($id==$_SESSION['_id']){
			$info='본인 계정입니다.';
			// $go='나와의 채팅';
		}else{
			$sql="select * from account,friend_list where id like '".$_POST['id']."@%' and target_mem_id=account._id and mem_id=".$_SESSION['_id'];
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
				// print_r($row);

			if($row){
				$info='이미 등록된 친구입니다.';
				// $go="1:1 채팅";
			}else{
				$row['name']=$name;
				$info='';
				$go="친구추가";
				$goButton=
				'<form action="follow_id_process.php" method="post">
					<input type="hidden" name="mem_id" value='.$_SESSION['_id'].'>
					<input type="hidden" name="target_mem_id" value='.$target_mem_id.'>
					<input type="submit" class="go" value='.$go.'>
				</form>';
			}
		}
		$show=
		'
		<div id="find-container">
			<div class="profile">
				<img src="images/profile.jpg" alt="">
			</div>
			<div class="name">'.$row['name'].'</div>
			<div class="info">'.$info.'</div>
			'.$goButton.'
		</div>
		';
	}
	
}else{
	$sql="select id from account where _id=".$_SESSION['_id'];
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	$id=$row['id'];
	$id=explode('@', $id);
	$show=
	'
	<div id="info-container">
		<span>내 아이디</span>
		<div class="id">'.$id[0].'</div>
	</div>';
}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>까까오톡 ID로 추가</title>
	<link href="css/follow_id.css" rel="stylesheet">
	<link href="css/mediaQuery.css" rel="stylesheet">
	
	<script src="js/follow.js"></script>
</head>
<body>
	<?php  
		require_once("lib/over.php");
	?>
	<div class="wrapper">
		<div id="top-container">
			<div class="close"><a href="index.php"><img src="https://img.icons8.com/ios/48/000000/multiply.png"/></a></div>
			<div class="title">
				까까오톡 ID로 추가
			</div>
		</div>
		<main>
			<div id="find-container">
				<form action="follow_id.php" method="post" name="findFrm">
					<input type="text" name="id" maxlength="20" placeholder="친구 까까오톡 ID (20글자 이내)" onkeypress="JavaScript:press(this.form)">
				</form>
			</div>
			 <?=$show?>
			
			<!-- <div id="info-container">
				<span>내 아이디</span>
				<div class="id"><?=$id[0]?></div>
			</div> -->
			<!-- <div id="find-container">
				<div class="profile">
					<img src="images/profile.jpg" alt="">
				</div>
				<div class="name">진힁랑</div>
				<div class="info">이미 등록된 친구</div>
				<div class="go">1:1채팅</div>
			</div> -->
		</main>
		
	</div>
</body>
</html>