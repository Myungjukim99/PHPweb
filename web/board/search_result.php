<?php 
include_once
  $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 
 if($_GET["search"] == "" || $_GET["catgo"] == ""){
    echo '<script> alert("필수 입력란을 작성해주세요."); history.back(); </script>';
  }else{
  ?>

<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="./style1.css" />
</head>
<body>
<div id="board_box"> 

<?php
  $catgo = $_GET['catgo'];
    if(preg_match('/%|script/i',$_GET['search'])) {
    exit("<h1>It's not allowed.</h1>");
  }
  else{
?>
  <h1><?php echo $catgo; ?>에서 '<?php echo $_GET['search']; ?>'검색결과</h1>
  <h4 style="margin-top:30px;"><a href="../main.php">홈으로</a></h4>
    <table class="list-table">
      <thead>
        <tr>
        <th width="70">번호</th>
        <th width="500">제목</th>
        <th width="120">글쓴이</th>
        <th width="100">작성일</th>
            </tr>
        </thead> 
        <?php

if($catgo = "title" or "name" or "content")
{
    $param = htmlspecialchars("%{$_GET['search']}%");
    
    $sql2= "SELECT * from board where $catgo like ? order by idx desc";
    $stmt = $db->prepare($sql2);
    $stmt->bind_param('s', $param);
    $stmt-> execute();
    $member = $stmt->get_result();
    while($board= $member->fetch_assoc()){
           
          $title=$board["title"]; 
            if(strlen($title)>30)
              { 
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
            $sql3 = mq("SELECT * from reply where con_num='".$board['idx']."'");
            $rep_count = mysqli_num_rows($sql3);
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>
          <td width="500">
            <?php 
              $lockimg = "<img src='/web/board/img/lock1.png' alt='lock' title='lock' with='20' height='20' />";
              if($board['lock_post']=="1")
              { ?><a href='/web/board/ck_read.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
              }else{?>

        <!--- 추가부분 18.08.01 END -->
        <a href='/web/board/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; }?><span class="re_ct">[<?php echo $rep_count;?>]</span></a></td>
          <td width="120"><?php echo $board['name']?></td>
          <td width="100"><?php echo $board['date']?></td>
          <td width="100"><?php echo $board['hit']; ?></td>

        </tr>
      </tbody>

      <?php } ?>
    </table>
    <!-- 18.10.11 검색 추가 -->
    <div id="search_box2">
      <form action="/web/board/search_result.php" method="get">
      <select name="catgo">
        <option value="title">제목</option>
        <option value="name">글쓴이</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required"/> <button>검색</button>
    </form>
  </div>
</div>
</body>
</html>

<?php
}
else{
  echo "<script>alert(' 잘못된 검색입니다. '); location.href='./inquiry_board.php';</script>";
}}}
?>