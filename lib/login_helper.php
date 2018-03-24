<?php
include('../config.php');	
include('libraries.php');

if(isset($_POST['uname'],$_POST['pwd'])){
	$uname = $_POST['uname'];
	$pwd = $_POST['pwd'];
	if($check_user = $db->get_row("SELECT * FROM tbl_user WHERE username = '$uname' AND pwd = '$pwd' AND activated = 1")){
		$_SESSION[WEBSITE_ALIAS]['user']['id'] = $check_user->id;
		$_SESSION[WEBSITE_ALIAS]['user']['uname'] = $check_user->username;
		$_SESSION[WEBSITE_ALIAS]['user']['role'] = $check_user->role;
		echo 'success';
	}
	else{
		session_unset();
		session_destroy();
		echo 'error';
	}
}

?>