<?php
    header('Content-type:text/html;charset=utf-8');
	$session_time = 1 * 60;
	session_set_cookie_params($session_time);
	session_start();
	$_SESSION['name'] ='李四';
	echo session_id();
?>