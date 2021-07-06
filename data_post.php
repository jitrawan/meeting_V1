<?
	include("connectdb.php");

	$time1 = $_POST["myHour1"].":".$_POST["myMin1"].":00";
	$time2 = $_POST["myHour2"].":".$_POST["myMin2"].":00";

	$strSQL = "SELECT * FROM meeting_list WHERE ((strdate between '".$_POST["myDate1"]."' and '".$_POST["myDate2"]."') or ";
	$strSQL .= " (enddate between '".$_POST["myDate1"]."' and '".$_POST["myDate2"]."')) and ";
	$strSQL .= " ((strtime between '".$time1."' and '".$time2."') or ";
	$strSQL .= " (endtime between '".$time1."' and '".$time2."')) and room = '".$_POST["myRoom"]."' and mstatus in('Y','N') ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if($objResult)
	{
		echo "ห้องไม่ว่าง มีคนจองแล้ว!";
	}
	else
	{
		echo "ห้องว่าง สามารถจองได้!";
	}

?>



