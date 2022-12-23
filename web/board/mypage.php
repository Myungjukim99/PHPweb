<?php 
include $_SERVER['DOCUMENT_ROOT']."/web/db_conn.php";?>

<!doctype html>
<head>
<meta charset="UTF-8">
<link href="../common.css" rel="stylesheet" type="text/css" />
<title>마이페이지</title>
</head>
<body style="display: flex; background-image: url('/web/board/img/pink.jpg');
  background-size: 100%;">
  <div align="center" style="border-radius: 30px; background-color: #ffffff;
    background-color: rgba(255,255,255,0.7); width: 400px; height: 400px; margin-top: 250px;">
    <style>
    a { text-decoration: none; color: deeppink; padding: 5px;} 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: black;} 
</style>

    <form method="post" action="./mypage_mod.php">
        <h1>마이페이지</h1>
            <div id="login_box">
  <?php

$sql = mq("SELECT * from member Where id ='".$_SESSION['user_id']."'");
  $member = $sql->fetch_array();

if($member["id"]=$_SESSION['user_id'] && password_verify($_SESSION['user_pw'],$member['pw']))
    {
?>
<table align="center" style="margin-top: 30px; align-content: center; padding: 15px;">
  <tr>
  <td>아이디: <?php echo $member["id"];  ?> </td> </tr>
  <tr>
  <td>비밀번호: <?php echo "HASH";  ?> </td> </tr>
    <tr>
  <td>이름: <?php echo $member["name"];  ?> </td> </tr>
    <tr>
  <td>주소: <?php echo $member["adress"];  ?> </td> </tr>
    <tr>
  <td>성별: <?php echo $member["sex"];  ?> </td> </tr>
    <tr>
  <td>이메일: <?php echo $member["email"];  ?> </td> </tr>
</table> <br>

    <a href='/web/board/mypage_mod.php'>[수정]</a>
    <a href="/web/main.php">[목록으로]</a>

</div>
</form>
</div>
</body>
<?php }else{
    echo "<script> alert('잘못된 접근입니다.'); location.href='/web/index.php';</script>";
    } ?>