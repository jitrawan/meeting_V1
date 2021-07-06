<html>
<head>
<title>Uthong Management</title>
<meta HTTP-EQUIV="Refresh" CONTENT="1;URL=confirm_room.php?txtName=<?=$_GET["name"];?>&&txtStatus=<?=$_GET["status"];?>" charset="utf-8">
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
	
	$strSQL = "UPDATE meeting_list SET ";
	$strSQL .="mstatus = 'S' ";
	$strSQL .="WHERE id = '".$_GET["id"]."' ";

	$objExecute = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	echo "ยกเลิกการจองห้องรายการนี้เรียบร้อยแล้ว !";	
	
	

	mysql_close();
?>

		</div>
</div>
</body>
</html>