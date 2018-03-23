<?php
// session_start();
// include('../config.php');	
// include('libraries.php');

if(isset($_POST['uname'],$_POST['pwd'])){
	$uname = $_POST['uname'];
	$pwd = $_POST['pwd'];
	echo $uname;
	// if($check_user = $db->get_row("SELECT * FROM tbl_user WHERE username = '$uname' AND pwd = '$pwd' AND activated = 1")){
	// 	$user_id = $check_user->id;
	// 	$uname = $check_user->username;
	// 	$pwd = $check_user->pwd;
	// 	$role = $check_user->role;
	// 	$_SESSION[WEBSITE_ALIAS]['user']['id'] = $user_id;
	// 	// $_SESSION[WEBSITE_ALIAS]['user']['uname'] = $uname;
	// 	// $_SESSION[WEBSITE_ALIAS]['user']['pwd'] = $pwd;
	// 	// $_SESSION[WEBSITE_ALIAS]['user']['role'] = $role;
	// 	// echo $_SESSION[WEBSITE_ALIAS]['user']['id'];
	// 	echo $_SESSION[WEBSITE_ALIAS]['user']['id'];
	// }
	// else{
	// 	echo 'error';
	// }
}

?>
