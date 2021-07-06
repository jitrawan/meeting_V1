<html>
<head>
<title>Uthong Management</title>
<meta HTTP-EQUIV="Refresh" CONTENT="2;URL=maintenance.php" charset="utf-8">
<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
	<div class="inHeaderLogin"></div>
</div>
<div id="errorForm"><br><br>
		<div class="informasi">



    <?
	include("../connectdb.php");
	
	$strSQL = "UPDATE maintenance_detail SET ";
	$strSQL .="date = '".$_POST["date3"]."' ";
	$strSQL .=",group_dep = '".$_POST["txtGdep"]."' ";
	$strSQL .=",department = '".$_POST["txtDep"]."' ";
	$strSQL .=",member_id = '".$_POST["txtMember1"]."' ";
	$strSQL .=",ploblem = '".$_POST["txtPloblem"]."' ";
	$strSQL .=",repairman = '".$_POST["txtRepairman"]."' ";
	$strSQL .=",status = '".$_POST["txtStatus"]."' ";
	$strSQL .="WHERE id = '".$_POST["txtId"]."' ";

	$objExecute = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	echo "แก้ไขข้อมูลเรียบร้อยแล้ว !";	
	
	

	mysql_close();
?>

		</div>
</div>
</body>
</html>