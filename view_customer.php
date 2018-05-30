<?php 

//invoice_form.php

	session_start();

	if(!isset($_SESSION['admin_username'])) {
		echo "<script>window.close();</script>";
	}


	include('inc/db.php');


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
		<title>Floris | View All Customers</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style_typehead.css">
	
		<style type="text/css">
			h1 {
				/*color: rgb(51, 12, 119);*/
			}
			td {
				text-align: center;
				color: rgb(51, 12, 119);
				padding: 5px;
				font-size: 18px;
			}
			a:hover {
				text-decoration: underline;
			}
		</style>
	</head>
	<body>
	<center>
		<div class="wrapper">
			
			<!-- START CONTAINER -->
			<div class="container">
				<!-- START BODY -->
				<div class="body">
					

					<div class="block-body" style="padding: 20px 0px 20px 0px; margin-top: 0px;">
						<h1 style="font-size: 50px; color: #09b5a5;">All Customers</h1>
					</div>

			<?php 

				if($count_cus>0) {

			?>
					<div class="block-body" style="padding: 10px 0px 10px 0px; margin-top: 15px;">
						<table width="1200" cellspacing="20">
							<tr>
								<td style="border-bottom: 1px solid rgb(51, 12, 119); font-weight: bold; width: 10%;">Id</td>
								<td style="border-bottom: 1px solid rgb(51, 12, 119); font-weight: bold; width: 35%;">Phone Number</td>
								<td style="border-bottom: 1px solid rgb(51, 12, 119); font-weight: bold; width: 30%;">Total Purchased Worth</td>
								<td style="border-bottom: 1px solid rgb(51, 12, 119); font-weight: bold;">Registration Date &amp; Time</td>
							</tr>
						</table>
					</div>
			<?php 
					while($row_cus=mysqli_fetch_array($rs_cus)) {

			?>
					<div class="block-body" style="padding: 0px 0px 0px 0px; margin-top: 5px;">
						<table width="1200" cellspacing="20">
							<tr>
								<td  align="center" style="width: 10%;"><?php echo $row_cus['customer_id']; ?></td>
								<td  align="center" style="width: 35%;"><?php echo $row_cus['phone_no']; ?> ( <a href="update_phone_no.php?phone_no=<?php echo $row_cus['phone_no']; ?>">Edit</a> )</td>
								<td  align="center" style="width: 30%;">
									<?php 

										$sql_p="SELECT * FROM invoice WHERE phone_no='".$row_cus['phone_no']."'";
										$rs_p=mysqli_query($con,$sql_p);
										$count_p=mysqli_num_rows($rs_p);

										$total=0;
										while($row_p=mysqli_fetch_array($rs_p)) {
											$total=$total+$row_p['total'];

											$t=number_format((float)$total, 2, '.', '');
										}

										if($count_p>0) {
											echo "&#8377; ".$t;
										}
										else {
											echo "&#8377; 0";
										}

									?>
								</td>
								<td align="center"><?php echo $row_cus['registration_date']; ?> <?php echo $row_cus['registration_time']; ?></td>
							</tr>
						</table>
					</div>
			<?php

					}

				}
				else {

			?>
					<div class="block-body" style="padding: 10px 0px 10px 0px; margin-top: 15px;">
						<table width="1200" cellspacing="20">
							<tr>
								<td align="center" style="padding: 0px 0px 10px 0px;"><p>No Customers!</p></td>
							</tr>
						</table>
					</div>

			<?php 

				}

			?>


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