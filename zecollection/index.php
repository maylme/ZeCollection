<?php
	include_once('views/includes/header.php');
?>

	<?php 

		if (!$is_logged){
			include ("views/home_guest.php");
		}else{
			include ("views/home_user.php");
		}

	?>


<?php
	include_once('views/includes/footer.php');
?>