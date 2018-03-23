<?php
include('config.php');	
include(PATH_LIBRARIES.'libraries.php');
if(!isset($_GET["page"])){
	$page = 'home';
}
else{
	$page = $_GET["page"];
}

$metaVal = $db->get_row("SELECT * FROM tbl_pages WHERE slug = '$page' AND activated = 1");
$meta_title = BRAND_NAME." - ".ucfirst($page)." - ".$metaVal->title;
$meta_description = $metaVal->meta_description;
$meta_keywords = $metaVal->meta_keywords;

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $meta_title ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="keywords" content="<?php echo $meta_keywords; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>

	<?php 
	$file = BASE_URL."views/".$page.".php";

	$file_headers = get_headers($file);

	if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
		require_once("404.html");
	}
	else{
		require_once("views/".$page.".php"); 
	}
	?>
	


</body>
</html>