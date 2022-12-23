<?php 
include $_SERVER['DOCUMENT_ROOT']."/web/db_conn.php";
$user_id = $_SESSION['user_id']; 

	if($user_id == ""){
		echo '<script> alert("회원이 아닙니다."); history.back(); </script>';
	}else{

		      $admin = 'admin';
          $sql = mq("SELECT * from member Where role ='".$admin."'");
          $member = $sql->fetch_array();

            $admin_id=$member['id'];

			if($user_id == $admin_id) 
			{ 
          $bno = $_GET['idx'];
          $content = $_POST['content'];
          if($bno && $_POST['content']){
                
        $db = new mysqli("localhost","myungju","1234","bbs"); 
        $db->set_charset("utf8");
        $conn = mysqli_connect('localhost','myungju','1234');
        mysqli_select_db($conn,'bbs');

        $sql2 = mq("INSERT into ireply(con_num,content) values('".$bno."','".$content."')");
        $sql3 = mq("SELECT * from iboard where idx='".$bno."'"); 
        echo "<script>alert('답변이 작성되었습니다.');</script>";
        echo "<script>location.href='/login case 1/board/iread.php?idx=$bno'</script>"; 
            }else{
        echo "<script>alert('답변 작성에 실패했습니다.'); 
        history.back();</script>";
    } 


		}else{
		echo '<script> alert("관리자 계정이 아닙니다."); history.back(); </script>';	}
}
?>
