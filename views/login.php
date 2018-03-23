<div>
	<form name=login method=POST id=formLogin>
		Username: <input type=text name=username id=uname><br>
		Password: <input type=password name=password id=pwd><br>
		<input type=submit name=login value=Login id=submit>
	</form>


	<br><br>
	<a href="<?php echo BASE_URL.'home/chuck';?>">home</a>
</div>

<footer>
	<?php include('footer.php');?>

	<script>

		jQuery.validator.addMethod("noSpace", function(value, element) { 
			return value.indexOf(" ") < 0 && value != ""; 
		}, "No space please and don't leave it empty");

		$('#submit').on('click',function(){
			var uname = $.trim($('#uname').val());
			var pwd = $.trim($('#pwd').val());
			console.log(uname);

			var validator = $('#formLogin').validate({
				rules: {
					username:{
						required:true,
						// email:true,
						maxlength: 50,
						noSpace: true
					},
					password:{
						required:true,
						maxlength:50
					}
				},
				messages:{
					username:{
						required:"Please fill in this Username field."
					},
					password:{
						required:"Please fill in this Password field."
					}
				},
				submitHandler: function(form){
					
					$.post('lib/login_helper.php',{uname:uname,pwd:pwd},function(data){
						
						alert(uname);
						// if(data=='success'){
							// document.location='index.php?page=home';
						// }
						// form.submit();
					});
				}
			});
			validator.resetForm();
			console.log(uname);
		});
	</script>
</footer>