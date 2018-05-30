<?php 

	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}

	include('inc/db.php');

	if(!isset($_GET['generic_id'])==true) {
		header('Location:update_gedicine.php');
	}
	else {
		$generic_id=$_GET['generic_id'];
	}


	$sql_g="SELECT * FROM generics WHERE generic_id='$generic_id'";
	$rs_g=mysqli_query($con,$sql_g);
	$row_g=mysqli_fetch_array($rs_g);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | Update Generic</title>
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
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Update generic</h1></td>
								</tr>

								<tr>
									<td>
										<p>generic Name</p>
										<input type="text" name="generic_name" readonly="readonly" required="required" value="<?php echo $row_g['generic_name']; ?>">
									</td>
								</tr>
								<tr>

									<td>
										<p>International Classification of Diseases No.</p>
										<input type="text" name="icd_code" id="icd_code" placeholder="International Classification of Diseases No." value="<?php echo $row_g['icd_code']; ?>">
									</td>
								</tr>
								<tr>
                                    <td>
                                    	<p>Prescribed For</p>
                                        <textarea cols="20" rows="4" placeholder="Prescribed For" name="prescribed_for" id="prescribed_for"><?php echo $row_g['prescribed_for']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	<p>When It's not to be taken</p>
                                        <textarea cols="20" rows="4" placeholder="When It's not to be taken" name="its_not_to_be_taken" id="its_not_to_be_taken"><?php echo $row_g['its_not_to_be_taken']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	<p>Dosage</p>
                                        <textarea cols="20" rows="4" placeholder="Dosage" name="dosage" id="dosage"><?php echo $row_g['dosage']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	<p>How it should be taken</p>
                                        <textarea cols="20" rows="4" placeholder="How it should be taken" name="how_it_should_be_taken" id="how_it_should_be_taken"><?php echo $row_g['how_it_should_be_taken']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	<p>Precaution(s)</p>
                                        <textarea cols="20" rows="4" placeholder="Precaution(s)" name="precautions" id="precautions"><?php echo $row_g['precautions']; ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                    	<p>Storage Condition(s)</p>
                                        <textarea cols="20" rows="4" placeholder="Storage Condition(s)" name="storage_conditions" id="storage_conditions"><?php echo $row_g['storage_conditions']; ?></textarea>
                                    </td>
                                </tr>
								
								<tr>
									<td style="height: 23px;">
										<span>
											<?php 

												if(isset($_REQUEST['submit'])==true) {

													$generic_name=$_REQUEST['generic_name'];
													$icd_code=$_REQUEST['icd_code'];
													$prescribed_for=$_REQUEST['prescribed_for'];
													$its_not_to_be_taken=$_REQUEST['its_not_to_be_taken'];
													$dosage=$_REQUEST['dosage'];
													$how_it_should_be_taken=$_REQUEST['how_it_should_be_taken'];
													$precautions=$_REQUEST['precautions'];
													$storage_conditions=$_REQUEST['storage_conditions'];

													if(!empty($generic_name)==true && !empty($icd_code)==true && !empty($prescribed_for)==true && !empty($its_not_to_be_taken)==true && !empty($dosage)==true && !empty($how_it_should_be_taken)==true && !empty($precautions)==true && !empty($storage_conditions)==true) {
														$sql="UPDATE generics SET generic_name='$generic_name',
																					icd_code='$icd_code',
																					prescribed_for='$prescribed_for',
																					its_not_to_be_taken='$its_not_to_be_taken',
																					dosage='$dosage',
																					how_it_should_be_taken='$how_it_should_be_taken',
																					precautions='$precautions',
																					storage_conditions='$storage_conditions' WHERE generic_id='$generic_id'";
														mysqli_query($con,$sql); 
												?>
														<script type="text/javascript">
															alert('Generic Updated Successfully!');
															location.href="update_generic.php";
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