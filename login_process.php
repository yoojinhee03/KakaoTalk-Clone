<?php  
require_once("conn.php");

$id=$_POST['id'];
$pw=$_POST['pw'];

$sql="select * from account";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($result)){
	if($row['id']==$id&&$row['password']==$pw){
		session_start();
	    $_SESSION['_id']=$row['_id'];
	    $_SESSION['id']=$row['id'];
		echo'
		<script>
		alert("로그인에 성공하였습니다.");
		location.href="index.php"</script>';
	}
}
echo'
	<script>
	alert("로그인에 실패하였습니다.");
	location.href="login.html"</script>';
?>
