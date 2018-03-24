<div>
	Username: <input type=text name=username id=uname><br>
	Password: <input type=password name=password id=pwd><br>
	<button type=button name=login id=submit>LOGIN</button>


	<br><br>
	<a href="<?php echo BASE_URL.'home/chuck';?>">home</a>
</div>

<div id=bruh></div>

<footer>
	<?php include('footer.php');?>

	<script>
		$('#submit').on('click',function(){
			var uname = $.trim($('#uname').val());
			var pwd = $.trim($('#pwd').val());
			$.post(
				'lib/login_helper.php',
				{
					uname:uname,pwd:pwd
				},
				function(data){
					alert(data);
					if(data=="success"){
						document.location='index.php?page=home';
					}
					if(data=="error"){
						document.location='index.php?page=home';
					}
				});
		});
	</script>
</footer>