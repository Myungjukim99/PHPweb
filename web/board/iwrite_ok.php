<?php include
  $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 

if(isset($_POST['lockpost'])){
    $lo_post = '1';
}else{
    $lo_post = '0';
}

$name = htmlspecialchars($_POST['name']);
$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);
$date = date('Y-m-d');
$number = htmlspecialchars($_POST['number']);
$tmpfile =  $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
$folder = "../../upload/".$filename;


move_uploaded_file($tmpfile,$folder);

$encrypted_pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

if($name && $encrypted_pw && $title && $content){
$sql= "INSERT INTO iboard(name,pw,pnumber,title,content,date, lo_post, file) VALUES(?,?,?,?,?,?,?,?)";
$stmt = $db->stmt_init();
$stmt = $db->prepare($sql);
$stmt->bind_param('ssssssss', $name, $encrypted_pw ,$number, $title, $content, $date, $lo_post, $o_name);
$stmt -> execute();
    
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/web/board/inquiry_board.php';</script>";
}else{
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
    }
?>
