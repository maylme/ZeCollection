<?php
	include('includes/header.php');
?>
<div class="login">
	<h2>Login Here</h2>
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
	<button onclick="loggin();">Login</button>
	</p>
</div>
<script>
	function loggin(){

    	$.ajax({
	        url: "/model/login_submit.php",
	        type: 'POST',
	        async: true,
	        cache: false,
	        timeout: 30000,
	        data:{
	        	"username":$("#username").val(),
	        	"password":$("#password").val()
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
	};

	function displayMessage(string){
		$("#message").html(string);
		$("#message").css({"height":"auto"});
		$("#message").css({"display":"block"});
	}
</script>

<?php
	include('includes/footer.php');
?>