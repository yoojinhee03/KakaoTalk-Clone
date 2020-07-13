<?php  
require_once("conn.php");

$id=$_POST['id'];
$pw=$_POST['pw'];
$name=$_POST['name'];

$sql="select * from account";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($result)){
	if($row['id']==$id){
		echo "
		<script>alert('해당 이메일이 이미 존재합니다'); location.href='login.html';</script>
		";
	}else{
		$sql="insert into account(id,password,name) values('{$id}','{$pw}','{$name}')";
		$result=mysqli_query($conn,$sql);
		echo "
		<script>alert('회웝가입을 완료하였습니다'); location.href='login.html';</script>
		";
	}
}
?>
