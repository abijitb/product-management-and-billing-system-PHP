<?php 

	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}

	include('inc/db.php');

	if(!isset($_GET['medicine_id'])==true) {
		header('Location:update_medicine.php');
	}
	else {
		$medicine_id=$_GET['medicine_id'];
	}


	$sql_m="SELECT * FROM medicines WHERE medicine_id='$medicine_id'";
	$rs_m=mysqli_query($con,$sql_m);
	$row_m=mysqli_fetch_array($rs_m);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | Update Medicine</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		
		
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		
		<style type="text/css">
        	#img-result,#result {
        		display: none;
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
					<div class="log-body" style="margin-top: 100px;">
						<form action="" method="POST">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Update Medicine</h1></td>
								</tr>

								<tr>
									<td>
										<p>Medicine Name</p>
										<input type="text" name="medicine_name" readonly="readonly" required="required" value="<?php echo $row_m['medicine_name']; ?>">
									</td>
								</tr>
								<tr>
									<td>
										<p>Quantity</p>
										<input type="text" name="quantity" required="required" value="<?php echo $row_m['quantity']; ?>">
									</td>
								</tr>
						<?php 

							if($row_m['stock']<=0) {

						?>
								<tr>
									<td>
										<p>Stock</p>
										<input type="number" name="stock" required="required" value="0">
									</td>
								</tr>
						<?php 

							}
							else {

						?>
								<tr>
									<td>
										<p>Stock</p>
										<input type="number" name="stock" required="required" value="<?php echo $row_m['stock']; ?>">
									</td>
								</tr>
						<?php 

							}

						?>
								<tr>
									<td>
										<p>CGST</p>
										<input type="number" name="cgst" required="required" value="<?php echo $row_m['cgst']; ?>">
									</td>
								</tr>
								<tr>
									<td>
										<p>SGST</p>
										<input type="number" name="sgst" required="required" value="<?php echo $row_m['sgst']; ?>">
									</td>
								</tr>
								<tr>
									<td>
										<p>Price</p>
										<input type="number" name="price" required="required" value="<?php echo $row_m['price']; ?>">
									</td>  
								</tr>
								
								<tr>
									<td style="height: 23px;">
										<span>
											<?php 

												if(isset($_REQUEST['submit'])==true) {
													$medicine_name=$_REQUEST['medicine_name'];
													$quantity=$_REQUEST['quantity'];
													$stock=$_REQUEST['stock'];
													$cgst=$_REQUEST['cgst'];
													$sgst=$_REQUEST['sgst'];
													$price=$_REQUEST['price'];
													if(!empty($medicine_name)==true && !empty($quantity)==true && !empty($stock)==true && !empty($cgst)==true && !empty($sgst)==true && !empty($price)==true) {
														$sql="UPDATE medicines SET medicine_name='$medicine_name',
																					quantity='$quantity',
																					stock='$stock',
																					cgst='$cgst',
																					sgst='$sgst',
																					price='$price' WHERE medicine_id='$medicine_id'";
														mysqli_query($con,$sql); 
												?>
														<script type="text/javascript">
															alert('Medicine Updated Successfully!');
															location.href="update_medicine.php";
														</script>
												<?php
													}
													else {
														echo "<img src='img/info.png' width='13'> Please fill above text boxes!";
													}
												}

											?>
										</span>
									</td>
								</tr>
								<tr>
									<td><input type="submit" value="Update" name="submit" id="submit"></td>
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