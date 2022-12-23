<?php
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 

if($_POST['pw_chk']==1 && $_POST['idx_chk']==$_GET['idx']){

	$bno = $_GET['idx'];
	$sql = mq("delete from iboard where idx='$bno';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/web/board/inquiry_board.php" />
<?php }
else{
  echo "<script>alert(' 잘못된 접근입니다. '); location.href='./inquiry_board.php';</script>";
}
?>