<?php
	include "./db_conn.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<script scr="https"//ajax.googleapis.co/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<style>
    a { text-decoration: none; color: deeppink; padding: 5px;} 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: black;} 
</style>
<script>

function checkid(){
	var userid = document.getElementById("uid").value;
	if(userid)
	{
		url = "checkid.php?userid="+userid;
			window.open(url,"chkid","width=500,height=250,top=250,left=500");
		}else{
			alert("아이디를 입력하세요");
		}
	}
      </script>
	<title>회원가입 폼</title>
	<link rel="stylesheet" type="text/css" href="common.css?after"/>
</head>
<body style="display: flex; background-image: url('/web/board/img/pink.jpg');
  background-size: 100%;">
<div align="center" style="border-radius: 30px; background-color: #ffffff;
  	background-color: rgba(255,255,255,0.7); width: 400px; height: 400px; margin-top: 250px;">
	<form method="post" id="member-form" action="./member_ok.php">
	<form name="register" action="member_ok.php?mode=register" method="post">
		<h1>회원가입 폼</h1>
					<div id="login_box">
					<table align="center" style="margin-top: 30px">
						<tr>
						<td>아이디</td>
						<td><input type="text" size="28" name="userid" id="uid" placeholder="아이디" required>
						<input type="button" value="중복검사" onclick="checkid();" />
						<input type="hidden" value="0" name="chs" />
							</td>
						</tr>
						<tr>
							<td>비밀번호</td>
							<td>
							<input type="password" size="34" name="pw" id="pw" placeholder="비밀번호"></td>
						</tr>
						<tr>
							<td>이름</td>
							<td><input type="text" size="34" name="name" id="name" placeholder="이름"></td>
						</tr>
						<tr>
							<td>주소</td>
							<td><input type="text" size="34" name="adress" id="adress" placeholder="주소"></td>
						</tr>
						<tr>
							<td>성별</td>
							<td>남<input type="radio" name="sex" value="남"> 여<input type="radio" name="sex" value="여"></td>
						</tr>
						<tr>
							<td>이메일</td>
							<td><input type="text" name="email" id="email" >@<select name="emadress">
							<option value="naver.com">naver.com</option><option value="nate.com">nate.com</option><option value="gmail.com">gmail.com</option>
							<option value="hanmail.com">hanmail.com</option>
						</select></td>
						</tr>
					</table>
					<br><br>

				<input type="submit" value="가입하기" />
				<input type="reset" value="다시쓰기" />

 				<br><br><a href="javascript:history.back();">이전 페이지로 이동</a>

	</form>
</div></div>
</body>
</html>
