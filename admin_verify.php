<?php 
	session_start();
	if(isset($_SESSION['admin_username'])==true || isset($_SESSION['agent_username'])==true) {
		header('Location:index.php');
	}


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | Admin verify</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		
	</head>
	<body>
	<center>
		<div class="wrapper">
			<!-- START SIDEBAR -->
			<div class="sidebar">
				<div class="logo"><a href="index.php"><img src="img/logo.png" width="150"></a></div>
				<div class="menu">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="admin_login.php">Admin log in</a></li>
						<li><a href="admin_verify.php">Register new Admin</a></li>
						<li><a href="agent_login.php">Agent log in</a></li>
					</ul>
				</div>
			</div>
			<!-- END SIDEBAR -->
			<!-- START CONTAINER -->
			<div class="container">
				<!-- START BODY -->
				<div class="body">
					<div class="log-body" style="margin-top: 100px;">
						<form action="admin_signup.php" method="post">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Verify Admin</h1></td>
								</tr>
								
								<tr>
									<td><input type="password" name="verify_code" id="verify_code" placeholder="Verification Code"></td>
								</tr>
								
								<tr>
									<td><input type="submit" value="Verify" name="submit"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
				<!-- END BODY -->
			</div>
			<!-- END CONTAINER -->
		</div>
	</center>
	</body>
</html>