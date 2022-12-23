<?php
	include "./db_conn.php";

  if($_POST["userid"] == "" || $_POST["pw"] == "" || $_POST["name"] == "" || $_POST["adress"] == "" || $_POST["sex"] == "" || $_POST["email"] == ""){
		echo '<script> alert("필수 입력란을 작성해주세요."); history.back(); </script>';
	}else{

$sql= "INSERT INTO member(id, pw, name, adress, sex, email) VALUES(?,?,?,?,?,?)";

$stmt = $db->stmt_init();
$stmt = $db->prepare($sql);
$stmt->bind_param('ssssss', $_POST['userid'], $encrypted_pw , $_POST['name'], $_POST['adress'], $_POST['sex'], $email);
$encrypted_pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$email = $_POST['email'].'@'.$_POST['emadress'];

$stmt -> execute();

?>

<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=./index.php">

<?php
 $stmt -> close();
 $conn -> close(); 
} ?>