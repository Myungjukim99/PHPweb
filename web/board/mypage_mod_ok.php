<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/web/db_conn.php";

	if($_POST["userid"] == "" || $_POST["pw"] == "" || $_POST["name"] == "" || $_POST["adress"] == "" || $_POST["sex"] == "" || $_POST["email"] == ""){
		echo '<script> alert("필수 입력란을 작성해주세요."); history.back(); </script>';
	}else{
  if($_POST['pw_chk']==$_SESSION['user_pw'])
  {
	$id = $_POST['userid'];
	$encrypted_pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
	$name = $_POST['name'];
	$adress = $_POST['adress'];
	$sex = $_POST['sex'];
	$email = $_POST['email'].'@'.$_POST['emadress'];

$sql = "UPDATE member set id=?, pw=?, name=?, adress=?, sex=?, email=? where id='".$_SESSION['user_id']."'"; 
$stmt = $db->stmt_init();
$stmt = $db->prepare($sql);
$stmt->bind_param('ssssss', $id, $encrypted_pw , $name, $adress, $sex, $email);
$stmt-> execute();


?>

<meta charset="utf-8" />
<script type="text/javascript">alert('수정이 완료되었습니다. 다시 로그인해주세요.');</script>
<meta http-equiv="refresh" content="0 url=../index.php">

<?php } } ?>

