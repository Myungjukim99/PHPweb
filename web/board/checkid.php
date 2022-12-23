
<body align=center style="margin-top: 90px;">

<?php
    include "../db_conn.php";

    $stmt = $db->stmt_init();
    $uid=$_GET['userid'];

    $sql= "SELECT * from member where id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $uid);
    $stmt-> execute();
    $member = $stmt->get_result();
    $num_of_rows = $member->num_rows;
    $stmt -> close();

    if($num_of_rows==0)
    {
    echo "$uid 는 사용가능한 아이디입니다.";
    }else{
    echo "$uid 는 중복된아이디입니다.";
    }

?>

<button type="submit" id="btn" onclick="window.close()">닫기</button>

</body>