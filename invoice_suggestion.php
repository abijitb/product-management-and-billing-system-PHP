<?php
    $key=$_GET['key'];
    $array = array();
    /*$con=mysql_connect("localhost","root","");
    $db=mysql_select_db("jobonrow",$con);*/
    include('inc/db.php');

    $query=mysqli_query($con,"select * from invoice where invoice_no LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['invoice_no'];
    }
    echo json_encode($array);
?>
