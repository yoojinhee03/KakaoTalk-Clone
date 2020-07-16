<?php  
require_once("conn.php");
$mem_id=$_POST['mem_id'];
$target_mem_id=$_POST['target_mem_id'];

$sql="insert into friend_list(mem_id,target_mem_id) values({$mem_id},{$target_mem_id})";
$result=mysqli_query($conn,$sql);
header("location:index.php");
?>