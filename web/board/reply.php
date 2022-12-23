<?php 
session_start(); 
include $_SERVER['DOCUMENT_ROOT']."/web/board/db.php"; 

    $bno = $_GET['idx'];
    $date = date('Y-m-d');
    $username = htmlspecialchars($_SESSION['user_id']);
    $content = htmlspecialchars($_POST['content']);

    if($bno &&  $_POST['content']){
        $sql = "INSERT into reply(con_num,name,content,date) values(?,?,?,?)";
        $stmt = $db->stmt_init();
        $stmt = $db->prepare($sql);
        $stmt->bind_param('isss', $bno, $username, $content, $date);
        $stmt -> execute();
    
        $sql2 = mq("SELECT * from board where idx='".$bno."'"); 
        $board = $sql2->fetch_array();
        echo "<script>alert('댓글이 작성되었습니다.');</script>";
        $idx = $board['idx']; $hit = $board['hit'];
        echo "<script>location.href='/web/board/read.php?idx=$idx&hit=$hit'</script>"; 
    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    } 
?>