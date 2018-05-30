<?php 
	
	session_start();
    

	include('inc/db.php');

	$username=$_POST['username'];
	$password=$_POST['password'];
	$new_password=$_POST['new_password'];

	$password_hash=md5($password,true);
	$new_password_hash=md5($new_password,true);


	$sql="SELECT * FROM user WHERE username='$username'";
	$rs=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($rs);

	if($password==null or $new_password==null or $username==null) {
		$result="<span style='font-size: 12.5px; color: red; padding: -2px; padding-bottom:2px; ' ><img src='img/info.png' width='13'> Please fill out above text boxes!</span>";
	}
	elseif(ord($username)==32 or ord($password)==32 or ord($new_password)==32) {
		$result ="<span style='font-size: 12.5px; color: red; padding: -2px; padding-bottom:2px; ' ><img src='img/info.png' width='13'> Please fill out above text boxes!</span>";
	}
	elseif($password==$new_password) {
		$result ="<span style='font-size: 12.5px; color: red; padding: -2px; padding-bottom:2px; ' ><img src='img/info.png' width='13'> This is Your Old Password!</span>";
	}
	else if($row['username']==$username && $row['password']==$password_hash) {
		$sql_ins="UPDATE user SET password='$new_password_hash' WHERE username='$username'";
		$rs_ins=mysqli_query($con,$sql_ins);

		if(isset($_SESSION['temp_pass'])) {
			unset($_SESSION['temp_pass']);
		}

		$result="<span style='color:green;'><img src='img/right.png' width='13'> Password Changed!</span>";
	}
	else {
		$result="<span style='font-size: 12.5px; color: red; padding: -2px; padding-bottom:2px; ' ><img src='img/wrong.png' width='13'> Invalid username or Password!</span>";
	}

	echo $result;

	mysqli_close($con);

?>