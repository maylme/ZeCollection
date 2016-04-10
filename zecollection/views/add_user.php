<?php
	include_once('includes/header.php');
?>

<?php

	/*** set a form token ***/
	$form_token = md5( uniqid('zecollection', true) );

	/*** set the session form token ***/
	$_SESSION['form_token'] = $form_token;
?>
<div class="login">

		<h2>Register</h2>
		<div id="message"  class="alert alert-danger" role="alert"></div>

		<p>
		<label for="username">Username</label>
		<input type="text" id="username" name="username" value="" maxlength="20" />
		</p>
		<p>
		<label for="password">Password</label>
		<input type="password" id="password" name="password" value="" maxlength="20" />
		</p>
		<p>
		<label for="password">Repeat Password</label>
		<input type="password" id="password2" name="password2" value="" maxlength="20" />
		</p>
		<p>
		<button onclick="addUser();">Register</button>
		</p>
</div>
<script>

	function verifyPass(){
		console.log($("#password").val());
		console.log($("#password2").val());

		if ($("#password2").val() == $("#password").val()){
			return true;
		}else{
			displayMessage("Password must match");
			return false;
		}

	}
	function addUser(){

		if (verifyPass()){

			console.log($("#username").val());
			console.log($("#password").val());


	    	$.ajax({
		        url: "/model/adduser_submit.php",
		        type: 'POST',
		        async: true,
		        cache: false,
		        timeout: 30000,
		        data:{
		        	"username":$("#username").val(),
		        	"password":$("#password").val(),
		        	"form_token":"<?php echo $_SESSION['form_token']; ?>"
		        },
		        error: function(){
		            console.log("error");
		        },
		        success: function(msg){ 
		        	if (msg.message =='Success'){
		        		window.location.href="/";
		        	}else{
		        		displayMessage(msg.message);
		        	}
		        }
			});
	    }
	};

	function displayMessage(string){
		$("#message").html(string);
		$("#message").css({"height":"auto"});
		$("#message").css({"display":"block"});
	}
</script>

<?php
	include_once('includes/footer.php');
?>