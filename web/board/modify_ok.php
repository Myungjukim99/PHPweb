<?php 
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 

  $bno = $_GET['idx'];
  $sql = mq("select * from board where idx='$bno';");
  $board = $sql->fetch_array();

 if(password_verify($_POST['pw_chk'],$board['pw']) && $_POST['idx_chk']==$_GET['idx'])
 {

$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);

$sql = "UPDATE board set title=?,content=? where idx='".$bno."'";
$stmt = $db->stmt_init();
$stmt = $db->prepare($sql);
$stmt->bind_param('ss',  $title, $content);
$stmt -> execute(); ?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<script>location.href='/web/board/read.php?idx=<?php echo $bno; ?>'</script>

<?php }
else{
  echo "<script>alert(' 잘못된 접근입니다. '); location.href='../main.php';</script>";
}
?>
