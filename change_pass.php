<?php 
	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		header('Location:index.php');
	}

	include('inc/db.php');


	$sql_gen="SELECT * FROM generics";
	$rs_gen=mysqli_query($con,$sql_gen);
	$count_gen=mysqli_num_rows($rs_gen);


	$sql_med="SELECT * FROM medicines";
	$rs_med=mysqli_query($con,$sql_med);
	$count_med=mysqli_num_rows($rs_med);

	$sql_med_stock="SELECT * FROM medicines WHERE stock<='0'";
	$rs_med_stock=mysqli_query($con,$sql_med_stock);
	$count_stock=mysqli_num_rows($rs_med_stock);


	$sql_cus="SELECT * FROM customer";
	$rs_cus=mysqli_query($con,$sql_cus);
	$count_cus=mysqli_num_rows($rs_cus);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | Change Password</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {


                $("#change_pass_form").validate({
                    rules:
                    {
                        username: {
                            required: true,
                            minlength: 5
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        new_password: {
                            required: true,
                            minlength: 8
                        },
                        re_new_password: {
                            required: true,
                            equalTo: '#new_password'
                        },
                    },
                    messages:
                    {
                        new_password:{
                            required: "<span><img src='img/info.png' width='13'> Provide a Password!</span>",
                            minlength: "<span><img src='img/info.png' width='13'> Password Needs To Be Minimum of 8 Characters!</span>"
                        },
                        username: {
                            required:"<span><img src='img/info.png' width='13'> Enter a Username!</span>",
                            minlength:"<span><img src='img/info.png' width='13'> Username Needs To Be Minimum of 5 Characters!</span>"
                        },
                        password:{
                            required: "<span><img src='img/info.png' width='13'> Provide Your Old Password!</span>",
                            minlength: "<span><img src='img/info.png' width='13'> Password Needs To Be Minimum of 8 Characters!</span>"
                        },
                        re_new_password:{
                            required: "<span><img src='img/info.png' width='13'> Retype Your Password!</span>",
                            equalTo: "<span><img src='img/info.png' width='13'> Password Mismatch! Retype</span>"
                        }
                    },
                    submitHandler: submitForm
                });

                function submitForm() {
                    //$("#signup_form").on("submit", function(event) {
                       // event.preventDefault();
                        //$('input[type="submit"]').attr('disabled','disabled');

                        $("#img-result").fadeIn();
                        $("#result").html("");
                        var data = $("#change_pass_form").serialize();
                        $.ajax({
                            url: "change_pass_process.php",
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
	<body >
	<center>
		<div class="wrapper">
			<!-- START SIDEBAR -->
			<div class="sidebar">
				<div class="logo"><a href="index.php"><img src="img/logo.png" width="150"></a></div>
				<div class="menu">
			<?php 
				// FOR ADMIN 
				if(isset($_SESSION['admin_username'])==true) {

			?>
					<scroll-container>
						<scroll-page><a href="index.php">Home </a></scroll-page>
						<scroll-page><h2 style="padding: 0px 0px 0px 10px; color: #fff;"><img src="img/invoice.png" width="20"> Invoice</h2></scroll-page>
						<scroll-page><a href="ph_form.php" target="_blank">Quick Invoice</a></scroll-page>
						<scroll-page><a href="search_invoice.php" target="_blank">Search Invoice</a></scroll-page>
						<scroll-page><a href="delete_invoice.php" target="_blank">Delete Invoice</a></scroll-page>
						<scroll-page><h2 style="padding: 0px 0px 0px 10px; color: #fff;"><img src="img/medicine.png" width="20"> Medicines</h2></scroll-page>
						<scroll-page><a href="add_medicine.php" target="_blank">Add Medicine </a></scroll-page>
						<scroll-page><a href="update_medicine.php" target="_blank">Update Medicine</a></scroll-page>
						<scroll-page><a href="remove_medicine.php" target="_blank">Remove Medicine</a></scroll-page>
						<scroll-page><a href="search_medicine.php" target="_blank">Search Medicine </a></scroll-page>
						<scroll-page><h2 style="padding: 0px 0px 0px 10px; color: #fff;"><img src="img/generic.png" width="20"> Generics</h2></scroll-page>
						<scroll-page><a href="add_generic.php" target="_blank">Add Generic </a></scroll-page>
						<scroll-page><a href="update_generic.php" target="_blank">Update Generic</a></scroll-page>
						<scroll-page><a href="remove_generic.php" target="_blank">Remove Generic</a></scroll-page>
						<scroll-page><a href="search_generic.php" target="_blank">Search a Generic</a></scroll-page>
						<scroll-page><a href="search_icd.php" target="_blank">Find Generic By ICD</a></scroll-page>
						<scroll-page><h2 style="padding: 0px 0px 0px 10px; color: #fff;"><img src="img/customer.png" width="20"> Customers</h2></scroll-page>
						<scroll-page><a href="view_customer.php" target="_blank">View all Customers</a></scroll-page>
						<scroll-page><a href="search_customer.php" target="_blank">Change Phone No.</a></scroll-page>
					</scroll-container>
			<?php 

				} // FOR AGENT
				elseif(isset($_SESSION['agent_username'])==true) {

			?>
					<scroll-container>
						<scroll-page><a href="index.php">Home </a></scroll-page>
						<scroll-page><h2 style="padding: 0px 0px 0px 10px; color: #fff;"><img src="img/invoice.png" width="20"> Invoice</h2></scroll-page>
						<scroll-page><a href="ph_form.php" target="_blank">Quick Invoice</a></scroll-page>
						<scroll-page><a href="search_invoice.php" target="_blank">Search Invoice</a></scroll-page>
						<scroll-page><h2 style="padding: 0px 0px 0px 10px; color: #fff;"><img src="img/medicine.png" width="20"> Medicines</h2></scroll-page>
						<scroll-page><a href="search_medicine.php" target="_blank">Search Medicine </a></scroll-page>
						<scroll-page><h2 style="padding: 0px 0px 0px 10px; color: #fff;"><img src="img/generic.png" width="20"> Generics</h2></scroll-page>
						<scroll-page><a href="search_generic.php" target="_blank">Search a Generic</a></scroll-page>
						<scroll-page><a href="search_icd.php" target="_blank">Find Generic By ICD</a></scroll-page>
					</scroll-container>
			<?php 

				} //FOR ELSE PART
				else {

			?>
					<ul>
						<li><a href="index.php" style="color: #ff9800;">Home</a></li>
						<li><a href="admin_login.php">Admin log in</a></li>
						<li><a href="admin_verify.php">Register new Admin</a></li>
						<li><a href="agent_login.php">Agent log in</a></li>
					</ul>
			<?php 

				}

			?>
					
				</div>
			</div>
			<!-- END SIDEBAR -->



			<!-- START CONTAINER -->
			<div class="container">



				<!-- START HEADER -->
				<div class="header">
			<?php 
				// FOR ADMIN 
				if(isset($_SESSION['admin_username'])==true) {
					$admin_username=$_SESSION['admin_username'];
					$sql_usr="SELECT * FROM user WHERE username='$admin_username'";
					$rs_usr=mysqli_query($con,$sql_usr);
					$row_usr=mysqli_fetch_array($rs_usr);

			?>
					<div class="name">
						<p style="text-align: left;"><?php echo $row_usr['name']; ?></p>
						<span>@<?php echo $admin_username; ?></span><br>
						<span class="header-link"><a href="index.php">Back to Home</a>  |  <a href="logout.php" >Logout</a></span>
					</div>
			<?php 

				} // FOR AGENT
				elseif(isset($_SESSION['agent_username'])==true) {
					$agent_username=$_SESSION['agent_username'];
					$sql_usr="SELECT * FROM user WHERE username='$agent_username'";
					$rs_usr=mysqli_query($con,$sql_usr);
					$row_usr=mysqli_fetch_array($rs_usr);
			?>
					<div class="name">
						<p style="text-align: left;"><?php echo $row_usr['name']; ?></p>
						<span>@<?php echo $agent_username; ?></span><br>
						<span class="header-link"><a href="index.php">Back to Home</a>  |  <a href="logout.php" >Logout</a></span>
					</div>
			<?php 

				} //FOR ELSE PART
				else {

			?>
					<div class="name">
						<p style="text-align: left;">Welcome!</p>
						<span>@floris</span>
					</div>
			<?php 

				}

			?>
					<div class="contact">
						<p>Ph: +91-9876543210</p>
						<p>Toll Free: 1800 1800 1800</p>
						<p>Email: <a href="mailto:info@floris.com">info@floris.com</a></p>
					</div>
				</div>
				<!-- END HEADER -->



				<!-- START BODY -->
				<div class="body">

					<div class="log-body" style="margin-top: 50px;">
						<form method="post" name="change_pass_form" id="change_pass_form">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Change Pass</h1></td>
								</tr>
						<?php 

							if(isset($_SESSION['admin_username'])==true) {

						?>
								<tr>
									<td><input type="text" name="username" id="username" placeholder="Username" value="<?php echo $_SESSION['admin_username']; ?>" readonly="readonly"></td>
								</tr>
						<?php 

							}
							else {
						?>
								<tr>
									<td><input type="text" name="username" id="username" placeholder="Username" value="<?php echo $_SESSION['agent_username']; ?>" readonly="readonly"></td>
								</tr>
						<?php 

							}

						?>
						<?php 

							if(isset($_SESSION['temp_pass'])==true) {

						?>
								<tr>
									<td><input type="hidden" name="password" id="password" placeholder="Old Password" value="<?php echo $_SESSION['temp_pass']; ?>"></td>
								</tr>
						<?php 

							}
							else {

						?>
								<tr>
									<td><input type="password" name="password" id="password" placeholder="Old Password"></td>
								</tr>
						<?php 

							}

						?>
								<tr>
									<td><input type="password" name="new_password" id="new_password" placeholder="New Password"></td>
								</tr>
								<tr>
									<td><input type="password" name="re_new_password" id="re_new_password" placeholder="Re-type New Password"></td>
								</tr>
								<tr>
                                    <td></td>
                                </tr>
								<tr>
									<td style="height: 23px;">
										<img src="img/loading1.gif" id="img-result" width="18" >
										<span id="result"></span>
									</td>
								</tr>
								<tr>
									<td><input type="submit" value="Change"></td>
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

	mysqli_close($con);

?>