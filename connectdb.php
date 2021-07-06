<? 
// date_default_timezone_set("Asia/Bangkok");
// $objConnect = mysqli_connect("localhost","root","") or die("Error Connect to Database");
// $objDB = mysqli_select_db("workshop_work_io");
// mysqli_query("SET NAMES UTF8");
?>


<?php
$condb= mysqli_connect("localhost","root","","workshop_work_io") or die("Error: " . mysqli_error($condb));
mysqli_query($condb, "SET NAMES 'utf8' ");
date_default_timezone_set('Asia/Bangkok');
?>