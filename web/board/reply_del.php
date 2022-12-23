<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; ?>


<!DOCTYPE html>
<html>
<head>
	
    <meta charset="utf-8" />
</head>
<body>
	<?php

	$bno = $_GET['idx']; 
	$rno = $_GET['rno'];
	$sql = mq("SELECT * from reply WHERE con_num='".$bno."' AND idx='".$rno."'"); 
	$reply = $sql->fetch_array();

	if($_SESSION['user_id'] == $reply['name']) 
	{
		$sql = mq("DELETE from reply where idx='".$rno."'"); ?>
			<script type="text/javascript">alert('댓글이 삭제되었습니다.');</script>
			<script>location.href='/web/board/read.php?idx=<?php echo $bno; ?>'</script>

 <?php	}
	else{  ?>
		<script type="text/javascript">alert('댓글 작성자 본인만 삭제가 가능합니다.');</script>
		<script> history.back(); </script>

	<?php } ?>

</body>
</html>