<?php 

	session_start();
	include('inc/db.php');

	$admin_username=$_POST['admin_username'];
	$security_qstn=$_POST['security_qstn'];
	$security_qstn_hash=md5($security_qstn);

	$security_ans=$_POST['security_ans'];
	$security_ans_hash=md5($security_ans);

	$sql=("SELECT * FROM user where username='$admin_username' AND security_qstn='$security_qstn_hash' AND security_ans='$security_ans_hash' AND type='1'");
	$rs=mysqli_query($con,$sql);
	$count=mysqli_num_rows($rs);

	if ($admin_username==null or $security_qstn==null or $security_ans==null) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif(empty($admin_username)==true or empty($security_qstn)==true or empty($security_ans)==true) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif(ord($admin_username)==32 or ord($security_qstn)==32 or ord($security_ans)==32) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif($count>=1) {
		$_SESSION['admin_username']=$admin_username;
		$temp_pass="f".rand().rand()."s";
		$temp_pass_hash=md5($temp_pass,true);
		$_SESSION['temp_pass']=$temp_pass;

		$sql_up="UPDATE user SET password='$temp_pass_hash' WHERE username='$admin_username'";
		mysqli_query($con,$sql_up);

		$result="";
	}
	else {
		$result="<img src='img/wrong.png' width='12'> Invalid login!";
	}
	echo $result;


	mysqli_close($con);

?>
