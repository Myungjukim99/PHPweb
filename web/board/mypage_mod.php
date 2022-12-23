    <!--- 게시글 수정 -->
<?php
include $_SERVER['DOCUMENT_ROOT']."/web/db_conn.php";

  $user_id = $_SESSION['user_id']; 
  $sql = mq("SELECT * from member Where id ='".$user_id."'");
  $member = $sql->fetch_array();

 ?>
<!doctype html>
<head>
    <meta charset="utf-8" />
    <script scr="https"//ajax.googleapis.co/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
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
    <style>
    a { text-decoration: none; color: deeppink; padding: 5px;} 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: black;} 
</style>


<title>수정 페이지</title>
<link href="../common.css" rel="stylesheet" type="text/css" />
</head>
<body style="display: flex; background-image: url('/web/board/img/pink.jpg');
  background-size: 100%;">
  <div align="center" style="border-radius: 30px; background-color: #ffffff;
    background-color: rgba(255,255,255,0.7); width: 400px; height: 400px; margin-top: 250px;">
    <form method="post" action="/web/board/mypage_mod_ok.php" name="register" method="post">
        <h1>수정 폼</h1>
                    <div id="login_box">
                    <table align="center" style="margin-top: 30px">
                        <tr>
                            <td>아이디</td>
                        <td><input type="text" size="28" name="userid" id="uid" placeholder="새로운 값을 입력하세요" required>
                        <input type="button" value="중복검사" onclick="checkid();" />
                        <input type="hidden" value="0" name="chs" />
                        </td>
                    </tr>
                        <tr>
                            <td>비밀번호</td>
                            <td>
                            <input type="password" size="34" name="pw" placeholder="새로운 값을 입력하세요"></td>
                        </tr>
                        <tr>
                            <td>이름</td>
                            <td><input type="text" size="34" name="name" placeholder="새로운 값을 입력하세요"></td>
                        </tr>
                        <tr>
                            <td>주소</td>
                            <td><input type="text" size="34" name="adress" placeholder="새로운 값을 입력하세요"></td>
                        </tr>
                        <tr>
                            <td>성별</td>
                            <td>남<input type="radio" name="sex" value="남"> 여<input type="radio" name="sex" value="여"></td>
                        </tr>
                        <tr>
                            <td>이메일</td>
                            <td><input type="text" name="email" placeholder="새로운 값을 입력하세요">@<select name="emadress">
                            <option value="naver.com">naver.com</option><option value="nate.com">nate.com</option>
                            <option value="hanmail.com">hanmail.com</option>
                            <option value="hanmail.com">gmail.com</option>
                        </select></td>
                        </tr>
                    </table>
                    <br><br>

                <input type="password" size="20" name="pw_chk" placeholder="비빌번호 재확인">
                <input type="submit" value="수정하기" />
                <input type="reset" value="다시쓰기" />

                <br><br><a href="javascript:history.back();" style="color:black;">이전 페이지로 이동</a>

    </body></div></form>
</html>