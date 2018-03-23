<?php

if(isset($_SESSION[WEBSITE_ALIAS]['user']['id'])){
	echo $_SESSION[WEBSITE_ALIAS]['user']['id'];
}

?>

<div>hi</div>

<a href="<?php echo BASE_URL.'login';?>">login</a>