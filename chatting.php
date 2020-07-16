<?php  
require_once("conn.php");
require_once("lib/login_chk.php");

$id=$_GET['id'];//채팅방 id
$sql="select * from friend_list,account where friend_list._id=".$id." and account._id=".$_SESSION['_id'];
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if($row['target_mem_id']==$_SESSION['_id']){
	$target_mem_id=$row['mem_id'];
}else{
	$target_mem_id=$row['target_mem_id'];
}
//
$sql="select * from account where _id=".$target_mem_id;
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$target_mem_name=$row['name'];

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title><?=$target_mem_name?></title>
	<link href="css/mediaQuery.css" rel="stylesheet">
	<link href="css/chatting.css" rel="stylesheet">
	<script type="text/javascript" src="js/chatting.js"></script>
</head>
<body onload="chatManager.setId(<?=$id?>,<?=$_SESSION['_id']?>)">
	<?php  
		require_once("lib/over.php");
	?>
	<div class="wrapper">
		<header>
			<div id="top-container">
				<div class="back" onclick="location.href='chat_group.php'"><img src="https://img.icons8.com/ios/36/000000/expand-arrow--v2.png"/></div>
				<div class="name"><?=$target_mem_name?></div>
			</div>
		</header>
		<main>
			<div id="chatting-container">
				<div class="wrap">
					<!-- <div class="profile"><img src="images/profile.jpg" alt=""></div>
					<div class="name"><?=$target_mem_name?></div> -->
					<div class="chat-wrap">
						<!-- <div>
							<div class="chatting">ssdddddd</div>
						</div>
						<div>
							<div class="chatting">ssddddssssssssssssssssssssssssssssssssssssssdd</div>
						</div>
						<div>
							<div class="mine-chatting">ssssssssdd</div></div>
							<div>
							<div class="mine-chatting">ssddddssssssssssssssssssssssssssssssssssssssdd</div>
						</div> -->
					</div>
				</div>
			</div>
		</main>
		<footer>
			<div id="input-container">
				<div class="text-area">
					<form onsubmit="chatManager.write(this); return false;">
						<input type="text" name="msg">
						<input type="hidden" name="user_id" value="<?=$_SESSION['_id']?>">
						<input type="hidden" id="chat_group_id" name="chat_group_id" value="<?=$id?>">
						<input name="btn" type="submit" value="전송">
					</form>
				</div>
			</div>
		</footer>
	</div>
</body>
</html>