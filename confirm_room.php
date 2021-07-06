<? session_start();
	if($_SESSION['member_id'] == "")
	{
		header("Location: index.php");
				
	}
	if($_SESSION['member_status'] == 'admin')
	{ 	
	}
	else
	{ header("Location: access_denined.php");
	}
	error_reporting(0);
	
?>
<? include("f_thaidate.php");?>
<? include("datepick/datepick.php"); ?>
<html>
<head>
<title>Reservations Meeting</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css"> <!--pemanggilan file css-->
<link rel="stylesheet" type="text/css" href="calendar.css">
<script type="text/jscript">
$(document).ready(function() {
	$('a.button1').click(function() {
		
                //Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border see css style
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
</script>
</head>

<body>
<div id="header">
	<div class="inHeader">
    	<div class="mosAdmin">
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		ยินดีต้อนรับ 
		<a href=""> <?=$_SESSION["member_name"];?> </a>
		<img src="mos-css/img/Administrator.png">
        </div>
	<div class="clear"></div>
	</div>
</div>

<div id="wrapper">
	<div id="leftBar">
	<ul>
    	
		<li><a href="home.php">หน้าแรก</a></li>
		<li><a href="logout.php">ออกจากระบบ</a></li>
	</ul>
	</div>
	<div id="rightContent">
    <? include("menu_center.php");?>
    <div class="clear"></div>
    <? include("connectdb.php");
		$today = date("Y-m-d");
	?>
    <h3><img src="img/icon/64/accept_page.png">อนุมัติห้องประชุม 
    </h3>
    	
        		
		<div class="clear"></div>
        
        <!-- per page -->


<!-- ui-dialog -->

<!-- end ui dialog -->
<div class="input-data-arrow">
	<form method="post" action="confirm_room.php" id="formsearch">
	<? 	$strSQL = "select * from meeting_room where status = 'Y'";
	 	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	?>
     เลือกห้อง <select name="txtName">
     <option value="">-- เลือกห้องประชุม --</option>
     <? while($objResult = mysql_fetch_array($objQuery))
        {
		?>
        <option value="<?=$objResult["id"];?>"><?=$objResult["name"];?></option>
        
        <?
        }
		?>
     </select>
      สถานะ <select name="txtStatus">
         <option value="N"> ยังไม่ได้อนุมัติ </option>
         <option value="Y"> อนุมัติไปแล้ว </option>
         <option value="S"> ยกเลิกการจอง </option>
     </select>
     
     <input type="submit" class="button" value="ตกลง">
     </form>
</div>     
	<? 	if($_REQUEST["txtName"]=='')
		{
			$strSQL1 = "select l.id,l.name,l.strdate,l.strtime,l.enddate,l.endtime,r.name as rname,l.mstatus,l.conduct,l.conduct_1,l.conduct_2,l.conduct_3,l.budget,l.qty,l.conduct_2_qty,l.conduct_3_qty ";
			$strSQL1 .= " from meeting_list l ";
			$strSQL1 .= " left outer join meeting_room r on r.id = l.room ";
			$strSQL1 .= " where mstatus = '".$_REQUEST["txtStatus"]."' ";
		}
		else
		{
			$strSQL1 = "select l.id,l.name,l.strdate,l.strtime,l.enddate,l.endtime,r.name as rname,l.mstatus,l.conduct,l.conduct_1,l.conduct_2,l.conduct_3,l.budget,l.qty,l.conduct_2_qty,l.conduct_3_qty ";
			$strSQL1 .= " from meeting_list l ";
			$strSQL1 .= " left outer join meeting_room r on r.id = l.room ";
			$strSQL1 .= " where room = '".$_REQUEST["txtName"]."' and mstatus = '".$_REQUEST["txtStatus"]."' ";
		}
		
		$objQuery1 = mysql_query($strSQL1);
		
	?>
        <div class="clear"></div>
<img src="img/icon/accept_16.png"> อนุมัติแล้ว | <img src="img/icon/wait_16.png"> รอการอนุมัติ | <img src="img/icon/block_16.png"> ยกเลิกการจอง
<table class="data1">
	<tr class="data1">
		<th class="data1" width="4%">สถานะ</th>
        <th class="data1" width="15%">ห้องประชุม</th>
        <th class="data1" width="23%">วันเวลาที่เริ่ม</th>
        <th class="data1" width="28%">หัวข้อ</th>
        <th class="data1" width="20%">รายละเอียด</th>
        <th class="data1" width="5%">ยกเลิก</th>
        
        
    </tr>
    
        <?
        while($objResult1 = mysql_fetch_array($objQuery1))
        { 	
			
		?>
        <tr class="data1">
            <td class="data1" width="4%" align="center"><a href="admin_change_status_meeting.php?status=<?=$objResult1["mstatus"];?>&&id=<?=$objResult1["id"];?>&&txtname=<?=$_REQUEST["txtName"];?>&&txtstatus=<?=$_REQUEST["txtStatus"];?>">
            <?	if($objResult1["mstatus"]=='Y')
			{
				echo "<img src='img/icon/accept.png'>";
			}
			else if($objResult1["mstatus"]=='N')
			{
				echo "<img src='img/icon/wait.png'>";
			}
			else if($objResult1["mstatus"]=='S')
			{
				echo "<img src='img/icon/delete.png'>";
			}
			?></a>
            </td>
            <td class="data1" width="15%"><?=$objResult1["rname"];?></td>
            <td class="data1" width="23%" align="center">
			<?=Datethai($objResult1["strdate"]);?> <?=$objResult1["strtime"];?><br>
            <a href="#">-</a> <br>
            <?=Datethai($objResult1["enddate"]);?> <?=$objResult1["endtime"];?>
            </td>
            <td class="data1" width="28%"><?=$objResult1["name"];?></td>
            <td class="data1" width="20%">
            <? echo "จำนวน ".$objResult1["qty"]." คน <br>";
			?>
			<? if($objResult1["conduct"]=='Y')
			{
				echo "ผู้รับผิดชอบดำเนินการเอง <br>";
			}
			else
			{
				echo "ทางธุรการดำเนินงานให้ <br>";
			}
			?>
			<? if($objResult1["conduct_1"]=='Y')
			{
				echo " - จัดสถานที่ประชุม <br>";
			}
			?>
			<? if($objResult1["conduct_2"]=='Y')
			{
				echo "- จัดน้ำดื่ม (น้ำเปล่า) <br>";
			}
			?>
            <? if($objResult1["conduct_2_qty"]>0)
			{
				echo " &nbsp;&nbsp;&nbsp;จำนวน ".$objResult1["conduct_2_qty"]." รอบเบรค <br>";
			}
			?>
			<? if($objResult1["conduct_3"]=='Y')
			{
				echo "- จัดเครื่องดื่มพร้อมอาหารว่าง <br>";
			}
			?>
            <? if($objResult1["conduct_3_qty"]>0)
			{
				echo " &nbsp;&nbsp;&nbsp;จำนวน ".$objResult1["conduct_3_qty"]." รอบเบรค <br>";
			}
			?>
			<? if($objResult1["budget"]=='1')
			{
				echo "เงินบำรุงโรงพยาบาลอู่ทอง";
			}
			else if($objResult1["budget"]=='2')
			{
				echo "เงินสนับสนุน/โครงการของผู้จัด";
			}
			else if($objResult1["budget"]=='3')
			{
				echo "ไม่เสียงบประมาณ(ประชุมภายในโรงพยาบาล ขอเฉพาะน้ำดื่ม)";
			}
			?>
            </td>
            <td class="data1" width="5%" align="center">
            <a href="admin_cancle_meeting.php?id=<?=$objResult1["id"];?>&&name<?=$_REQUEST["txtName"];?>&&status=<?=$_REQUEST["txtStatus"];?>" onClick="return confirm('ยกเลิกรายการจองห้องประชุมนี้?')">
            <img src="img/icon/delete_16.png"></a></td>
            
        </tr>
        <? 
		}
        ?>
	
</table>
 
    <div class="clear"></div>
       
        
</div>
	<div class="clear"></div>
<div id="footer">
<? include("footer.php");?>
</div>
</div>
</body>
</html>