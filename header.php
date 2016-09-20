<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="header.css" type="text/css">
 	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> 
 	<script src='reg.js'></script> 
</head>
<body>
<div class="container-fluid"" >
	<div class="row">
		<header class="navbar navbar-static-top bs-docs-nav" id="top">
			<div class="col-xs-6 col-md-4">
			</div>
			<div class="col-xs-6 col-md-4">
				<a href="index.php"><h3><font>Comments</font></h3></a>
			</div>
			<div class="col-xs-6 col-md-4">
				<div>
					<?php if(isset($_SESSION["session_username"])){?>
					<h4>Hello, <span><?php echo $_SESSION['session_username'];?>!</span></h4>
				</div>
				<a href="logout.php"><h4><font>Logout</font></h4></a>
			</div>
			<?php } ?>
		</header>
	</div>
</div>

