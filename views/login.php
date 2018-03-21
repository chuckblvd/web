<?php

	if(isset($_REQUEST['login'])){

		$uname = $_REQUEST['username'];
		$pwd = $_REQUEST['password'];

		if(!$login = $db->get_row("SELECT * FROM tbl_user WHERE username = '$uname' AND pwd = '$pwd' AND activated = 1")){
			echo 'error';
		}
		else{
			
			$_SESSION['role'] = $login->role;
			echo $_SESSION['role'];
			
		}
	}

	if(isset($_REQUEST['logout'])){

		session_unset(); 
		session_destroy(); 
		// echo $_SESSION['role'];

	}

	?>

	<div>
		<form name=login method=POST>
			Username: <input type=text name=username><br>
			Password: <input type=password name=password><br>
			<input type=submit name=login value=Login>
			<input type=submit name=logout value=Logout>
		</form>
	</div>