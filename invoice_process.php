<?php 

	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}

	include('inc/db.php');


	$phone_no=$_POST['phone_no']; //

	$medicine_name=$_POST['medicine_name'];//

	$bill_stock=$_POST['bill_stock'];//

	foreach ($medicine_name as $a => $b) {

		$sql_med="SELECT * FROM medicines WHERE medicine_name='".$medicine_name[$a]."'";
		$rs_med=mysqli_query($con,$sql_med);
		$row_med=mysqli_fetch_array($rs_med);

		$cgst[$a]=$row_med['cgst']; //

		$sgst[$a]=$row_med['sgst']; //

		$price[$a]=$row_med['price']; //

		$cgst_amt[$a]=$price[$a]*($cgst[$a]/100);
		$sgst_amt[$a]=$price[$a]*($sgst[$a]/100);

		$total[$a]=($price[$a]+$cgst_amt[$a]+$sgst_amt[$a])*$bill_stock[$a]; //

		$medicine_stock[$a]=$row_med['stock']-$bill_stock[$a];


		$sql_up="UPDATE medicines SET stock='".$medicine_stock[$a]."' WHERE medicine_name='".$medicine_name[$a]."'";
		mysqli_query($con,$sql_up);
	}
	


	$invoice_no="F".rand()."S".rand(); //

	$invoice_date=date('Y-m-d'); //
	
	date_default_timezone_set("Asia/Kolkata"); 
	$invoice_time=date("h:i:sa");//

	$cashier=$_POST['cashier']; //
 
	$sql_cash="SELECT * FROM user WHERE username='".$cashier."'";
	$rs_cash=mysqli_query($con,$sql_cash);
	$row_cash=mysqli_fetch_array($rs_cash);


	$cashier_name=$row_cash['name']; //

	


	



	foreach ($medicine_name as $a => $b) {

		

		$sql="INSERT INTO invoice (invoice_no,
		invoice_date,
		invoice_time,
		cashier,
		cashier_name,
		phone_no,
		medicine_name,
		quantity,
		cgst,
		sgst,
		price,
		total) VALUES ('".$invoice_no."',
		'".$invoice_date."',
		'".$invoice_time."',
		'".$cashier."',
		'".$cashier_name."',
		'".$phone_no."',
		'".$medicine_name[$a]."',
		'".$bill_stock[$a]."',
		'".$cgst[$a]."',
		'".$sgst[$a]."',
		'".$price[$a]."',
		'".$total[$a]."')";

		$rs=mysqli_query($con,$sql);

	}

?>


<script type="text/javascript">
	location.href="invoice.php?invoice_no=<?php echo $invoice_no ?>";
</script>