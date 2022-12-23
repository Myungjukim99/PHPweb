<?php 
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 
  
    $bno = $_GET['idx']; 
    $thumbup = $_GET['thumbup'];
    $thumbup = mq("SELECT hit from board where idx ='".$bno."'");
    $thumbup = $_GET['thumbup']+1; 
    $fet = mq("UPDATE board set thumbup = '".$thumbup."' WHERE idx = '".$bno."'");
    $sql = mq("SELECT * from board where idx='".$bno."'"); 
    $board = $sql->fetch_array();
    ?>
   <script type="text/javascript">alert("좋아요되었습니다."); </script>
    <?php 
          $idx = $board['idx']; $hit = $board['hit'];
          echo "<script>location.href='/web/board/read.php?idx=$idx'</script>"; ?>