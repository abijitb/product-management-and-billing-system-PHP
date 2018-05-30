<?php 
//search_medicine_result.php
	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}

	$medicine_id=$_GET['medicine_id'];

	include('inc/db.php');

	$sql_med="SELECT * FROM medicines WHERE medicine_id='$medicine_id'";
	$rs_med=mysqli_query($con,$sql_med);
	$row_med=mysqli_fetch_array($rs_med);

	$generic=$row_med['generic_id'];
	$stock=$row_med['stock'];

	$sql_gen="SELECT * FROM generics WHERE generic_id='$generic'";
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
		<title>Floris | <?php echo $row_med['medicine_name']; ?></title>
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
						
						<table width="900" class="block-table-one">

						<?php 

							if($stock>0) {

						?>
							<tr>
								<td style="padding-bottom: 20px;" colspan="3"><h1><img src="img/out.png" width="50"> <?php echo $row_med['medicine_name']; ?></h1> <h4><x style="color:green;">In Stock</x> | ID : <?php echo $row_med['medicine_id']; ?></h4></td>
							</tr>
						<?php 

							}
							else {

						?>	
							<tr>
								<td style="padding-bottom: 20px;" colspan="3"><h1><img src="img/out.png" width="50"> <?php echo $row_med['medicine_name']; ?></h1> <h4><x style="color:red;">Out of Stock</x> | ID : <?php echo $row_med['medicine_id']; ?></h4></td>
							</tr>
						<?php 

							}

						?>
							<tr>
								<td class="med-font"><h2>Manufacturer</h2></td>
							
								<td class="med-font"><h2>Category</h2></td>

								<td class="med-font"><h2>Unit</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_med['manufacturer']; ?></p></td>
							
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_med['category']; ?></p></td>
							
								<td><p style="font-size: 20px; text-align: justify;">3<?php echo $row_med['unit']; ?></p></td>
							</tr>

							<tr>
								<td class="med-font"><h2>Type</h2></td>
							
								<td class="med-font"><h2>Quantity</h2></td>
								
								<td class="med-font"><h2>Price</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_med['type']; ?></p></td>
							
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_med['quantity']; ?></p></td>
							
								<td><p style="font-size: 20px; text-align: justify;">&#8377; <?php echo $row_med['price']; ?> + GST</p></td>
							</tr>

						</table>	
					</div>


					<div class="block-body">
						
						<table width="1100" class="block-table-one">
							
							<tr>
								<td class="med-font"><h2>Generic Name</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['generic_name']; ?></p></td>
							</tr>

							<tr>
								<td class="med-font"><h2>Prescribed for</h2></td>
							</tr>
							<tr>
								<td><p style="font-size: 20px; text-align: justify;"><?php echo $row_gen['prescribed_for']; ?></p></td>
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