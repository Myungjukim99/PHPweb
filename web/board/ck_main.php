<?php session_start(); 

 if(isset($_SESSION['user_id']))
    {
    echo "<script> location.href='/web/main.php';</script>";
}else{
    echo "<script> alert('로그인이 필요합니다.'); location.href='/web/index.php';</script>";
    }
      ?>