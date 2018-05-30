<?php
    $key=$_GET['key'];
    $array = array();
    /*$con=mysql_connect("localhost","root","");
    $db=mysql_select_db("jobonrow",$con);*/
    include('inc/db.php');
    $query=mysqli_query($con,"select * from generics where icd_code LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['icd_code'];
    }
    echo json_encode($array);
?>
