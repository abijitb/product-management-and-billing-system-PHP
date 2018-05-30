<?php 

	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}

	include('inc/db.php');


	$medicine_name=$_POST['medicine_name'];

	$sql_m="SELECT * FROM medicines WHERE medicine_name='$medicine_name'";
	$rs_m=mysqli_query($con,$sql_m);
	$count_m=mysqli_num_rows($rs_m);

	//---------
	$generic_name=$_POST['generic_name'];

	$sql_g="SELECT * FROM generics WHERE generic_name='$generic_name'";
	$rs_g=mysqli_query($con,$sql_g);
	$count_g=mysqli_num_rows($rs_g);
	$row_g=mysqli_fetch_array($rs_g);

	//--------

	

	$manufacturer=$_POST['manufacturer'];

	$category=$_POST['category'];

	$unit=$_POST['unit'];

	$type=$_POST['type'];

	$quantity=$_POST['quantity'];

	$stock=$_POST['stock'];

	$cgst=$_POST['cgst'];

	$sgst=$_POST['sgst'];

	$price=$_POST['price'];


	if(empty($medicine_name)==true || empty($generic_name)==true || empty($manufacturer)==true || empty($category)==true || empty($unit)==true || empty($type)==true || empty($quantity)==true || empty($stock)==true || empty($cgst)==true || empty($sgst)==true || empty($price)==true) {

		$result ="<img src='img/info.png' width='13'> Please fill out above text boxes!";
	}
	elseif(ord($medicine_name)==32 || ord($generic_name)==32 || ord($manufacturer)==32 || ord($category)==32 || ord($unit)==32 || ord($type)==32 || ord($quantity)==32 || ord($stock)==32 || ord($cgst)==32 || ord($sgst)==32 || ord($price)==32) {

		$result ="<img src='img/info.png' width='13'> Please fill out above text boxes!";
	}
	elseif($count_g<=0) {
		$result ="<img src='img/info.png' width='13'> No Genneric exist with this name!";
	}
	elseif($count_m>0) {
		$result ="<img src='img/info.png' width='13'> Medicine already exist!";
	}
	else {
		$generic_id=$row_g['generic_id'];

		$sql="INSERT INTO medicines (medicine_name,
		generic_id,
		manufacturer,
		category,
		unit,
		type,
		quantity,
		stock,
		cgst,
		sgst,
		price) VALUES ('$medicine_name',
		'$generic_id',
		'$manufacturer',
		'$category',
		'$unit',
		'$type',
		'$quantity',
		'$stock',
		'$cgst',
		'$sgst',
		'$price')";

		mysqli_query($con,$sql);

		$result="<span style='color:green;'><img src='img/right.png' width='13'> Medicine Added Successfully!</span>";
	}

	echo $result;
	

	mysqli_close($con);

?>