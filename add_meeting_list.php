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
	
	if(trim($_POST["txtName"]) == "")
	{
		echo "กรุณาระบุหัวข้อการประชุม!";
		exit();	
	}
	
	if(trim($_POST["txtQty"]) == "")
	{
		echo "กรุณารุะบุจำนวนผู้เข้าร่วมประชุม!";
		exit();	
	}	
	
	$time1 = $_POST["hour1"].':'.$_POST["min1"].':00';
	$time2 = $_POST["hour2"].':'.$_POST["min2"].':00';
			
	$strSQL = "SELECT * FROM meeting_list WHERE ((strdate between '".$_POST["date1"]."' and '".$_POST["date2"]."') or ";
	$strSQL .= " (enddate between '".$_POST["date1"]."' and '".$_POST["date2"]."')) and ";
	$strSQL .= " ((strtime between '".$time1."' and '".$time2."') or ";
	$strSQL .= " (endtime between '".$time1."' and '".$time2."')) and room = '".$_POST["txtRoom"]."' and mstatus in('Y','N') ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if($objResult)
	{
			echo "วันและเวลาที่จองห้องของคุณ ถูกจองไปแล้ว!";
	}
	else
	{	
		
		$strSQL1 = "INSERT INTO meeting_list ";
		$strSQL1 .=" (id,strdate,enddate,strtime,endtime,room,room_type,name,qty,user,conduct,conduct_1,conduct_2,conduct_3,conduct_2_qty,conduct_3_qty,budget,mstatus) ";
		$strSQL1 .=" VALUES (NULL,'".$_POST["date1"]."','".$_POST["date2"]."','".$time1."','".$time2."','".$_POST["txtRoom"]."','".$_POST["txtRoomtype"]."' ";
		$strSQL1 .=" ,'".$_POST["txtName"]."','".$_POST["txtQty"]."','".$_SESSION['member_id']."','".$_POST["rdoConduct"]."' ";
		$strSQL1 .=" ,'".$_POST["cbConduct1"]."','".$_POST["cbConduct2"]."','".$_POST["cbConduct3"]."','".$_POST["txtQtyconduct2"]."' ";
		$strSQL1 .=" ,'".$_POST["txtQtyconduct3"]."','".$_POST["rdoBudget"]."','N')";
		$objQuery1 = mysql_query($strSQL1);
		
		echo "จองห้องประชุมเรียบร้อยแล้ว !";		
	
	}

	mysql_close();
?>

		</div>
</div>
</body>
</html>