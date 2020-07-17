<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>회원가입</title>
  	<link href="css/infoInput.css" rel="stylesheet">
    <link href="css/mediaQuery.css" rel="stylesheet">
</head>
<body>
  <?php  
    require_once("lib/over.php");
  ?>
	<div class="wrapper">
    <header>
      <div id="top-container">
        <div class="logo">로고</div>
      </div>
    </header>
    <main>
      <form action="signUp_process.php" method="post">
        <div id="input-container">
       	 <div class="name-area">
            <input type="text" placeholder="닉네임" name="name" required>
          </div>
          <div class="id-area">
            <input type="email" placeholder="카카오계정 (이메일)" name="id"required>
          </div>
          <div class="pw-area">
            <input type="password" placeholder="비밀번호" name="pw" required>
          </div>
          <input id="login" type="submit" value="회원가입" alter="회원가입">
          <div class="info">
            <a href="login.html">로그인</a>
          </div>
        </div>
      </form>
    </main>
    <footer>
      <div id="bottom-container">
        
      </div>
    </footer>
  </div>
</body>
</html>