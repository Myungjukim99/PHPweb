<?php session_start();
include  $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; ?>

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
<link href="./style1.css?after" rel="stylesheet" type="text/css" />
<link href="jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="./js/jquery-ui.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
</head>
<body>
	<?php
	if (isset($_SESSION['user_id'])) {
		$bno = $_GET['idx']; 
		$hit = mq("SELECT hit from board where idx ='".$bno."'");
		$hit = $_GET['hit']+1; 
		$fet = mq("UPDATE board set hit = '".$hit."' where idx = '".$bno."'");
		$sql = mq("SELECT * from board where idx='".$bno."'"); 
		$board = $sql->fetch_array();

	if($board['lo_post']==1 && $_POST['pw_chk']==1 && $_POST['idx_chk']==$bno)
{	
	?>
<!-- 글 불러오기 -->

<div id="board_box">
	<h1><?php echo $board['title']; ?></h1>
		<div id="user_info">
			<h4>
			<?php echo $board['name']; ?>
			<?php echo $board['date']; ?> 
			조회:<?php echo $board['hit']; ?>
			<img src='/web/board/img/like1.png' alt='lock' title='lock' width='20' height='20' />:<?php echo $board['thumbup']; ?>
			<div>
파일 : <a href= "../../upload/<?php echo $board['file'];?>" download> <?php echo $iboard['file'];?> </a>

</div>
		</h4>
				<div id="bo_line"></div>
			</div>
			<hr><br><br>
			<div id="bo_content">
				<?php echo nl2br("$board[content]"); ?>
			</div>
			<br><br>
	<!-- 목록, 수정, 삭제 -->
	<div style="border: 1px;" id="bo_ser">
		<ul>
			<a href="/web/main.php">[목록으로]</a>
			<?php
			 $idx = $board['idx']; $thumbup = $board['thumbup'];
          echo "<a href='./thumbup.php?idx=$idx&thumbup=$thumbup'><img src='./img/like.png' alt='lock' title='lock' width='30' height='30' /></a>"; ?>
          	<?php
			 $idx = $board['idx']; $thumbup = $board['thumbup'];
          echo "<a href='./thumbup_cancel.php?idx=$idx&thumbup=$thumbup'>[좋아요 취소]</a>"; ?>
			<?php	
			 $idx = $board['idx']; $hit = $board['hit'];
          echo "<a href='./modify.php?idx=$idx'>[수정]</a>"; ?>
			<a href="./delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a>
		</ul>
	</div> <br>
	<!--- 댓글 불러오기 -->
<div  class="reply_view" style="align-content: center;">
	<h3>댓글목록</h3>
		<?php
			$sql3 = mq("SELECT * from reply where con_num='".$bno."' order by idx desc limit 0,5");
			while($reply = $sql3->fetch_array()){
		?>
		<div class="dap_lo" style="margin-top: 10px; padding: 10 10 10 10px;">
			<div><b style="color: red; margin-right: 15px;"> ID:  <?php echo $reply['name'];?></b> <b style="color: deeppink; margin-right: 15px;">Comment: <?php echo nl2br("$reply[content]");?></b> 
      <a href="./reply_del.php?idx=<?php echo $board["idx"];?>&rno=<? echo $reply["idx"];?> ">[삭제]</a>
		</div>
	<?php } ?>
	</div><br>
   
	<!--- 댓글 입력 폼 -->
	<div class="dap_ins"> 
		<form action="./reply.php?idx=<?php echo $bno; ?>" method="post">
			<h3 style="margin-top: 20px; margin-bottom: 10px;">댓글 입력</h3>
			<textarea style="resize: none; width: 300px; border-radius: 4px; padding: 5px 0 0 5px; height: 30px;" name="content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt" style="margin-left: 10px; margin-bottom: 30px; vertical-align: middle;">댓글</button>
		</form>
</div>
<div id="foot_box"></div>
		</div>
</body>
</html>
<?php
}
elseif($board['lo_post']==0) { ?>

<div id="board_box">
	<h1><?php echo $board['title']; ?></h1>
		<div id="user_info">
			<h4>
			<?php echo $board['name']; ?>
			<?php echo $board['date']; ?> 
			조회:<?php echo $board['hit']; ?>
			<img src='/web/board/img/like1.png' alt='lock' title='lock' width='20' height='20' />:<?php echo $board['thumbup']; ?>
			<div>

파일 : <a href= "../../upload/<?php echo $board['file'];?>" download> <?php echo $board['file'];?> </a>


</div>
		</h4>
				<div id="bo_line"></div>
			</div>
			<hr><br><br>
			<div id="bo_content">
				<?php echo nl2br("$board[content]"); ?>
			</div>
			<br><br>
	<!-- 목록, 수정, 삭제 -->
	<div style="border: 1px;" id="bo_ser">
		<ul>
			<a href="/web/main.php">[목록으로]</a>
			<?php
			 $idx = $board['idx']; $thumbup = $board['thumbup'];
          echo "<a href='./thumbup.php?idx=$idx&thumbup=$thumbup'><img src='./img/like.png' alt='lock' title='lock' width='30' height='30' /></a>"; ?>
          	<?php
			 $idx = $board['idx']; $thumbup = $board['thumbup'];
          echo "<a href='./thumbup_cancel.php?idx=$idx&thumbup=$thumbup'>[좋아요 취소]</a>"; ?>
			<?php	
			 $idx = $board['idx']; $hit = $board['hit'];
          echo "<a href='./modify.php?idx=$idx'>[수정]</a>"; ?>
			<a href="./delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a>
		</ul>
	</div> <br>
	<!--- 댓글 불러오기 -->
<div  class="reply_view" style="align-content: center;">
	<h3>댓글목록</h3>
		<?php
			$sql3 = mq("SELECT * from reply where con_num='".$bno."' order by idx desc limit 0,5");
			while($reply = $sql3->fetch_array()){
		?>
		<div class="dap_lo" style="margin-top: 10px; padding: 10 10 10 10px;">
			<div><b style="color: red; margin-right: 15px;"> ID:  <?php echo $reply['name'];?></b> <b style="color: deeppink; margin-right: 15px;">Comment: <?php echo nl2br("$reply[content]");?></b> 
      <a href="./reply_del.php?idx=<?php echo $board["idx"];?>&rno=<? echo $reply["idx"];?> ">[삭제]</a>
		</div>
	<?php } ?>
	</div><br>
   
	<!--- 댓글 입력 폼 -->
	<div class="dap_ins"> 
		<form action="./reply.php?idx=<?php echo $bno; ?>" method="post">
			<h3 style="margin-top: 20px; margin-bottom: 10px;">댓글 입력</h3>
			<textarea style="resize: none; width: 300px; border-radius: 4px; padding: 5px 0 0 5px; height: 30px;" name="content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt" style="margin-left: 10px; margin-bottom: 30px; vertical-align: middle;">댓글</button>
		</form>
</div>
<div id="foot_box"></div>
		</div>
</body>
</html>

<?php
}
else{
  echo "<script>alert(' 잘못된 접근입니다. '); location.href='../main.php';</script>";
} }
else{
  echo "<script>alert(' 잘못된 접근입니다. '); location.href='../main.php';</script>";
}
?>