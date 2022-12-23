<?php
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 

if(isset($_POST['lockpost'])){
    $lo_post = '1';
}else{
    $lo_post = '0';
}

$name = htmlspecialchars($_POST['name']);
$pw = htmlspecialchars($_POST['pw']); 
$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);
$date = date('Y-m-d');
$hit = 0;
$thumbup = 0;

$tmpfile =  $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
  if(preg_match('/php|html|asp|jap|\../i',$filename)) {
    exit("<h1>It's not allowed.</h1>");
  }
  else{
$folder =  "../../upload/".$filename;
move_uploaded_file($tmpfile,$folder);
}

$encrypted_pw = password_hash($pw, PASSWORD_DEFAULT);

if($name && $encrypted_pw && $title && $content){
$sql= "INSERT INTO board(name,pw,title,content,date, hit, thumbup, lo_post, file) VALUES(?,?,?,?,?,?,?,?,?)";
$stmt = $db->stmt_init();
$stmt = $db->prepare($sql);
$stmt->bind_param('sssssiiis', $name, $encrypted_pw, $title, $content, $date, $hit, $thumbup, $lo_post, $o_name);
$stmt -> execute();
    
    
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/web/main.php';</script>";
}else{
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
    }
?>
