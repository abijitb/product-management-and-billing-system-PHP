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
		<title>Floris | Delete Invoice</title>
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
                $('input.invoice_no').typeahead({
                    name: 'invoice_no',
                    remote:'invoice_suggestion.php?key=%QUERY',
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
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Delete invoice</h1></td>
								</tr>
								<tr>
									<td class="bs-example">
										<input type="text" name="invoice_no" id="invoice_no" placeholder="Invoice No." class="typeahead tt-query invoice_no" autocomplete="off" spellcheck="false">
									</td>
								</tr>
								<tr>
									<td style="height: 23px;">
										<span>
											<?php 

												if(isset($_REQUEST['submit'])==true) {
													if(!empty($_REQUEST['invoice_no'])==true) {
														$invoice_no=$_REQUEST['invoice_no'];
														$sql="SELECT * FROM invoice WHERE invoice_no='$invoice_no'";
														$rs=mysqli_query($con,$sql);
														$count=mysqli_num_rows($rs);

														if($count>=1) {
															$sql_d="DELETE FROM invoice WHERE invoice_no='$invoice_no'";
															mysqli_query($con,$sql_d); 
											?>
															<script type="text/javascript">
																alert('invoice Deleted!');
																location.href="delete_invoice.php";
															</script>
											<?php
														}
														else {
															echo "<img src='img/info.png' width='13'> No invoice Found!";
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
									<td><input type="submit" value="Delete" name="submit" id="submit"></td>
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