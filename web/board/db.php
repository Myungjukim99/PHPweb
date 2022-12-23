<?php
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

	
	$db = new mysqli("localhost","myungju","1234","bbs"); 
	$db->set_charset("utf8");
	$conn = mysqli_connect('localhost','myungju','1234');
	mysqli_select_db($conn,'bbs');

function mq($sql)
{
	global $db;
	return $db->query($sql);
}
?>