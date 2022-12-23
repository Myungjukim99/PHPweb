<?php   
include_once "./db_conn.php"; 
?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title>회원가입 및 로그인 사이트</title>
<link rel="stylesheet" type="text/css" href="common.css"/>
</head>
<body style="background-image: url('/web/board/img/pink.jpg');
  background-size: 100%;">
    <style>
    a { text-decoration: none; color: deeppink; } 
    a:visited { text-decoration: none; }
    a:hover { text-decoration: none; }
    a:focus { text-decoration: none; }
    a:hover, a:active { text-decoration: none; color: black;} 
   </style>
<div style= "border-radius: 30px; background-color: #ffffff;
  background-color: rgba(255,255,255,0.7); width: 400px; height: 400px;
  margin-top: 300px;">
  <div id="login_box">		
      <br><h1 align="center" style="margin-top: 10px">login</h1> 
			<form method="post" action="login_ok.php">
				<table align="center" cborder="0" cellspacing="0" width="0">
        			<tr> 
            			<td width="100" colspan="1"> 
            				<h3 align="left">id<h3>
                		<input type="text" name="id" style="label">
            	</td>
            	<tr>
            		<td width="100" colspan="1">
            			<h3 align="left">password</h3>
            		<input type="password" name="pw" style="label">
            	</td>
            	<tr>
           		<td colspan="1" align="center">
              	<a href="./member.php"><br><h3>회원가입 하시겠습니까?</h3></a>
           </td>
        </tr>
            <tr>
              <td colspan="1" align="center">
                <a href="/web/board/inquiry_board.php"><br><h3>비회원으로 로그인하기</h3></a>
           </td>
        </tr>
            	<tr>
            		<td rowspan="2" width="100" > 
                		<br><button type="submit" id="btn" >로그인</button>
            		</td>
        		</tr>
    </table>
</br></br>
  </form>
</div>
</div>
</body>
</html>