<? session_start();
	if($_SESSION['member_id'] == "")
	{
		header("Location: ../index.php");
				
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
    <h3><img src="img/icon/64/search_page.png">ตรวจสอบรายการที่จองห้อง <a href="#"> 
	<?
    if($_REQUEST["txtName"]=='')
	{
	echo "เลือกห้องประชุมก่อนนะครับ";
    }
	if($_REQUEST["txtName"]<>'')
	{
	$strSQL0 = "select * from meeting_room where id = '".$_REQUEST["txtName"]."'";
	$objQuery0 = mysql_query($strSQL0);
	$objResult0 = mysql_fetch_array($objQuery0);
	echo $objResult0["name"];
	}
	?>
    </a></h3>
    	
       		
	  <div class="clear"></div>
        
        <!-- per page -->


<!-- ui-dialog -->

<!-- end ui dialog -->
<div class="input-data-arrow">
	<form method="post" action="check_room.php" id="formsearch">
	
     <? $strSQL = "select * from meeting_room where status = 'Y'";
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
     
     <input type="submit" class="button" value="ตกลง">
     </form>
</div>     
	<? 	
			$strSQL10 = "select l.id,l.name,l.strdate,l.strtime,l.enddate,l.endtime,r.name as rname,l.mstatus from meeting_list l ";
			$strSQL10 .= " left outer join meeting_room r on r.id = l.room ";
			$strSQL10 .= " where room = '".$_REQUEST["txtName"]."' order by l.strdate ";
		
			$objQuery10 = mysql_query($strSQL10);
		
	?>
<br><img src="img/icon/accept_16.png"> อนุมัติแล้ว | <img src="img/icon/wait_16.png"> รอการอนุมัติ | <img src="img/icon/block_16.png"> ยกเลิกการจอง
<table class="data1">
	<tr class="data1">
		<th class="data1" width="4%">สถานะ</th>
        <th class="data1" width="15%">ห้องประชุม</th>
        <th class="data1" width="21%">วันเวลาที่เริ่ม</th>
        <th class="data1" width="21%">วันเวลาสิ้นสุด</th>
        <th class="data1" width="34%">หัวข้อ</th>
        
    </tr>
    
        <?
        while($objResult10 = mysql_fetch_array($objQuery10))
        { 	
			
		?>
        <tr class="data1">
            <td class="data1" width="4%" align="center">
			<?	if($objResult10["mstatus"]=='N')
			{
				echo "<img src='img/icon/wait.png'>";
			}
			else if($objResult10["mstatus"]=='Y')
			{
				echo "<img src='img/icon/accept.png'>";
			}
			else if($objResult10["mstatus"]=='S')
			{
				echo "<img src='img/icon/block_32.png'>";
			}
				
			?></td>
            <td class="data1" width="15%"><?=$objResult10["rname"];?></td>
            <td class="data1" width="21%"><?=Datethai($objResult10["strdate"]);?> <?=$objResult10["strtime"];?></td>
            <td class="data1" width="21%"><?=Datethai($objResult10["enddate"]);?> <?=$objResult10["endtime"];?></td>
            <td class="data1" width="34%"><?=$objResult10["name"];?></td>
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