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
		<title>Floris | Admin Log in</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>


        <!-- START LOGIN PROCESS -->
        <script type="text/javascript">
            $(document).ready(function() {
                $(function() {
                    $("#login_form").on("submit", function(event) {
                        event.preventDefault();
                        //$('input[type="submit"]').attr('disabled','disabled');
                        $("#img-result").fadeIn();
                        $("#login_result").html('');
                        $.ajax({
                            url: "admin_login_process.php",
                            type: "post",
                            data: $(this).serialize(),
                            success: function(result) {
                                if(result=="") {
                                    $("#login_result").html('');
                                    $("#img-result").show();
                                    window.location=('index.php');

                                }
                                else {
                                    $("#img-result").fadeOut(100);
                                    $("#login_result").delay(500).fadeIn(300,function() {
                                        $(this).html(result);
                                    });
                                    
                                }
                            }
                        });
                    });
                });

            });
        </script>
        <!-- END LOGIN PROCESS -->
        <style type="text/css">
        	#img-result,#result {
        		display: none;
        	}
        </style>
		
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
						<li><a href="admin_login.php" style="color: #ff9800;">Admin log in</a></li>
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
						<form method="post" id="login_form" name="login_form">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Admin Log in</h1></td>
								</tr>
								
								<tr>
									<td><input type="text" name="admin_username" id="admin_username" placeholder="Username"></td>
								</tr>
								<tr>
									<td><input type="password" name="admin_password" id="admin_password" placeholder="Password"></td>
								</tr>
								<tr>
									<td style="height: 23px;">
										<img src="img/loading1.gif" id="img-result" width="18" >
										<span id="login_result" ></span>
									</td>
								</tr>
								<tr>
									<td><input type="submit" value="Log in"></td>
								</tr>
								<tr>
									<td style="padding: 15px 0px 0px 0px;"><hr style="border: 1.5px solid rgb(51, 12, 119); background: rgb(51, 12, 119);"></td>
								</tr>
								<tr>
									<td style="padding: 8px 0px 0px 0px;" class="header-link">Forgot Password? <a href="admin_forgot.php">Click Here</a></td>
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
