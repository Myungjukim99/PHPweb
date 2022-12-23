<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; ?>


<style>
    a { text-decoration: none; color: deeppink; padding: 5px;} 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: black;} 

</style>
<link href="./style2.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript">

</script>
<?php

$bno = $_GET['idx']; 
$sql = mq("SELECT * from iboard where idx='".$bno."'"); /* 받아온 idx값을 선택 */
$iboard = $sql->fetch_array();
?>
<div id='writepass' align="center">
	<form action="" method="post">
				<img src='/web/board/img/pink.jpg' alt='pink' title='pink' width='800' height='500' style="margin-bottom: 30px; margin-top: 60px;" /> 
 		<p>비밀번호<input type="password" name="pw_chk" /> <input type="submit" value="확인" /></p>
 		<br><a href="javascript:history.back();" style="color: black;">이전 페이지로 이동</a>
 	</form>
</div>
	 <?php
	 	$bpw = $iboard['pw']; 
	 	if(isset($_POST['pw_chk'])) //만약 pw_chk POST값이 있다면
	 	{
	 		$pwk = $_POST['pw_chk']; 
			if(password_verify($pwk, $bpw))
			{ 	
		?>

			<form id="sample_form" action="/web/board/idelete_ok.php?idx=<?php echo $bno;?>" method="post"> 
		  <input type="hidden" name="pw_chk" value="1"> 
		  <input type="hidden" name="idx_chk" value="<?php echo $bno;?>"> 
			</form> 
			<script type="text/javascript"> 
			this.document.getElementById("sample_form").submit(); 
			</script> 

			<?php
			}else{ ?>
				<script type="text/javascript">alert('비밀번호가 틀립니다');</script>
			<?php } } 
		?>