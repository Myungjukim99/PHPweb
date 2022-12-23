<?php 
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<link href="/web/board/style2.css?after" rel="stylesheet" type="text/css" />
<title>문의 게시판</title>
</head>
<body>
<style>
    a { text-decoration: none; color: deeppink; padding: 5px;} 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: black;} 
</style>
<script>
    </script>
<div style="position: relative;">
<div id="board_box" > 
  <h1 style="margin-top: 40px;">문의 게시판</h1>
  <h4 style="margin-bottom: 50px;">문의를 남겨주시면 친절하게 답변해드립니다.</h4>
  <br>
    <table class="list-table">
      <thead>
          <tr>
                <th width="70">번호</th>
                <th width="150">제목</th>
                <th width="120">글쓴이</th>
                <th width="150">작성일</th>
            </tr>
      </thead>
               <?php
         if(isset($_GET['page'])){
          $page = $_GET['page'];
            }else{
              $page = 1;
            }
              $sql = mq("SELECT * from iboard");
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

              $sql2 = mq("SELECT * from iboard order by idx desc limit $start_num, $list");  
              while($iboard = $sql2->fetch_array()){
              $title=$iboard["title"]; 
                if(strlen($title)>30)
                { 
                  $title=str_replace($iboard["title"],mb_substr($iboard["title"],0,30,"utf-8")."...",$iboard["title"]);
                }
                $sql3 = mq("SELECT * from reply where con_num='".$iboard['idx']."'");
                $rep_count = mysqli_num_rows($sql3);
        ?>
      <tbody style="margin-top: 10px;">
        <tr>
          <td width="70" align="center"><?php echo $iboard['idx']; ?></td>
          <td width='500' align='center'><h4>
          <?php
          $lockimg = "<img src='/web/board/img/lock1.png' alt='lock' title='lock' width='20' height='20' /> ";
          if($iboard['lo_post']=="1")
            { ?> <a href='/web/board/ck_iread.php?idx=<?php echo $iboard["idx"]; ?>'><?php echo $title, $lockimg; ?> </a> 
        <?php } 
          else { ?>
          <?php
          $idx = $iboard['idx'];?>
            <a href='/web/board/iread.php?idx=<?php echo $idx?>'><?php echo $title?></a>
          <?php } ?>
          </h4></td>
          <td width="120" align="center"><?php echo $iboard['name'];?></td>
          <td width="100" align="center"><?php echo $iboard['date'];?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <div id="btn">
    	<br><br>
      <a href="/web/board/write.php?mem=0"><button>글쓰기</button></a>
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
    </div>
    <div id="search_box" style="text-align: center; margin-top: 20px;">
    <form action="/web/board/isearch_result.php" mothod="get">
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
  <div id=box>
  <div id="login_box" style=""> 
<img src='/web/board/img/jerry.jpg' alt='lock' title='lock' width='250' height='200' />
</div>
  <div id="information" style="margin-bottom: 10px;">	
<h1>개인정보</h1>
<img src='/web/board/img/lock1.png' alt='lock' title='lock' width='50' height='50' />
</div>
 <div id="c_board"> 
  <h1>자유 게시판</h1>
<form action="./ck_main.php" method="post">
<button type="submit" value="자유 게시판">자유 게시판</button> </form>
</div></div></div>
</body>
</html>
