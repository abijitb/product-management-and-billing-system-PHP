<?php 

	session_start();
	include('inc/db.php');

	$admin_username=$_POST['admin_username'];
	$admin_password=$_POST['admin_password'];

	$admin_password_hash=md5($admin_password,true);

	$sql=("SELECT * FROM user where username='$admin_username' AND password='$admin_password_hash' AND type='1'");
	$rs=mysqli_query($con,$sql);
	$count=mysqli_num_rows($rs);

	if ($admin_username==null or $admin_password==null) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif(empty($admin_username)==true or empty($admin_password)==true) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif(ord($admin_username)==32 or ord($admin_password)==32) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif($count>=1) {
		$_SESSION['admin_username']=$admin_username;
		$result="";
	}
	else {
		$result="<img src='img/wrong.png' width='12'> Invalid login! Retype username or password!";
	}
	echo $result;


	mysqli_close($con);

?>
