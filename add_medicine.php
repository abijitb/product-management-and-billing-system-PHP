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
		<title>Floris | Add Medicine</title>
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


                $("#add_medicine_form").validate({
                    rules:
                    {
                        medicine_name: {
                            required: true
                        },
                        generic_name: {
                            required: true
                        },
                        manufacturer: {
                            required: true
                        },
                        category: {
                            required: true
                        },
                        unit: {
                            required: true
                        },
                        type: {
                            required: true
                        },
                        quantity: {
                            required: true
                        },
                        stock: {
                            required: true
                        },
                        cgst: {
                            required: true
                        },
                        sgst: {
                            required: true
                        },
                        price: {
                            required: true
                        },
                    },
                    messages:
                    {
                        medicine_name: "<span><img src='img/info.png' width='13'> Enter Medicine Name!</span>",
                        generic_name: "<span><img src='img/info.png' width='13'> Enter Generic Name!</span>",
                        manufacturer: "<span><img src='img/info.png' width='13'> Enter Manufacturer Name!</span>",
                        category: "<span><img src='img/info.png' width='13'> Enter Category!</span>",
                        unit: "<span><img src='img/info.png' width='13'> Enter Unit!</span>",
                        type: "<span><img src='img/info.png' width='13'> Enter Medicine Type!</span>",
                        quantity: "<span><img src='img/info.png' width='13'> Enter Medicine Quantity!</span>",
                        stock: "<span><img src='img/info.png' width='13'> Enter In Stock Amount!</span>",
                        cgst: "<span><img src='img/info.png' width='13'> Enter CGST!</span>",
                        sgst: "<span><img src='img/info.png' width='13'> Enter SGST!</span>",
                        price: "<span><img src='img/info.png' width='13'> Enter Price!</span>"
                    },
                    submitHandler: submitForm
                });

                function submitForm() {
                    //$("#signup_form").on("submit", function(event) {
                       // event.preventDefault();
                        //$('input[type="submit"]').attr('disabled','disabled');

                        $("#img-result").fadeIn();
                        $("#result").html("");
                        var data = $("#add_medicine_form").serialize();
                        $.ajax({
                            url: "add_medicine_process.php",
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
        <link rel="stylesheet" type="text/css" href="css/style_typehead.css">
		<script src="js/typeahead.min.js"></script>

       
        <script type="text/javascript">
            $(document).ready(function(){
                $('input.generic_name').typeahead({
                    name: 'generic_name',
                    remote:'generic_suggestion.php?key=%QUERY',
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
					<div class="log-body" style="margin-top: 50px;">
						<form method="post" name="add_medicine_form" id="add_medicine_form">
							<table class="log-table" cellspacing="0">
								<tr>
									<td align="center" style="padding: 0px 0px 10px 0px;"><h1>Add Medicine</h1></td>
								</tr>
								
								<tr>
									<td><input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine Name"></td>
								</tr>
								<tr>
									<td><input type="text" name="generic_name" id="generic_name" placeholder="Generic Name" class="typeahead tt-query generic_name" autocomplete="off" spellcheck="false"></td>
								</tr>
								<tr>
									<td><input type="text" name="manufacturer" id="manufacturer" placeholder="Manufacturer"></td>
								</tr>
								<tr>
									<td><input type="text" name="category" id="category" placeholder="Medicine Category"></td>
								</tr>
								<tr>
									<td><input type="text" name="unit" id="unit" placeholder="Unit"></td>
								</tr>
								<tr>
									<td><input type="text" name="type" id="type" placeholder="Medicine Type"></td>
								</tr>
								<tr>
									<td><input type="text" name="quantity" id="quantity" placeholder="Medicine Quantity"></td>
								</tr>
								<tr>
									<td><input type="number" name="stock" id="stock" placeholder="Stock"></td>
								</tr>
								<tr>
									<td><input type="number" name="cgst" id="cgst" placeholder="CGST (don't add % sign)"></td>
								</tr>
								<tr>
									<td><input type="number" name="sgst" id="sgst" placeholder="SGST (don't add % sign)"></td>
								</tr>
								<tr>
									<td><input type="number" name="price" id="price" placeholder="Price"></td>
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