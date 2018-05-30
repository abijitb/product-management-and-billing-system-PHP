<?php 

	include('inc/db.php');

	$admin_name=$_POST['admin_name'];
	$admin_username=$_POST['admin_username'];
	$admin_password=$_POST['admin_password'];
	$re_admin_password=$_POST['re_admin_password'];
	$type="1";
	$joining_date=date('Y-m-d');
	
	date_default_timezone_set("Asia/Kolkata"); 
	$joining_time=date("h:i:sa");

	$admin_password_len=strlen($admin_password);

	$admin_password_hash=md5($admin_password,true);


	$security_qstn=md5($_POST['security_qstn']);

	$security_ans=md5($_POST['security_ans']);

	$sql=("SELECT * FROM user WHERE username='$admin_username'");
	$rs=mysqli_query($con,$sql);



	$row=mysqli_fetch_array($rs);

	if($admin_username==null or $admin_password==null or $admin_name==null or $re_admin_password==null) {
		$result ="<img src='img/info.png' width='13'> Please fill out above text boxes!";
	}
	elseif(ord($admin_username)==32 or ord($admin_password)==32 or ord($admin_name)==32 or ord($re_admin_password)==32) {
		$result ="<img src='img/info.png' width='13'> Please fill out above text boxes!";
	}
	else if($admin_username==$row['username']) {
		$result ="<img src='img/info.png' width='13'> An account already exist with this username!";
	}
	else if($admin_password!=$re_admin_password) {
		$result ="<img src='img/info.png' width='13'> Password isn't similler between two text boxes!";
	}
	else if ($admin_password_len<8) {
		$result ="<img src='img/info.png' width='13'> Password must be 8 character long!";
	}
	else if (preg_match("/[^A-Za-z0-9\_]/", $admin_username)) {
		$result ="<img src='img/info.png' width='13'> No special characters allowed except '_'!";
	}
	else {
		$sql_ins="INSERT INTO user (name,
			username,
			password,
			security_qstn,
			security_ans,
			type,
			joining_date,
			joining_time) VALUES ('$admin_name',
			'$admin_username',
			'$admin_password_hash',
			'$security_qstn',
			'$security_ans',
			'$type',
			'$joining_date',
			'$joining_time')";
		$rs_ins=mysqli_query($con,$sql_ins);
		$result = "<span style='color:green;'><img src='img/right.png' width='13'> You've Successfully Signed Up!</span>";
	}

	echo $result;

	mysqli_close($con);

	
?>

