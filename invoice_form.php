<?php 

//invoice_form.php

	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}


	if(isset($_SESSION['admin_username'])==true) {
		$cashier=$_SESSION['admin_username'];
	}
	elseif(isset($_SESSION['agent_username'])==true) {
		$cashier=$_SESSION['agent_username'];
	}
	else {
		echo "";
	}


	include('inc/db.php');

	$sql_med="SELECT * FROM medicines WHERE stock>0";
	$rs_med=mysqli_query($con,$sql_med);

	if(!isset($_GET['phone_no'])==true) {
		header('Location:ph_form.php');
	}

	$phone_no=$_GET['phone_no'];

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Floris | Quick Invoice</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"-->
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/open-sans.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style_typehead.css">
	
		<style type="text/css">
			h1 {
				color: rgb(51, 12, 119);
			}
		</style>

		<script type="text/javascript">	
			function addRow(tableID) {
				var table=document.getElementById(tableID);
				var rowCount=table.rows.length;
				if(rowCount<10) {
					var row=table.insertRow(rowCount);
					var colCount=table.rows[0].cells.length;
					for(var i=0;i<colCount;i++) {
						var newCell=row.insertCell(i);
						newCell.innerHTML=table.rows[0].cells[i].innerHTML;
					}
				}
				else {
					alert('Max 10 Products per Invoice');
				}
			}

			function deleteRow(tableID) {
				var table=document.getElementById(tableID);
				var rowCount=table.rows.length;
				for(var i=0;i<rowCount;i++) {
					var row=table.rows[i];
					var chkbox=row.cells[0].childNodes[0];
					if(null!=chkbox && true==chkbox.checked) {
						if(rowCount<=1) {
							alert('Can not remove all Products');
							break;
						}
						table.deleteRow(i);
						rowCount--;
						i--;
					} 
				}
			}
		</script>
		
      	
	</head>
	<body>
	<center>
		<div class="wrapper">
			
			<!-- START CONTAINER -->
			<div class="container">
				<!-- START BODY -->
				<div class="body">
					<div class="block-body" style="padding: 20px 0px 20px 0px; margin-top: 0px;">
						<h1 style="font-size: 50px; color: #09b5a5;">Create Invoice</h1>
					</div>

				<form method="post" action="invoice_process.php" name="invoice_form" id="invoice_form">
					<div class="block-body" style="margin-top: 15px;padding: 28px 0px 28px 0px;">
						<table width="930">
							
							<tr>
								<td><h1>Customer's Phone Number</h1></td>
								<td><input type="text" name="phone_no" id="phone_no" readonly="readonly" value="<?php echo $phone_no; ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="hidden" name="cashier" value="<?php echo $cashier; ?>"></td>
							</tr>
						</table>
					</div>

					<div class="block-body" style="margin-top: 15px;padding: 28px 0px 28px 0px;">
						<table width="800">
							<tr>
								<td width="50%"><input type="button" value="Add Product" onclick="addRow('dataTable')"></td>
								<td><input type="button" value="Delete Product" onclick="deleteRow('dataTable')"></td>
							</tr>
						</table>
					</div>

					<div class="block-body" style="margin-top: 15px;padding: 28px 0px 28px 0px;">
						<table width="925" id="dataTable">
							
							<tr>
								<td><input type="checkbox" name="chk[]" checked="checked" class="chk"></td>
								<td align="left" valign="top">
									<input type="text" name="medicine_name[]" id="medicine_name[]" required="required" placeholder="Medicine Name" list="medicine_list">
									<datalist id="medicine_list">
								<?php 

									while($row_med=mysqli_fetch_array($rs_med)) {

								?>
										<option value="<?php echo $row_med['medicine_name'] ?>"><?php echo $row_med['stock'] ?> In Stock</option>
								<?php 

									}

								?>
									</datalist>
								</td>
								<td align="right" valign="top">
									<input type="number" name="bill_stock[]" id="bill_stock[]" required="required" placeholder="Quantity">
								</td>
							</tr>
						</table>
					</div>

					<div class="block-body" style="margin-top: 15px;padding: 28px 0px 28px 0px;">
						<table width="800">
							<tr>
								<td width="50%"><input type="submit" value="Submit"></td>
								<td><input type="reset" value="Reset"></td>
							</tr>
						</table>
					</div>
				</form>

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