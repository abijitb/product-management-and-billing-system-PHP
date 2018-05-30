<?php 

	session_start();

	if(!isset($_SESSION['admin_username'])) {
        echo "<script>window.close();</script>";
    }

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | Add Generic</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {


                $("#add_generic_form").validate({
                    rules:
                    {
                        generic_name: {
                            required: true
                        },
                        icd_code: {
                            required: true
                        },
                        prescribed_for: {
                            required: true
                        },
                        its_not_to_be_taken: {
                            required: true
                        },
                        dosage: {
                            required: true
                        },
                        how_it_should_be_taken: {
                            required: true
                        },
                        precautions: {
                            required: true
                        },
                        storage_conditions: {
                            required: true
                        },
                        
                    },
                    messages:
                    {
                        generic_name: "<span><img src='img/info.png' width='13'> This Field is required</span>",
                        icd_code: "<span><img src='img/info.png' width='13'> This Field is required</span>",
                        prescribed_for: "<span><img src='img/info.png' width='13'> This Field is required</span>",
                        its_not_to_be_taken: "<span><img src='img/info.png' width='13'> This Field is required</span>",
                        dosage: "<span><img src='img/info.png' width='13'> This Field is required</span>",
                        how_it_should_be_taken: "<span><img src='img/info.png' width='13'> This Field is required</span>",
                        precautions: "<span><img src='img/info.png' width='13'> This Field is required</span>",
                        storage_conditions: "<span><img src='img/info.png' width='13'> This Field is required</span>"                    },
                    submitHandler: submitForm
                });

                function submitForm() {
                    //$("#signup_form").on("submit", function(event) {
                       // event.preventDefault();
                        //$('input[type="submit"]').attr('disabled','disabled');

                        $("#img-result").fadeIn();
                        $("#result").html("");
                        var data = $("#add_generic_form").serialize();
                        $.ajax({
                            url: "add_generic_process.php",
                            type: "post",
                            data: data,
                            success: function(result) {
                                $("#img-result").fadeOut(100);
                                $("#result").delay(400).fadeIn(300, function() {
                                    $(this).html(result);
                                });
                            }

                        });
                    //});
                    return false;
                }
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
					<div class="log-body" style="margin-top: 50px;">
						<form method="post" name="add_generic_form" id="add_generic_form">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Add Generic</h1></td>
								</tr>
								
								<tr>
									<td><input type="text" name="generic_name" id="generic_name" placeholder="Generic Name"></td>
								</tr>
								<tr>
									<td><input type="text" name="icd_code" id="icd_code" placeholder="International Classification of Diseases No."></td>
								</tr>
								<tr>
                                    <td>
                                        <textarea cols="20" rows="4" placeholder="Prescribed For" name="prescribed_for" id="prescribed_for"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea cols="20" rows="4" placeholder="When It's not to be taken" name="its_not_to_be_taken" id="its_not_to_be_taken"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea cols="20" rows="4" placeholder="Dosage" name="dosage" id="dosage"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea cols="20" rows="4" placeholder="How it should be taken" name="how_it_should_be_taken" id="how_it_should_be_taken"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea cols="20" rows="4" placeholder="Precaution(s)" name="precautions" id="precautions"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <textarea cols="20" rows="4" placeholder="Storage Condition(s)" name="storage_conditions" id="storage_conditions"></textarea>
                                    </td>
                                </tr>

								<tr>
									<td style="height: 23px;">
										<img src="img/loading1.gif" id="img-result" width="18" >
										<span id="result"></span>
									</td>
								</tr>
								<tr>
									<td><input type="submit" value="Add"></td>
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