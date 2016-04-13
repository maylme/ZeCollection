<?php
	/*** begin our session ***/
	session_start();
	header('Content-Type: text/html; charset=utf-8');
	/*** Verify loogin ***/
	$is_logged = false;

	if(!isset($_SESSION['user_id'])){
	    $is_logged = false;
	}
	else{
	    try{
	        /*** mysql hostname ***/
	        $mysql_hostname = 'localhost';
	        /*** mysql username ***/
	        $mysql_username = 'collector';
	        /*** mysql password ***/
	        $mysql_password = 'collector3414006600';
	        /*** database name ***/
	        $mysql_dbname = 'zecollection';

	        /*** select the users name from the database ***/
	        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

	        /*** set the error mode to excptions ***/
	        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	        /*** prepare the insert ***/
	        $stmt = $dbh->prepare("SELECT username FROM users WHERE user_id = :user_id");

	        /*** bind the parameters ***/
	        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

	        /*** execute the prepared statement ***/
	        $stmt->execute();

	        /*** check for a result ***/
	        $username = $stmt->fetchColumn();

	        /*** if we have no something is wrong ***/
	        if($username == false){
	            $is_logged = false;
	        } else{
	            $is_logged = true;
	            $user = new stdClass();
	            $user->username = $username;
	            $user->actions = array();
	            $_SESSION['user'] = $user;
	        }
	    }catch (Exception $e){
	        /*** if we are here, something is wrong in the database ***/
	        $is_logged = false;
	    }
	}
?>

<html>
	<head>
		<title>Ze collection</title>
		<link href = "/bootstrap/css/bootstrap.css" rel="stylesheet" >
		<link href = "/style.css" rel="stylesheet" >

	</head>
	<body>
	<div class="background">
	<div class="alpha">
	<nav class="navbar navbar-default">
	  	<div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="/">Ze Collection</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		    	<?php if (!$is_logged){ ?>
		    	<ul id="menu_loggin" class="nav navbar-nav navbar-right">
			        <li>
			        	<a href="/views/add_user.php" data-toggle="tooltip" title="Register">
			        		<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			        	</a>
			        </li>
			        <li>
			        	<a href="/views/login.php" data-toggle="tooltip" title="Login">
			        		<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
			        	</a>
			        </li>
			    </ul>
		    	<?php } ?>
		    	

		    	<?php if ($is_logged){ 
					include('user_menu.php');
		    	}?>


			</div>
		</div>
	</nav>