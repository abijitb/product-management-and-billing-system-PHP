<?php 

//invoice_form.php

	session_start();

	if(!isset($_SESSION['admin_username'])) {
		echo "<script>window.close();</script>";
	}


	include('inc/db.php');


	$sql_agnt="SELECT * FROM user WHERE type='2'";
	$rs_agnt=mysqli_query($con,$sql_agnt);
	$count_agnt=mysqli_num_rows($rs_agnt);


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | View All Agents</title>
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
			
			.tool {
				color: #fff;
				background: rgb(51, 12, 119);
				padding: 5px;
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
						<h1 style="font-size: 50px; color: #09b5a5;">All Agents</h1>
					</div>

			<?php 

				if($count_agnt>0) {

			?>
					<div class="block-body" style="padding: 10px 0px 10px 0px; margin-top: 15px;">
						<table width="1200" cellspacing="20">
							<tr>
								<td style="border-bottom: 1px solid rgb(51, 12, 119); font-weight: bold; width: 30%;">Name</td>
								<td style="border-bottom: 1px solid rgb(51, 12, 119); font-weight: bold; width: 20%;">Username</td>
								<td style="border-bottom: 1px solid rgb(51, 12, 119); font-weight: bold; width: 30%;">Joining Date &amp; Time</td>
								<td style="border-bottom: 1px solid rgb(51, 12, 119); font-weight: bold;">Tools</td>
							</tr>
						</table>
					</div>
			<?php 
					while($row_agnt=mysqli_fetch_array($rs_agnt)) {

			?>
					<div class="block-body" style="padding: 0px 0px 0px 0px; margin-top: 5px;">
						<table width="1200" cellspacing="20">
							<tr>
								<td align="center" style="width: 30%;"><?php echo $row_agnt['name']; ?></td>
								<td align="center" style="width: 20%;">@<?php echo $row_agnt['username']; ?></td>
								<td align="center" style="width: 30%;"><?php echo $row_agnt['joining_date']; ?> <?php echo $row_agnt['joining_time']; ?></td>
								<td align="center">
									<a href="promote_agent.php?username=<?php echo $row_agnt['username']; ?>" class="tool">Promote</a>
									<a href="del_agent.php?username=<?php echo $row_agnt['username']; ?>" class="tool">Delete</a>
								</td>
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
								<td align="center" style="padding: 0px 0px 10px 0px;"><p>No Agents!</p></td>
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