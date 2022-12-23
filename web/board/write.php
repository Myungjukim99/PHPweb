<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; ?>

<!doctype html>
<head>
<meta charset="UTF-8">
<link href="./style1.css" rel="stylesheet" type="text/css" />
<title>게시판</title>
</head>
<body>
    <div id="board_box">
        <?php if ($_GET['mem']==1 && $_SESSION['user_id']) { ?>
        <h1 style="margin-top: 50px;">자유게시판</h1>
        <h4  style="margin-bottom: 30px;">누구나 자유롭게 글을 작성하는 공간입니다. <br>
        광고 및 도배성 게시물, 욕설이나 비방은 삭제됩니다. </h4> <br>
            <div id="write_area">
                <form action="./write_ok.php" method="post" enctype="multipart/form-data"> 
                    <style type="text/css">
                        textarea{resize:  none; border-radius: 4px; padding: 10px 0 0 10px;}
                    </style>
                    <div id="title">
                        <textarea name="title" id="title" rows="1" style="font-size: 1vw; width:75%;" cols="60" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="name" id="name" rows="1" style="font-size: 1vw; width:75%;" cols="60" placeholder="<?php echo $_SESSION["user_id"];?> " maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="content" rows="7" style="font-size: 1vw; width:75%;" cols="60" placeholder="내용" required></textarea>
                    </div>
                    <div id="in_pw">
                        <input type="password" name="pw" id="pw" placeholder="비밀번호" required />  
                    </div>
                        <div id="in_lock">
                        <input type="checkbox" value="1" name="lockpost" />해당글을 잠급니다.
                    </div>
                    <div id="in_file">
                        <input type="file" id="b_file" value="1" name="b_file" />
                    </div>
                    <div class="bt_se">
                    </br>
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            <?php } 
            else { ?>
        <h1 style="margin-top: 50px;">문의게시판</h1>
        <h4  style="margin-bottom: 30px;">문의는 빠른시일내로 답변됩니다. <br>
        광고 및 도배성 게시물, 욕설이나 비방은 삭제됩니다. </h4> <br>
   <div id="write_area">
                <form action="./iwrite_ok.php" method="post" enctype="multipart/form-data"> 
                    <style type="text/css">
                        textarea{resize:  none; border-radius: 4px; padding: 10px 0 0 10px;}
                    </style>
                    <div id="title">
                        <textarea name="title" id="title" rows="1" style="font-size: 1vw; width:75%;" cols="40" placeholder="제목" maxlength="20" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="name" id="name" rows="1" style="font-size: 1vw; width:75%;" cols="40" placeholder="이름" maxlength="20" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_number">
                        <textarea name="number" id="number" rows="1" style="font-size: 1vw; width:75%;" cols="40" placeholder="연락처" maxlength="13" required></textarea>
                    </div>
                    <div id="in_content">
                        <textarea name="content" id="content" rows="7" style="font-size: 1vw; width:75%;" cols="60" placeholder="내용" required></textarea>
                    </div>
                    <div id="in_pw">
                        <input type="password" name="pw" id="pw" placeholder="비밀번호" required />  
                    </div>
                      <div id="in_lock">
                        <input type="checkbox" value="1" name="lockpost" />해당글을 잠급니다.</div>
                    <div id="in_file">
                        <input type="file" id="b_file" value="1" name="b_file" />
                    </div>
                    <div class="bt_se">
                    </br>
                        <button type="submit">글 작성</button>
                    </div>
                </form>
           <?php } ?>
            </div>
        </div>
    </body>
</html>