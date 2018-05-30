<?php 

	session_start();
	include('inc/db.php');

	$agent_username=$_POST['agent_username'];
	$agent_password=$_POST['agent_password'];

	$agent_password_hash=md5($agent_password,true);

	$sql=("SELECT * FROM user where username='$agent_username' AND password='$agent_password_hash' AND type='2'");
	$rs=mysqli_query($con,$sql);
	$count=mysqli_num_rows($rs);

	if ($agent_username==null or $agent_password==null) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif(empty($agent_username)==true or empty($agent_password)==true) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif(ord($agent_username)==32 or ord($agent_password)==32) {
		$result="<img src='img/info.png' width='13'> Please fill out above fields!";
	}
	elseif($count>=1) {
		$_SESSION['agent_username']=$agent_username;
		$result="";
	}
	else {
		$result="<img src='img/wrong.png' width='12'> Invalid login! Retype username or password!";
	}
	echo $result;


	mysqli_close($con);

?>
