<?php 

	session_start();

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['agent_username'])) {
		echo "<script>window.close();</script>";
	}

	include('inc/db.php');


	$generic_name=$_POST['generic_name'];

	$sql_g="SELECT * FROM generics WHERE generic_name='$generic_name'";
	$rs_g=mysqli_query($con,$sql_g);
	$count_g=mysqli_num_rows($rs_g);

	$icd_code=$_POST['icd_code'];
	$prescribed_for=$_POST['prescribed_for'];
	$its_not_to_be_taken=$_POST['its_not_to_be_taken'];
	$dosage=$_POST['dosage'];
	$how_it_should_be_taken=$_POST['how_it_should_be_taken'];
	$precautions=$_POST['precautions'];
	$storage_conditions=$_POST['storage_conditions'];


	if(empty($generic_name)==true || empty($icd_code)==true || empty($prescribed_for)==true || empty($its_not_to_be_taken)==true || empty($dosage)==true || empty($how_it_should_be_taken)==true || empty($precautions)==true || empty($storage_conditions)==true) {

		$result ="<img src='img/info.png' width='13'> Please fill out above text boxes!";
	}
	elseif(ord($generic_name)==32 || ord($icd_code)==32 || ord($prescribed_for)==32 || ord($its_not_to_be_taken)==32 || ord($dosage)==32 || ord($how_it_should_be_taken)==32 || ord($precautions)==32 || ord($storage_conditions)==32) {

		$result ="<img src='img/info.png' width='13'> Please fill out above text boxes!";
	}
	elseif($count_g>0) {
		$result ="<img src='img/info.png' width='13'> Generic already exist!";
	}
	else {

		$sql="INSERT INTO generics (generic_name,
		icd_code,
		prescribed_for,
		its_not_to_be_taken,
		dosage,
		how_it_should_be_taken,
		precautions,
		storage_conditions) VALUES ('$generic_name',
		'$icd_code',
		'$prescribed_for',
		'$its_not_to_be_taken',
		'$dosage',
		'$how_it_should_be_taken',
		'$precautions',
		'$storage_conditions')";

		mysqli_query($con,$sql);

		$result="<span style='color:green;'><img src='img/right.png' width='13'> Generic Added Successfully!</span>";
	}

	echo $result;
	

	mysqli_close($con);

?>