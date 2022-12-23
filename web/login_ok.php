<?php session_start(); ?>
<meta charset="utf-8" />

<?PHP
	include "./db_conn.php";

	if($_POST["id"] == "" || $_POST["pw"] == ""){
		echo '<script> alert("아이디나 패스워드 입력하세요"); history.back(); </script>';
	}else{

  $stmt = $db->stmt_init();
  $password=$_POST['pw'];

  $sql= "SELECT * FROM member WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param('s', $_POST['id']);
  $stmt-> execute();
  $member = $stmt->get_result();
  $row = $member->fetch_assoc();

	if(password_verify($password, $row['pw']))
	{ 
	$_SESSION['user_id'] = $_POST['id'];
	$_SESSION['user_pw'] = $_POST['pw'];
	
	echo "<script>alert('로그인되었습니다.'); location.href='main.php';</script>";
 } else { 
echo "<script>alert('아이디 혹은 비밀번호를 확인하세요. '); location.href='index.php';</script>";
  }
}
?>
