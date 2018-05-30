<?php 

	session_start();
	if(!isset($_SESSION['admin_username'])==true) {
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
		<title>Floris | Promote Agent</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style_typehead.css">
		
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<script src="js/typeahead.min.js"></script>

       
        <script type="text/javascript">
            $(document).ready(function(){
                $('input.username').typeahead({
                    name: 'username',
                    remote:'agent_suggestion.php?key=%QUERY',
                    limit : 6
                });
            });
        </script>
	</head>
	<body>
	<center>
		<div class="wrapper">
			
			<!-- START CONTAINER -->
			<div class="container">
				<!-- START BODY -->
				<div class="body">
					<div class="log-body" style="margin-top: 50px;">
						<form method="post" name="admin_signup_form" id="admin_signup_form">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Promote Agent</h1></td>
								</tr>
						<?php 

							if(isset($_GET['username'])==true) {

						?>
								<tr>
									<td><input type="text" name="username" id="username" placeholder="Agent Username" readonly="readonly" value="<?php echo $_GET['username']; ?>"></td>
								</tr>
						<?php 

							}
							else {
						?>
								<tr>
									<td><input type="text" name="username" id="username" placeholder="Agent Username" class="typeahead tt-query username" autocomplete="off" spellcheck="false"></td>
								</tr>
						<?php 

							}

						?>
								
								<tr>
                                    <td style="height: 23px;">
                                    	<span>
                                    		<?php 

                                    			if(isset($_REQUEST['submit'])==true) {
                                    				if(!empty($_REQUEST['username'])==true && ord($_REQUEST['username'])!=32) {
                                    					
                                    					$username=$_REQUEST['username'];
                                    					
                                    					$sql_a="SELECT * FROM user WHERE username='$username' AND type='2'";
                                    					$rs_a=mysqli_query($con,$sql_a);
                                    					$count_a=mysqli_num_rows($rs_a);

                                    					if($count_a>=1) {
                                    						$sql="UPDATE user SET type='1' WHERE username='$username'";
                                    						mysqli_query($con,$sql);
                                    						echo "<span style='color:green;'><img src='img/right.png' width='13'> Agent Promoted!</span>";
                                    					}
                                    					else {
                                    						echo "<img src='img/info.png' width='13'> No Agent Found!";
                                    					}
                                    				}
                                    				else {
                                    					echo "<img src='img/info.png' width='13'> Please fill out above text boxes!";
                                    				}
                                    			}		

                                    		?>
                                    	</span>
                                    </td>
                                </tr>
								<tr>
									<td><input type="submit" value="Promote" name="submit"></td>
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
