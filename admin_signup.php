<?php 

	session_start();
	if(isset($_SESSION['admin_username'])==true || isset($_SESSION['agent_username'])==true) {
		header('Location:index.php');
	}

	if(isset($_POST['verify_code'])) {


		$verify_code=$_POST['verify_code'];
		$code="F2204S";

		if($verify_code!=$code) { 

?>

		<script type="text/javascript">
			alert('Wrong Verification Code!');
			location.href="admin_verify.php";
		</script>

<?php
		}
		else {
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | Admin Registration</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {


                $("#admin_signup_form").validate({
                    rules:
                    {
                        admin_name: {
                            required: true,
                            minlength: 3
                        },
                        admin_username: {
                            required: true,
                            minlength: 5
                        },
                        admin_password: {
                            required: true,
                            minlength: 8
                        },
                        re_admin_password: {
                            required: true,
                            equalTo: '#admin_password'
                        },
                        security_qstn: {
                            required: true
                        },
                        security_ans: {
                            required: true,
                            minlength: 1
                        },
                    },
                    messages:
                    {
                        admin_name: "<span><img src='img/info.png' width='13'> Name too short!</span>",
                        admin_password:{
                            required: "<span><img src='img/info.png' width='13'> Provide a Password!</span>",
                            minlength: "<span><img src='img/info.png' width='13'> Password Needs To Be Minimum of 8 Characters!</span>"
                        },
                        admin_username: {
                            required:"<span><img src='img/info.png' width='13'> Enter a Username!</span>",
                            minlength:"<span><img src='img/info.png' width='13'> Username Needs To Be Minimum of 5 Characters!</span>"
                        },
                        
                        re_admin_password:{
                            required: "<span><img src='img/info.png' width='13'> Retype Your Password!</span>",
                            equalTo: "<span><img src='img/info.png' width='13'> Password Mismatch! Retype</span>"
                        },
                        security_qstn: "<span><img src='img/info.png' width='13'> Select a Security Question!</span>",
                        security_ans: "<span><img src='img/info.png' width='13'> Answer the Security Question!</span>"
                    },
                    submitHandler: submitForm
                });

                function submitForm() {
                    //$("#signup_form").on("submit", function(event) {
                       // event.preventDefault();
                        //$('input[type="submit"]').attr('disabled','disabled');

                        $("#img-result").fadeIn();
                        $("#result").html("");
                        var data = $("#admin_signup_form").serialize();
                        $.ajax({
                            url: "admin_signup_process.php",
                            type: "post",
                            data: data,
                            success: function(result) {
                                $("#img-result").fadeOut(100);
                                $("#result").delay(400).fadeIn(300, function() {
                                    $(this).html(result);
                                });
                            }

                        });
                    //});
                    return false;
                }
            });
        </script>
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
						<li><a href="admin_login.php">Admin log in</a></li>
						<li><a href="admin_verify.php" style="color: #ff9800;">Register new Admin</a></li>
						<li><a href="agent_login.php">Agent log in</a></li>
					</ul>
				</div>
			</div>
			<!-- END SIDEBAR -->
			<!-- START CONTAINER -->
			<div class="container">
				<!-- START BODY -->
				<div class="body">
					<div class="log-body" style="margin-top: 50px;">
						<form method="post" name="admin_signup_form" id="admin_signup_form">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Admin Sign up</h1></td>
								</tr>
								<tr>
									<td><input type="text" name="admin_name" id="admin_name" placeholder="Full Name"></td>
								</tr>
								<tr>
									<td><input type="text" name="admin_username" id="admin_username" placeholder="Username"></td>
								</tr>
								<tr>
									<td><input type="password" name="admin_password" id="admin_password" placeholder="Password"></td>
								</tr>
								<tr>
									<td><input type="password" name="re_admin_password" id="re_admin_password" placeholder="Re-enter Password"></td>
								</tr>
								<tr>
                                    <td>
                                    	<select name="security_qstn" id="security_qstn" >
                                    		<option value="">-- Select Security Question --</option>
                                    		<option value="What is your favourite colour?">What is your favourite colour?</option>
                                    		<option value="What is your favorite football team?">What is your favorite football team?</option>
                                    		<option value="What is your bestfriend's name?">What is your bestfriend's name?</option>
                                    		<option value="What is your nick name?">What is your nick name?</option>
                                    		<option value="What is your favourite sports?">What is your favourite sports?</option>
                                    		<option value="What is your year of birth?">What is your year of birth?</option>
                                    	</select>
                                    </td>
                                </tr>
                                <tr>
                                	<td><input type="text" name="security_ans" id="security_ans" placeholder="Security Question's Answer"></td>
                                </tr>
                                <tr>
                                	<td><span style="color: green; font-size: 11px; text-align: justify;">Note : You have to remember your security question and their corresponding answer. Otherwise your account won't be possible to recover.</span></td>
                                </tr>
								<tr>
									<td style="height: 23px;">
										<img src="img/loading1.gif" id="img-result" width="18" >
										<span id="result"></span>
									</td>
								</tr>
								<tr>
									<td><input type="submit" value="Sign up"></td>
								</tr>
								<tr>
									<td style="padding: 15px 0px 0px 0px;"><hr style="border: 1.5px solid rgb(51, 12, 119); background: rgb(51, 12, 119);"></td>
								</tr>
								<tr>
									<td style="padding: 8px 0px 0px 0px;" class="header-link">To log in as Administrator! <a href="admin_login.php">Click Here</a></td>
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

<?php 

		}

	}
	else {

?>
	<script type="text/javascript">
		alert('Invalid Access!');
		location.href="admin_verify.php";
	</script>

<?php

	}

?>
