
 <ul id="menu_user" class="nav navbar-nav navbar-right">
<li>
	<a href="#">
		
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
		<?php echo $_SESSION['user']->username; ?>
	</a>
</li>

<li>
	<a href="#" onclick="logout();" data-toggle="tooltip" title="Logout">
		<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
	</a>
</li>
</ul>
<script>

function logout(){
	$.ajax({
        url: "/model/loggout.php",
        type: 'POST',
        async: true,
        cache: false,
        timeout: 30000,
        error: function(){
            console.log("error");
        },
        success: function(msg){ 
        	if (msg=='done'){
        		window.location.href="/";
        	}else{
        		console.log("can't loggout");
        	}
        }
	});
}


</script>