<?php 

	session_start();

	if(!isset($_SESSION['admin_username'])) {
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
		<title>Floris | Search customer</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style_typehead.css">
		
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<script src="js/typeahead.min.js"></script>

       
        <script type="text/javascript">
            $(document).ready(function(){
                $('input.phone_no').typeahead({
                    name: 'phone_no',
                    remote:'phone_no_suggestion.php?key=%QUERY',
                    limit : 6
                });
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
			
			<!-- START CONTAINER -->
			<div class="container">
				<!-- START BODY -->
				<div class="body">
					<div class="log-body" style="margin-top: 100px;">
						<form action="" method="POST">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Search Customer</h1></td>
								</tr>
								<tr>
									<td class="bs-example">
										<input type="number" name="phone_no" id="phone_no" placeholder="Phone Number" class="typeahead tt-query phone_no" autocomplete="off" spellcheck="false">
									</td>
								</tr>
								<tr>
									<td style="height: 23px;">
										<span>
											<?php 

												if(isset($_REQUEST['submit'])==true) {
													if(!empty($_REQUEST['phone_no'])==true) {
														$phone_no=$_REQUEST['phone_no'];
														$sql="SELECT * FROM customer WHERE phone_no='$phone_no'";
														$rs=mysqli_query($con,$sql);
														$count=mysqli_num_rows($rs);
														$row=mysqli_fetch_array($rs);

														if($count>=1) {
											?>
															<script type="text/javascript">
																location.href="update_phone_no.php?phone_no=<?php echo $row['phone_no'] ?>";
															</script>
											<?php 

														}
														else {
															echo "<img src='img/info.png' width='13'> No Phone Number Found!";
														}
													}
													else {
														echo "<img src='img/info.png' width='13'> Please fill above text box!";
													}
												}

											?>
										</span>
									</td>
								</tr>
								<tr>
									<td><input type="submit" value="Search" name="submit" id="submit"></td>
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