<?php 
	session_start();
	if(!isset($_SESSION['_id'])){
		echo "<script>alert('로그인이 필요합니다');location.href='login.html';</script>";
	}
?>