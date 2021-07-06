<? session_start();
	error_reporting(0);
?>
<html>
<head>
<title>Uthong Management</title>
<meta HTTP-EQUIV="Refresh" CONTENT="1;URL=meeting.php" charset="utf-8">
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
	include("connectdb.php");
		
	
		if($_GET["status"]=='N')
		{
			$strSQL1 = "UPDATE meeting_list SET mstatus = 'S' where id = '".$_GET["id"]."' ";
			echo "ยกเลิกการจองเรียบร้อยแล้ว !";
		}
		else if($_GET["status"]=='S')
		{
			$strSQL1 = "UPDATE meeting_list SET mstatus = 'N' where id = '".$_GET["id"]."' ";
			echo "เปลี่ยนใจ ไม่ยกเลิกการจองเรียบร้อยแล้ว !";
		}
		else if($_GET["status"]=='Y')
		{
			$strSQL1 = "UPDATE meeting_list SET mstatus = 'S' where id = '".$_GET["id"]."' ";
			echo "ยกเลิกการจองเรียบร้อยแล้ว !";
		}
		
		$objQuery1 = mysql_query($strSQL1);
		

	mysql_close();
?>

		</div>
</div>
</body>
</html>