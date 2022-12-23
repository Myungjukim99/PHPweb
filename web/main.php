<?php session_start(); include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 
if(isset($_SESSION['user_id'])){?>
<!doctype html>
<head>
<meta charset="UTF-8">
<link href="/web/board/style1.css" rel="stylesheet" type="text/css" />
<title>자유 게시판</title>
</head>
<body>
<style>
    a { text-decoration: none; color: deeppink; padding: 5px;} 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: black;} 
</style>
</script>
<div style="">
<div id="board_box" > 
  <h1 style="margin-top: 40px;">자유 게시판</h1>
  <h4 style="margin-bottom: 50px;">자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
    <table class="list-table" >
      <thead>
          <tr>
                <th width="70">번호</th>
                <th width="100">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
      </thead>
               <?php
         if(isset($_GET['page'])){
          $page = $_GET['page'];
            }else{
              $page = 1;
            }
              $sql = mq("SELECT * from board");
              $row_num = mysqli_num_rows($sql); 
              $list = 6;
              $block_ct = 6; 

              $block_num = ceil($page/$block_ct); // 현재 블록 index sort, ceil 무조건 소수점 자리를 올린다. page=1, page=2  sort
              $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 index sort 시작번호, 8
              $block_end = $block_start + $block_ct - 1; //블록 index sort 마지막 번호

              $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
              if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
              $total_block = ceil($total_page/$block_ct); //블럭 총 개수
              $start_num = ($page-1) * $list; //현재 블록 시작번호 

              $sql2 = mq("SELECT * from board order by idx desc limit $start_num, $list");  
              while($board = $sql2->fetch_array()){
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
          <td width="70" align="center"><?php echo $board['idx']; ?></td>
          <td width="500" align="center"><h4>
          <?php
          $lockimg = "<img src='/web/board/img/lock1.png' alt='lock' title='lock' width='20' height='20' /> ";
          if($board['lo_post']=="1")
            { ?> <a href='/web/board/ck_read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title, $lockimg; ?> </a> <?php } 
          else { ?>
          <?php
          $idx = $board['idx']; $hit = $board['hit']; ?>
            <a href='/web/board/read.php?idx=<?php echo $idx; ?>&hit=<?php echo $hit; ?>'><?php echo $title; ?></a>
          <?php } ?>
          </h4></td>
          <td width="120" align="center"><?php echo $board['name'];?></td>
          <td width="100" align="center"><?php echo $board['date'];?></td>
          <td width="100" align="center"><?php echo $board['hit']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <div id="btn">
    	<br><br>
      <a href="/web/board/write.php?mem=1"><button>글쓰기</button></a>
    </div>
        <div id="page_num">
          <ul>
        <?php
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면
            echo "<a class='fo_re'>처음</a>"; //처음이라는 글자에 빨간색 표시 
          }else{
            echo "<a><a href='?page=1'>처음</a></a>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
          }
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면 빈값
            
          }else{
          $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
            echo "<a><a href='?page=$pre'>이전</a></a>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
          }
          for($i=$block_start; $i<=$block_end; $i++){ 
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i){ //만약 page가 $i와 같다면 
              echo "<a class='fo_re'>[$i]</a>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
            }else{
              echo "<a><a href='?page=$i'>[$i]</a></a>"; //아니라면 $i
            }
          }
          if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
          }else{
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo "<a><a href='?page=$next'>다음</a></a>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
          }
          if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
            echo "<a class='fo_re'>마지막</a>"; //마지막 글자에 긁은 빨간색을 적용한다.
          }else{
                echo "<a><a href='?page=$total_page'>마지막</a></a>"; //아니라면 마지막글자에 total_page를 링크한다.
          }
        ?>
      </ul>
   <div id="search_box" style="text-align: center; margin-top: 20px;">
    <form action="/web/board/search_result.php" mothod="get">
      <select name="catgo">
        <option value="title">제목</option>
        <option value="name">글쓴이</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required">
      <button class="btn"> 검색</button>
    </form>
  </div>
    </div>
  <div id=box  style="position: static; float: right;">
  <div id="login_box"> 
<img src='/web/board/img/jerry.jpg' alt='lock' title='lock' width='250' height='200' />
</div>
  <div id="information" style="margin-bottom: 10px;"> 
<h1>개인정보</h1>
<h4>
    <?php
    echo $_SESSION['user_id']; ?> 님 환영합니다. 
<a href="logout.php"><input type="button" value="로그아웃" /></a>
</h4>
    <br><a href="/web/board/ck_mypage.php"><button type="button" value="마이페이지">마이페이지</button></a>
</div>
 <div id="c_board"> 
<h1>문의 게시판</h1>
  <a href="/web/board/inquiry_board.php" ><button>문의 게시판</button></a>
</div>
</div></div></div>
</body>
</html>
<?php }
else
{
  echo "<script>alert(' 잘못된 접근입니다. '); location.href='./index.php';</script>";
} ?>