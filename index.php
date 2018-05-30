<?php 
	session_start();
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

	$sql_med_left="SELECT * FROM medicines WHERE stock BETWEEN '1'AND '5'";
	$rs_med_left=mysqli_query($con,$sql_med_left);
	$count_left=mysqli_num_rows($rs_med_left);


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
		<title>Floris</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		<script src="js/waypoints.min.js"></script> 
		<script src="js/counterup.min.js"></script>
		<script>
			jQuery(document).ready(function( $ ) {
				$('.num').counterUp({
					delay: 20,
					time: 1000
				});
			});
		</script>

		 <script type="text/javascript">
            $(document).ready(function() {

                $("#close-button").click(function() {
                    $("#password-modal").slideToggle("slow");
                });

            });
        </script>
        
        <style type="text/css">
        	.modal-text a:hover {
        		text-decoration: underline;
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
						<scroll-page><a href="index.php" class="active">Home </a></scroll-page>
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
						<scroll-page><a href="index.php" class="active">Home </a></scroll-page>
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
						<span class="header-link"><a href="change_pass.php">Change Password</a>  |  <a href="logout.php" >Logout</a></span>
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
						<span class="header-link"><a href="change_pass.php">Change Password</a>  |  <a href="logout.php" >Logout</a></span>
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

					<div class="block-body">
						<div class="block-content">
							<div class="block one">
								<p class="num" style="padding: 40px 0px 0px 50px;"><?php echo $count_gen; ?></p>
								<p>Generics</p>
							</div>
							<div class="block two">
								<p class="num" style="padding: 40px 0px 0px 50px;"><?php echo $count_med; ?></p>
								<p>Medicines</p>
							</div>
							<div class="block three" style="margin-right: 0px;">
								<p class="num" style="padding: 40px 0px 0px 50px;"><?php echo $count_cus; ?></p>
								<p>Customers</p>
							</div>
						</div>
					</div>

			<?php 

			if(isset($_SESSION['admin_username'])==true || isset($_SESSION['agent_username'])==true) {
				if($count_stock>=1) {

			?>
					<div class="block-body">
						
						<table width="700" class="block-table-one">
							<tr>
								<td style="padding-bottom: 20px;" colspan="4"><h1><img src="img/out.png" width="50"> Out of Stock Medicine(s)</h1></td>
							</tr>

							<tr>
								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119); width: 35%;"><p style=" font-weight: 800;">Medicine Name</p></td>

								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119);"><p style=" font-weight: 800;">Manufacturer</p></td>
								
								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119);"><p style=" font-weight: 800;">Unit</p></td>

								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119);"><p style=" font-weight: 800;">Price</p></td>
							</tr>
					<?php 

						while($row_med_stock=mysqli_fetch_array($rs_med_stock)) {

					?>
							<tr>
								<td style="padding: 3px; width: 35%;"><p style=" font-weight: 600;"><img src="img/med.png" width="20" style="vertical-align: bottom;"> &nbsp;<?php echo $row_med_stock['medicine_name']; ?></p></td>

								<td style="padding: 3px;"><p style=" font-weight: 600;"><?php echo $row_med_stock['manufacturer']; ?></p></td>
								
								<td style="padding: 3px;"><p style=" font-weight: 600;"><?php echo $row_med_stock['unit']; ?></p></td>

								<td style="padding: 3px;"><p style="font-weight: 600;">&#8377; <?php echo $row_med_stock['price']; ?></p></td>
							</tr>
					<?php

						} 

					?>
							
						</table>	
					</div>
			<?php 

				}
			}

			?>



			<?php 

			if(isset($_SESSION['admin_username'])==true || isset($_SESSION['agent_username'])==true) {
				if($count_left>=1) {

			?>
					<div class="block-body">
						
						<table width="700" class="block-table-one">
							<tr>
								<td style="padding-bottom: 20px;" colspan="4"><h1><img src="img/out.png" width="50"> Few Left Medicine(s)</h1></td>
							</tr>

							<tr>
								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119); width: 30%;"><p style=" font-weight: 800;">Medicine Name</p></td>

								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119); width: 28%;"><p style=" font-weight: 800;">Manufacturer</p></td>
								
								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119); width: 17%;"><p style=" font-weight: 800;">Unit</p></td>

								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119); width: 20%;"><p style=" font-weight: 800;">Price</p></td>
								<td style="padding: 3px; border-bottom: 2px solid rgb(51,12,119);"><p style=" font-weight: 800;">Total Left</p></td>
							</tr>
					<?php 

						while($row_med_left=mysqli_fetch_array($rs_med_left)) {

					?>
							<tr>
								<td style="padding: 3px; width: 30%;"><p style=" font-weight: 600;"><img src="img/med.png" width="20" style="vertical-align: bottom;"> &nbsp;<?php echo $row_med_left['medicine_name']; ?></p></td>

								<td style="padding: 3px;"><p style=" font-weight: 600; width: 28%;"><?php echo $row_med_left['manufacturer']; ?></p></td>
								
								<td style="padding: 3px;"><p style=" font-weight: 600; width: 17%;"><?php echo $row_med_left['unit']; ?></p></td>

								<td style="padding: 3px;"><p style="font-weight: 600; width: 20%;">&#8377; <?php echo $row_med_left['price']; ?></p></td>

								<td style="padding: 3px;"><p style="font-weight: 600;"><?php echo $row_med_left['stock']; ?></p></td>
							</tr>
					<?php

						} 

					?>
							
						</table>	
					</div>
			<?php 

				}
			}

			?>




			<?php 

				// FOR ADMIN 
				if(isset($_SESSION['admin_username'])==true) {

			?>
					<div class="block-body" style="padding: 20px 0px 50px 0px;">
						<div class="block-heading">
							<h1><img src="img/agent.png" width="35"> Manage Agents</h1>
						</div><br><br><br>
						<div class="block-content">

							<a href="add_agent.php" target="_blank" style="text-decoration: none;">
								<div class="block-two five">
									<p style="padding: 40px 0px 0px 30px;">Add</p>
									<p>Agent</p>
								</div>
							</a>

							<a href="del_agent.php" target="_blank" style="text-decoration: none;">
								<div class="block-two four">
									<p  style="padding: 40px 0px 0px 30px;">Delete</p>
									<p>Agent</p>
								</div>
							</a>

							<a href="promote_agent.php" target="_blank" style="text-decoration: none;">
								<div class="block-two six">
									<p  style="padding: 40px 0px 0px 30px;">Promote</p>
									<p>Agent</p>
								</div>
							</a>

							<a href="view_agent.php" target="_blank" style="text-decoration: none;">
								<div class="block-two two" style="margin-right: 0px;">
									<p  style="padding: 40px 0px 0px 30px;">View all</p>
									<p>Agent(s)</p>
								</div>
							</a>
								
						</div>
					</div>
			<?php 

				}
				else {

			?>
					<div class="block-body" style="padding: 20px 0px 50px 0px;">
						<h1 style="color: rgb(51,12,119); font-size: 60px;">Floris</h1>
						<h2 style="color: rgb(51,12,119); font-size: 30px;">Chemist And Drugist</h2>
						<p>Ph: +91-9876543210</p>
						<p>Email: <a href="mailto:info@floris.com">info@floris.com</a></p>
					</div>
			<?php 

				}

			?>

				</div>
				<!-- END BODY -->

				
			</div>
			<!-- END CONTAINER -->


	<?php 

		if(isset($_SESSION['agent_username'])==true) {

			$agent_username=$_SESSION['agent_username'];
			$def_pass="agent123";
			$def_pass_hash=md5($def_pass,true);

			if($def_pass_hash==$row_usr['password']) {

	?>
			<div class="password-modal" id="password-modal">
				<div class="close-button" id="close-button"><p>&#10005;</p></div>
				<div class="modal-text">
					<h1>For Security, Change Your Password as soon as possible!</h1>
					<br>
					<a href="change_pass.php">Click here to Change Password</a>
				</div>
			</div>
	<?php 
			}
			else {
				echo "";
			}

		}

	?>
		</div>
	</center>
	</body>
</html>

<?php 

	mysqli_close($con);

?>