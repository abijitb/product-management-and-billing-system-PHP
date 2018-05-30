<?php
    $key=$_GET['key'];
    $array = array();
    /*$con=mysql_connect("localhost","root","");
    $db=mysql_select_db("jobonrow",$con);*/
    include('inc/db.php');
    $query=mysqli_query($con,"select * from customer where phone_no LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['phone_no'];
    }
    echo json_encode($array);
?>
