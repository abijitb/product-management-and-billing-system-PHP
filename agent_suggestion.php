<?php
    $key=$_GET['key'];
    $array = array();
    /*$con=mysql_connect("localhost","root","");
    $db=mysql_select_db("jobonrow",$con);*/
    include('inc/db.php');
    $query=mysqli_query($con,"select * from user where username LIKE '{$key}%' AND type='2'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['username'];
    }
    echo json_encode($array);
?>
