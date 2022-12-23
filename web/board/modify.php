    <!--- 게시글 수정 -->
<?php
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 
   
	$bno = $_GET['idx'];
	$sql = mq("select * from board where idx='$bno';");
	$board = $sql->fetch_array();


 ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>수정 페이지</title>
<link href="style1.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="board_box">
        <h1>자유게시판</h1>
        <h4>누구나 자유롭게 글을 작성하는 공간입니다. <br>
        광고 및 도배성 게시물, 욕설이나 비방은 삭제됩니다. </h4> <br>
            <div id=textarea style="margin-top: 30px;"> 
            <?php
             $idx = $board['idx']; $hit = $board['hit']; ?>
             <form action="/web/board/modify_ok.php?idx=<?php echo $idx;?>&hit=<?php echo $hit;?>" method="POST">
                <style type="text/css">
                        textarea{resize:  none; border-radius: 4px; padding: 10px 0 0 10px;}
                    </style>
                    <div id="title">
                        <textarea name="title" id="title" rows="1" style="font-size: 1vw; width:75%;" cols="60" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                     <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="content" rows="7" style="font-size: 1vw; width:75%;" cols="60" placeholder="내용" required></textarea>
                    </div>
                    <div id="in_pw" style="margin-top:20px;">
                 <input type="password" size="20" name="pw_chk" placeholder="비빌번호 재확인">
                <input type="submit" value="수정하기" />
                <input type="reset" value="다시쓰기" />
                <input type="hidden" name="idx_chk" value="<?php echo $bno;?>"> 
                <br><br><a href="javascript:history.back();" style="color:black;">이전 페이지로 이동</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>