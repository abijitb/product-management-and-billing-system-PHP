<?php 

	session_start();
	if(!isset($_SESSION['admin_username'])==true) {
		echo "<script>window.close();</script>";
	}

	include('inc/db.php');
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | Add Agent</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		
		
	</head>
	<body>
	<center>
		<div class="wrapper">
			
			<!-- START CONTAINER -->
			<div class="container">
				<!-- START BODY -->
				<div class="body">
					<div class="log-body" style="margin-top: 50px;">
						<form method="post" name="admin_signup_form" id="admin_signup_form">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Add Agent</h1></td>
								</tr>
								<tr>
									<td><input type="text" name="name" id="name" placeholder="Agent Name"></td>
								</tr>
								<tr>
									<td><input type="text" name="username" id="username" placeholder="Agent Username"></td>
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
                                    	<span>
                                    		<?php 
                                    			
                                    			if(isset($_REQUEST['submit'])==true) {
                                    				if(!empty($_REQUEST['name'])==true && !empty($_REQUEST['username'])==true && !empty($_REQUEST['security_qstn'])==true && !empty($_REQUEST['security_ans'])==true && ord($_REQUEST['name'])!=32 && ord($_REQUEST['username'])!=32 && ord($_REQUEST['security_qstn'])!=32 && ord($_REQUEST['security_ans'])!=32) {

                                    					$name=$_REQUEST['name'];
                                    					$username=$_REQUEST['username'];
                                    					$password=md5("agent123",true);
                                    					$type="2";
														$joining_date=date('Y-m-d');
														
														date_default_timezone_set("Asia/Kolkata"); 
														$joining_time=date("h:i:sa");

														$security_qstn=md5($_REQUEST['security_qstn']);

														
														$security_ans=md5($_REQUEST['security_ans']);


														$sql="SELECT * FROM user WHERE username='$username'";
														$rs=mysqli_query($con,$sql);
														$count=mysqli_num_rows($rs);

														if($count<=0) {
															if(preg_match("/[^A-Za-z0-9\_]/", $username)) {
																echo "<img src='img/info.png' width='13'> No special characters allowed except '_'!";
															}
															else if(strlen($username)<5) {
																echo "<img src='img/info.png' width='13'> Username Needs To Be Minimum of 5 Characters!";
															}
															else {
																$sql_ins="INSERT INTO user (name,
																	username,
																	password,
																	security_qstn,
																	security_ans,
																	type,
																	joining_date,
																	joining_time) VALUES ('$name',
																	'$username',
																	'$password',
																	'$security_qstn',
																	'$security_ans',
																	'$type',
																	'$joining_date',
																	'$joining_time')";
																$rs_ins=mysqli_query($con,$sql_ins);
																echo "<span style='color:green;'><img src='img/right.png' width='13'> Agent Addition Successfull!</span>";
															}
														}
														else {
															echo "<img src='img/info.png' width='13'> An Account already exist with this username";
														}
                                    				}
                                    				else {
                                    					echo "<img src='img/info.png' width='13'> Please fill out above text boxes!";
                                    				}
                                    			}		

                                    		?>
                                    	</span>
                                    </td>
                                </tr>
								<tr>
									<td><input type="submit" value="Add" name="submit"></td>
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
