<?php 

	session_start();

// -- QR Code Starting --

	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'phpqrcode'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    $PNG_WEB_DIR = 'phpqrcode/temp/';

	include "phpqrcode/qrlib.php";  

	 if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    $matrixPointSize = 3;
    $errorCorrectionLevel = 'L';

      

//	-- QR Code Ending --


    if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}

	include('inc/db.php');


	if(!isset($_GET['invoice_no'])==true) {
		header('Location:ph_form.php');
	}
	else {
		$invoice_no=$_GET['invoice_no'];
	}


	$sql="SELECT * FROM invoice WHERE invoice_no='$invoice_no'";

	$rs=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($rs);

	$rs_p=mysqli_query($con,$sql);
	$t=0.0;
	while($row_p=mysqli_fetch_array($rs_p)) {
		$t=$t+$row_p['total'];

		$net=number_format((float)$t, 2, '.', '');
	}

	$text="
    	Floris

    	Invoice No.: ".$row['invoice_no']."
		Date: ".$row['invoice_date']."
		Time: ".$row['invoice_time']."
    	Cashier: ".$row['cashier']."
    	Customer Ph No.: ".$row['phone_no']."

    	Total Purchase : Rs.".$net;

    QRcode::png($text, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" href="css/open-sans.css">
	<style type="text/css">
		* {
			font-family: 'Open Sans';
			padding: 0px;
			font-size: 14.5px;
		}

		div {
			width: 750px; height: 899px;
			background: #f7eef1;
		}
		
		table tr td {
			padding: 1px 0px 1px 10px;
		}
		hr {
			
			border: 1px dashed #000;
		}

		input {
			margin: 20px 0px 20px 0px;
			background: rgb(77, 17, 183);
			color: #fff;
			border: none;
			padding: 10px;
		}
		input:hover {
			background: rgb(51, 12, 119);
			-webkit-transition: .45s;
		    -moz-transition: .45s;
		    -ms-transition: .45s;
		    -o-transition: .45s;
		    transition: .45s;
		}


	</style>
</head>
<body>
	<center>
		<div >
			<table style="width: 100%;" cellspacing="0" >
				<tr>
					<td colspan="2">
						Tax Invoice
					</td>
				</tr>
				
				<tr>
					<td style="font-weight: 700; font-size: 20px;" colspan="2">Floris</td>
				</tr>
				<tr>
					<td colspan="2">
						Ph: +91-9876543210
					</td>
				</tr>
				<tr>
					<td colspan="2">Email: <a href="mailto:info@floris.com">info@floris.com</a></td>
				</tr>
				<tr>
					<td style="padding: 0px;" colspan="2"><hr></td>
				</tr>

				<tr>
					<td colspan="2">GSTIN No.: 19ABCVR7892H2XS</td>
				</tr>
				<tr>
					<td colspan="2">Company PAN: ABCVR7892H</td>
				</tr>
				<tr>
					<td style="padding: 0px;" colspan="2"><hr></td>
				</tr>

				<tr>
					<td>Invoice No.: <?php echo $row['invoice_no'] ?> </td>
					<td rowspan="5"><?php echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" width="100"/>'; ?></td>
				</tr>
				<tr>
					<td>Date: <?php echo $row['invoice_date']; ?>&nbsp;&nbsp; Time: <?php echo $row['invoice_time']; ?></td>
				</tr>
				<tr>
					<td>Cashier: <?php echo $row['cashier']; ?></td>
				</tr>
				<tr>
					<td>Cashier Name: <?php echo $row['cashier_name']; ?></td>
				</tr>
				<tr>
					<td>Customer Ph No.: <?php echo $row['phone_no']; ?></td>
				</tr>
			</table>


			<table style="width: 100%; margin-top: 20px;"  >
				<tr>
					<td style="padding: 0px;" colspan="6"><hr></td>
				</tr>
				<tr>
					<th style="width: 36%; border-bottom: 1px solid #000; padding: 5px 1px 5px 1px;">Medicine Name</th>
					<th style="border-bottom: 1px solid #000; padding: 5px 1px 5px 1px;">Quantity</th>
					<th style="border-bottom: 1px solid #000; padding: 5px 1px 5px 1px;">CGST</th>
					<th style="border-bottom: 1px solid #000; padding: 5px 1px 5px 1px;">SGST</th>
					<th style="width: 15%; border-bottom: 1px solid #000; padding: 5px 1px 5px 1px;">Price</th>
					<th style="width: 15%; border-bottom: 1px solid #000; padding: 5px 1px 5px 1px;">Total</th>
				</tr>

		<?php 

			$rs_i=mysqli_query($con,$sql);

			while($row_i=mysqli_fetch_array($rs_i)) {
		
		?>
				<tr>
					<td align="center"><?php echo $row_i['medicine_name']; ?></td>
					<td align="center"><?php echo $row_i['quantity']; ?></td>
					<td align="center"><?php echo $row_i['cgst']; ?> %</td>
					<td align="center"><?php echo $row_i['sgst']; ?> %</td>
					<td align="center">&#8377; <?php echo $row_i['price']; ?></td>
					<td align="center">&#8377; <?php echo $row_i['total']; ?></td>
				</tr>

		<?php 

			}

		?>
				
				<tr>
					<td style="padding: 0px;" colspan="6"><hr style="border: 1px solid #000;"></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td align="center">Net Amount</td>
					<td align="center">&#8377; <?php echo $net; ?></td>
				</tr>
				<tr>
					<td style="padding: 0px;" colspan="6"><hr></td>
				</tr>
			</table>


			<table style="width: 100%; margin-top: 0px; position: relative; top: 50px;" cellspacing="0">
				<tr>
					<td>* For any queries, Please Call Toll Free Number - 1800 1800 1800</td>
				</tr>
				<tr>
					<td style="padding: 0px 10px 0px 10px; text-align: justify;"><p>* Net Amount Inclusive of applicable taxes. This document is to be treated as tax invoice to the extent of supply of taxable goods and bill of supply to the extent of supply of exempted goods.</p></td>
				</tr>
				<tr>
					<td><p>* This is computer generated invoice &amp; should be treated as signed by an authorized signatory.</p></td>
				</tr>
				<tr>
					<td align="center"><p>Thank You!</p></td>
				</tr>

			</table>
		</div>

		<input type="button" value="Print" onclick="print();">
	</center>
</body>
</html>