<?php 
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; ?>


<!doctype html>
<head>
<meta charset="UTF-8">
   <style>
    a { text-decoration: none; color: dodgerblue; } 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: royalblue;} 
  </style>

<title>게시판</title>
<link href="./style1.css" rel="stylesheet" type="text/css" />
<link href="jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="./js/jquery-ui.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
</head>
<body>
	<?php
	$bno = $_GET['idx']; 
	$sql = mq("SELECT * from iboard where idx='".$bno."'"); 
	$iboard = $sql->fetch_array();

	if($iboard['lo_post']==1 && $_POST['pw_chk']==1 && $_POST['idx_chk']==$bno)
{	
	?>
<!-- 글 불러오기 -->

<div id="board_box">
	<h1><?php echo $iboard['title']; ?></h1>
		<div id="user_info">
			<h4>
			<td>이름: <?php echo $iboard['name']; ?> </td>
			<td style="margin-left: 15px">전화번호: <?php echo $iboard['pnumber']; ?> </td>
			<td style="margin-left: 15px">날짜: <?php echo $iboard['date']; ?> </td>
			<div>
파일 : <a href= "../../upload/<?php echo $iboard['file'];?>" download> <?php echo $iboard['file'];?> </a>


</div>
		</h4>
				<div id="bo_line"></div>
			</div>
			<hr><br><br>
			<div id="bo_content">
				<?php echo nl2br("$iboard[content]"); ?>
			</div>
			<br><br>
	<!-- 목록, 수정, 삭제 -->
	<div style="border: 1px;" id="bo_ser">
		<ul>
			<a href="/web/board/inquiry_board.php">[목록으로]</a>
			<a href="./idelete.php?idx=<?php echo $iboard['idx']; ?>">[삭제]</a>
		</ul>
	</div>
		<div  class="reply_view">
		<?php
			$sql3 = mq("SELECT * from ireply where con_num='".$bno."'");
			while($ireply = $sql3->fetch_array()){
		?>
			<div  class="reply_view" style="padding: auto; margin-top: 20px">
			<h3 >답변</h3>
			<div><?php echo nl2br("$ireply[content]");?></div>
		</div>
	<?php }  ?>

	<div class="dap_ins"> 
		<form action="/web/board/ck_account.php?idx=<?php echo $iboard['idx'];?>" method="post">
				<ul><textarea style="resize: none; width: 700px; height: 100px; border-radius: 4px; padding: 10px 0 0 10px; margin-top: 20px;" name="content" id="re_content" placeholder="관리자만 답변을 달수있습니다."></textarea></ul>
				<button id="rep_bt" class="re_bt" style="margin-top: 20px;">답변</button>
			</div>
		</form>
		</div>
</body>
</html>
<?php
}
elseif($iboard['lo_post']==0) { ?>
<!-- 글 불러오기 -->

<div id="board_box">
	<h1><?php echo $iboard['title']; ?></h1>
		<div id="user_info">
			<h4>
			<td>이름: <?php echo $iboard['name']; ?> </td>
			<td style="margin-left: 15px">전화번호: <?php echo $iboard['pnumber']; ?> </td>
			<td style="margin-left: 15px">날짜: <?php echo $iboard['date']; ?> </td>
			<div>
파일 : <a href="/upload/<?php echo $iboard['file'];?>" download> <?php echo $iboard['file'];?> </a>


</div>
		</h4>
				<div id="bo_line"></div>
			</div>
			<hr><br><br>
			<div id="bo_content">
				<?php echo nl2br("$iboard[content]"); ?>
			</div>
			<br><br>
	<!-- 목록, 수정, 삭제 -->
	<div style="border: 1px;" id="bo_ser">
		<ul>
			<a href="/web/board/inquiry_board.php">[목록으로]</a>
			<a href="./idelete.php?idx=<?php echo $iboard['idx']; ?>">[삭제]</a>
		</ul>
	</div>
		<div  class="reply_view">
		<?php
			$sql3 = mq("SELECT * from ireply where con_num='".$bno."'");
			while($ireply = $sql3->fetch_array()){
		?>
			<div  class="reply_view" style="padding: auto; margin-top: 20px">
			<h3 >답변</h3>
			<div><?php echo nl2br("$ireply[content]");?></div>
		</div>
	<?php }  ?>

	<div class="dap_ins"> 
		<form action="/web/board/ck_account.php?idx=<?php echo $iboard['idx'];?>" method="post">
				<ul><textarea style="resize: none; width: 700px; height: 100px; border-radius: 4px; padding: 10px 0 0 10px; margin-top: 20px;" name="content" id="re_content" placeholder="관리자만 답변을 달수있습니다."></textarea></ul>
				<button id="rep_bt" class="re_bt" style="margin-top: 20px;">답변</button>
			</div>
		</form>
		</div>
</body>
</html>
<?php
}
else{
  echo "<script>alert(' 잘못된 접근입니다. '); location.href='./inquiry_board.php';</script>";
}
?>