<?php 

	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}

	$generic_id=$_GET['generic_id'];

	include('inc/db.php');

	$sql_gen="SELECT * FROM generics WHERE generic_id='$generic_id'";
	$rs_gen=mysqli_query($con,$sql_gen);
	$row_gen=mysqli_fetch_array($rs_gen);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | <?php echo $row_gen['generic_name']; ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

        </script>
	</head>
	<body>
	<center>
		<div class="wrapper">

				<!-- START BODY -->
				<div class="body">

					
					<div class="block-body">
						
						<table width="1000" class="block-table-one">

							<tr>
								<td style="padding-bottom: 20px;" ><h1><img src="img/out.png" width="50"> <?php echo $row_gen['generic_name']; ?></h1> <h4>ID : <?php echo $row_gen['generic_id']; ?></h4></td>
							</tr>

							<tr>
								<td class="med-font"><h2>ICD Code</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['icd_code']; ?></p></td>
							</tr>

							<tr>
								<td class="med-font"><h2>Medicine</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;">
										<?php 

											$generic_id=$row_gen['generic_id'];
											$sql_med="SELECT * FROM medicines WHERE generic_id='$generic_id'";
											$rs_med=mysqli_query($con,$sql_med);

											$count=mysqli_num_rows($rs_med);
											$row_med=mysqli_fetch_array($rs_med);

										?>
										<?php 

											if($count>0) {

										?>
											<a href="search_medicine_result.php?medicine_id=<?php echo $row_med['medicine_id'] ?>">
												<?php echo $row_med['medicine_name'] ?>(Click here to see!)
											</a>
										<?php 

											}
											else {
												echo "No Medicines Found";
											}

										?>
									</p>
								</td>
							</tr>

							<tr>
								<td class="med-font"><h2>Prescribed for</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['prescribed_for']; ?></p></td>
							</tr>

							<tr>
								<td class="med-font"><h2>When it's not to be taken</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['its_not_to_be_taken']; ?></p></td>
							</tr>

							<tr>
								<td class="med-font"><h2>Dosage</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['dosage']; ?></p></td>
							</tr>

							<tr>
								<td class="med-font"><h2>How it Should be Taken</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['how_it_should_be_taken']; ?></p></td>
							</tr>

							<tr>
								<td class="med-font"><h2>Precautions</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['precautions']; ?></p></td>
							</tr>

							<tr>
								<td class="med-font"><h2>Storage Condition(s)</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['storage_conditions']; ?></p></td>
							</tr>

						</table>	
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