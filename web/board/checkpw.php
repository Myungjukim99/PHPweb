
<body align=center style="margin-top: 90px;">
<div id='writepass' align="center" style="margin-top:50px">
    <form action="" method="post">
        <p>비밀번호<input type="password" name="pw_chk" /> <input type="submit" value="확인" /></p>
        <br><a href="javascript:history.back();" style="color: black;">이전 페이지로 이동</a>
    </form>
</div>

<?php
    include "./db_conn.php";

  $password=$_POST['pw_chk'];

  $sql= mq("SELECT * FROM member WHERE id = $SESSION['user_id']");
  $member = $sql->fetch_array();

    if(password_verify($password, $member['pw']))
    { 
    session_start();
    $_SESSION['user_id'] = $_POST['id'];
    echo "<script>location.href='/mypage_mod_ok.php';</script>";
 } else { 
echo "<script>alert('비밀번호를 확인하세요. '); history.back(); </script>";
  }
?>
<button type="submit" id="btn" onclick="window.close()">닫기</button>

</body>