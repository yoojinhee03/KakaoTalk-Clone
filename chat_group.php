<?php  
require_once("conn.php");
require_once("lib/login_chk.php");

$title="채팅";
$sql="select * from account, friend_list where account._id=".$_SESSION['_id']." AND mem_id=".$_SESSION['_id'];
$result=mysqli_query($conn,$sql);
$chat_list='';
// while($row=mysqli_fetch_array($result)){
// 	$sql="select * from account where _id=".$row['target_mem_id'];
// 	$chat_result=mysqli_query($conn,$sql);
// 	$chat_row=mysqli_fetch_array($chat_result);
// 	$chat_list=$chat_list.
// 	'<div class="list" onclick="location.href=\'chatting.php?id='.$row['_id'].'\'">
// 		<div class="profile"><img src="images/profile.jpg" alt="프로필"></div>
// 		<div class="name">'.$chat_row['name'].'</div>
// 	</div>';
// }

//친구목록에 없는 사람에게 채팅이 왔을때
// $sql="select distinct friend_list._id,count(*) from friend_list,chat where mem_id=".$_SESSION['_id']." or target_mem_id=".$_SESSION['_id'];
$sql="select chat_group_id,count(*) from chat,friend_list where mem_id=".$_SESSION['_id']." or target_mem_id=".$_SESSION['_id']." group by chat_group_id";
$result=mysqli_query($conn,$sql);
print_r(mysqli_error($conn));
$chat_list='';	

while($row=mysqli_fetch_array($result)){
	// print_r($row);
	$sql="select * from friend_list where _id=".$row['chat_group_id'];
	$chat_result=mysqli_query($conn,$sql);
	$chat_row=mysqli_fetch_array($chat_result);
	if($chat_row['target_mem_id']==$_SESSION['_id']){
		$target_mem_id=$chat_row['mem_id'];
	}else{
		$target_mem_id=$chat_row['target_mem_id'];
	}
	$sql="select * from account where _id=".$target_mem_id;
	$chat_result=mysqli_query($conn,$sql);
	$chat_row=mysqli_fetch_array($chat_result);
	$chat_list=$chat_list.
	'<div class="list" onclick="location.href=\'chatting.php?id='.$row['chat_group_id'].'\'">
		<div class="profile"><img src="images/profile.jpg" alt="프로필"></div>
		<div class="name">'.$chat_row['name'].'</div>
	</div>';
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>채팅방</title>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500&display=swap" rel="stylesheet">
	<link href="css/header.css" rel="stylesheet">
	<link href="css/chat_group.css" rel="stylesheet">
	<link href="css/list.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<?php  
			require_once("lib/header.php");
		?>
		<main>
			<div id="list-container">
				<!-- <div class="list">
					<div class="profile"><img src="images/profile.jpg" alt="프로필"></div>
					<div class="name">ㅇㅇㅇ</div>
				</div> -->
				<?=$chat_list?>
			</div>
		</main>
		<?php  
			require_once("lib/footer.php");
		?>
	</div>
</body>
</html>