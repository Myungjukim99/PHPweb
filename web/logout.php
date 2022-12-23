<?php
session_start();
session_destroy();
unset($_SESSION['user_id']);
unset($_SESSION['user_pw']);
?>
<meta charset="utf-8">
<script>alert("로그아웃되었습니다."); location.href="./index.php"; </script>