<?php session_start(); 
include $_SERVER['DOCUMENT_ROOT']."/web/db_conn.php";?>

<style>
    a { text-decoration: none; color: deeppink; padding: 5px;} 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: black;} 
</style>

<link href="./style1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript">

    $(function(){
        $("#writepass").dialog({
            modal:true,
            title:'비밀글입니다.',
            width:400,
        });
    });
</script>
<?php
$sql = mq("SELECT * from member Where id='".$_SESSION['user_id']."'"); 
$member = $sql->fetch_array();
?>
<div id='writepass' align="center" style="margin-top:80px">
    <form action="" method="post">
    <img src='/web/board/img/pink.jpg' alt='pink' title='pink' width='800' height='500' style="margin-bottom: 30px;" /> 
        <p>비밀번호<input type="password" name="pw_chk" /> <input type="submit" value="확인" /></p>
        <br><a href="javascript:history.back();" style="color: black;">이전 페이지로 이동</a>
    </form>
</div>
     <?php
        $bpw = $member['pw']; 
        if(isset($_POST['pw_chk'])) //만약 pw_chk POST값이 있다면
        {
            $pwk = $_POST['pw_chk']; 
            // $pwk변수에 POST값으로 받은 pw_chk를 넣습니다.
           if(password_verify($pwk, $bpw))//다시 if문으로 DB의 pw와 입력하여 받아온 bpw와 값이 같은지 비교를 하고
            {
            ?>

                <script>location.href='./mypage.php'</script> 
            <?php 
            }else{ ?>
                <script type="text/javascript">alert('비밀번호가 틀립니다');</script>
            <?php } } 
        ?>