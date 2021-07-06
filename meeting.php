<? session_start();
	/*if($_SESSION['member_id'] == "")
	{
		header("Location: index.php");
				
	}*/
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
	<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax() {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
			var url = 'data_post.php';
			var pmeters = "myRoom=" + encodeURI( document.getElementById("txtRoom").value) +
"&myDate1=" + encodeURI( document.getElementById("datepicker-th-1").value ) +
"&myDate2=" + encodeURI( document.getElementById("datepicker-th-2").value ) +
"&myHour1=" + encodeURI( document.getElementById("hour1").value ) +
"&myHour2=" + encodeURI( document.getElementById("hour2").value ) +
"&myMin1=" + encodeURI( document.getElementById("min1").value ) +
"&myMin2=" + encodeURI( document.getElementById("min2").value ) ;
			
			//var pmeters = 'myName='+document.getElementById("txtName").value+'&my2='; // 2 Parameters
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}

			/*
			HttPRequest.onreadystatechange = call function .... // Call other function
			*/

	   }
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
    <h3><img src="img/icon/conference.png"></h3>
    	
        		
		<div class="clear"></div>
        
        <!-- per page -->
      <? include("connectdb.php");
	  	$today = date("Y-m-d");
	  ?>

<!-- ui-dialog -->
<a href="#input-box" class="button1">จองห้องประชุม</a>

<div id="input-box" class="login-popup">
        <a href="#" class="close"><img src="img/icon/delete.png" class="btn_close" title="ปิดหน้าต่างนี้" alt="Close" /></a>
        <form method="post" action="add_meeting_list.php" id="add_meeting">
        <table style="border: none; font-size:12px; color: #5b5b5b;width: 550px;margin: 0px 0 0 0;">
        	<tr>
            	<td width="15%">วันที่จอง</td>
            	<td width="25%">
                <input type="text" id="datepicker-th-1" name="date1" value="<?=$today;?>">  </td>
                <td width="11%">เวลา</td>
            	<td width="50%">
                <select name="hour1" id="hour1">
                <option value="00"> 00 </option>
                <option value="01"> 01 </option>
                <option value="02"> 02 </option>
                <option value="03"> 03 </option>
                <option value="04"> 04 </option>
                <option value="05"> 05 </option>
                <option value="06"> 06 </option>
                <option value="07"> 07 </option>
                <option value="08"> 08 </option>
                <option value="09"> 09 </option>
                <? for($hour1=10;$hour1<24;$hour1++)
				{
				?>
                <option value="<?=$hour1;?>"> <?=$hour1;?> </option>
                <?
				}
                ?>
                :
                </select> :
                <select name="min1" id="min1">
                <option value="00"> 00 </option>
                <option value="01"> 01 </option>
                <option value="02"> 02 </option>
                <option value="03"> 03 </option>
                <option value="04"> 04 </option>
                <option value="05"> 05 </option>
                <option value="06"> 06 </option>
                <option value="07"> 07 </option>
                <option value="08"> 08 </option>
                <option value="09"> 09 </option>
                <? for($min1=10;$min1<60;$min1++)
				{
				?>
                <option value="<?=$min1;?>"> <?=$min1;?> </option>
                <?
				}
                ?>
                </select> น.
                </td>
                
            </tr>
            
            <tr>
            	<td width="15%">ถึงวันที่</td>
            	<td width="25%">
                <input type="text" id="datepicker-th-2" name="date2" value="<?=$today;?>">  </td>
                <td width="10%">เวลา</td>
            	<td width="50%">
                <select name="hour2" id="hour2">
                <option value="00"> 00 </option>
                <option value="01"> 01 </option>
                <option value="02"> 02 </option>
                <option value="03"> 03 </option>
                <option value="04"> 04 </option>
                <option value="05"> 05 </option>
                <option value="06"> 06 </option>
                <option value="07"> 07 </option>
                <option value="08"> 08 </option>
                <option value="09"> 09 </option>
                <? for($hour2=10;$hour2<24;$hour2++)
				{
				?>
                <option value="<?=$hour2;?>"> <?=$hour2;?> </option>
                <?
				}
                ?>
                </select> :
                <select name="min2" id="min2">
                <option value="00"> 00 </option>
                <option value="01"> 01 </option>
                <option value="02"> 02 </option>
                <option value="03"> 03 </option>
                <option value="04"> 04 </option>
                <option value="05"> 05 </option>
                <option value="06"> 06 </option>
                <option value="07"> 07 </option>
                <option value="08"> 08 </option>
                <option value="09"> 09 </option>
                <? for($min2=10;$min2<60;$min2++)
				{
				?>
                <option value="<?=$min2;?>"> <?=$min2;?> </option>
                <?
				}
                ?>
                </select> น.
                </td>
            </tr>
            
           
            <tr>
            	<td width="15%">ห้องประชุม</td>
            	<td width="25%">
                <? 
					$strSQL2 = "select * from meeting_room";
					$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
				?>
                    <select name="txtRoom" id="txtRoom" >
					<?
					while($objResult2 = mysql_fetch_array($objQuery2))
					{	
					?>
					<option value='<?=$objResult2["id"];?>'><?=$objResult2["name"];?></option>
					<? 
					}
                    ?>
					</select>
                </td>
                <td width="10%">เพื่อใช้</td>
            	<td width="50%">
                <? 
					$strSQL3 = "select * from meeting_room_type";
					$objQuery3 = mysql_query($strSQL3) or die ("Error Query [".$strSQL3."]");
				?>
                    <select name="txtRoomtype" >
					
                    <?
					while($objResult3 = mysql_fetch_array($objQuery3))
					{	
					?>
					<option value='<?=$objResult3["id"];?>'><?=$objResult3["name"];?></option>
					<? }
                    ?>
					</select>
                </td>
           </tr>
           <tr>
           		<td width="15%"><input type="button" class="button" value="ตรวจสอบ" onClick="JavaScript:doCallAjax();"> </td>
            	<td width="25%"><strong><span id="mySpan" style="color:#FF3333">คลิ๊กเพื่อตรวจสอบห้องประชุมก่อนนะครับ</span></strong></td>
                <td width="10%"></td>
                <td width="50%"></td>
           </tr>
           <tr>
           		<td width="15%">หัวข้อเรื่อง</td>
            	<td width="25%"><input type="text" class="panjang" name="txtName"> </td>
                <td width="10%">จำนวน </td>
                <td width="50%"><input type="text" class="pendek" name="txtQty"> คน</td>
           </tr>
       </table>
       <table style="border: none; font-size:12px; color: #5b5b5b;width: 550px;margin: 0px 0 0 0;">
           <tr>
           		<td width="15%">ดำเนินการ</td>
            	<td width="85%">
                <input name="rdoConduct" type="radio" value="Y" checked> ผู้จัดรับผิดชอบดำเนินการเอง
                </td>
                
           </tr>
           <tr>
           		<td width="15%"></td>
            	<td width="85%">
                
                <input name="rdoConduct" type="radio" value="N"> ประสงค์ให้งานธุรการดำเนินการดังนี้
                </td>
                
           </tr>
           <tr>
           		<td width="15%"></td>
            	<td width="85%">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="cbConduct1" type="checkbox" value="Y"> จัดสถานที่ประชุม <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="cbConduct2" type="checkbox" value="Y"> จัดเครื่องดื่ม(น้ำเปล่า) จำนวน 
                <select name="txtQtyconduct2">
                   		<option value=""> กรุณาเลือก </option> 
                        <option value="1"> 1 รอบเบรค </option> 
                        <option value="2"> 2 รอบเบรค </option> 
                        <option value="3"> 3 รอบเบรค </option> 
                   </select>
                <br><br>
               	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="cbConduct3" type="checkbox" value="Y"> จัดเครื่องดื่มพร้อมอาหารว่าง จำนวน 
                   <select name="txtQtyconduct3">
                   		<option value=""> กรุณาเลือก </option> 
                        <option value="1"> 1 รอบเบรค </option> 
                        <option value="2"> 2 รอบเบรค </option> 
                        <option value="3"> 3 รอบเบรค </option> 
                   </select>
                </td>
           </tr>    
           <tr>	
           		<td width="15%">งบประมาณ</td>
            	<td width="85%">
                <input name="rdoBudget" type="radio" value="1" checked> เงินบำรุงของบริษัท 
                </td>
           </tr>
           <tr>	
           		<td width="15%"></td>
            	<td width="85%">
                <input name="rdoBudget" type="radio" value="2"> เงินสนับสนุน/โครงการของผู้จัด 
                </td>
           </tr>
           <tr>	
           		<td width="15%"></td>
            	<td width="85%">
                
                <input name="rdoBudget" type="radio" value="3"> ไม่เสียงบประมาณ(ประชุมภายในบริษัท ขอเฉพาะน้ำดื่ม) 
                </td>
           </tr> 
        </table>
       <center><label style="font-size:11px;"><a href="#">กรุณาลงทะเบียนขอใช้ห้องประชุมล่วงหน้าก่อนประมาณ 3 วัน เพื่อความสะดวกในการจัดเตรียมห้องประชุม<br>
       กรณีมีเหตุจำเป็นที่ต้องใช้ห้องประชุมเร่งด่วน ทางงานธุรการจะแจ้งให้ทราบล่วงหน้า</a></label></center>
        <input type="submit" class="button" value="ตกลง">
        </form>
</div>


<!-- end ui dialog -->

<div class="input-data-star">รายการที่คุณจองห้องประชุม</div>     
	<? 	$strSQL10 = "select l.id,l.name,l.strdate,l.strtime,l.enddate,l.endtime,r.name as rname,l.mstatus from meeting_list l ";
		$strSQL10 .= " left outer join meeting_room r on r.id = l.room ";
		$strSQL10 .= " where l.user = '".$_SESSION["member_id"]."'";
		
		$objQuery10 = mysql_query($strSQL10) or die ("Error Query [".$strSQL10."]");
		//$objResult10 = mysql_fetch_array($objQuery10) 
	?>
<br><img src="img/icon/accept_16.png"> อนุมัติแล้ว | <img src="img/icon/wait_16.png"> รอการอนุมัติ | <img src="img/icon/block_16.png"> ยกเลิกการจอง
<table class="data1">
	<tr class="data1">
		<th class="data1" width="4%">สถานะ</th>
        <th class="data1" width="15%">ห้องประชุม</th>
        <th class="data1" width="21%">วันเวลาที่เริ่ม</th>
        <th class="data1" width="21%">วันเวลาสิ้นสุด</th>
        <th class="data1" width="34%">หัวข้อการขอจองห้องประชุม</th>
        
    </tr>
    
        <?
        while($objResult10 = mysql_fetch_array($objQuery10))
        { 	
			$i++;
		?>
        <tr class="data1">
            <td class="data1" width="4%" align="center"><a href="user_change_status.php?status=<?=$objResult10["mstatus"];?>&&id=<?=$objResult10["id"];?>">
			<?	if($objResult10["mstatus"]=='Y')
			{
				echo "<img src='img/icon/accept.png'>";
			}
			else if($objResult10["mstatus"]=='N')
			{
				echo "<img src='img/icon/wait.png'>";
			}
			else if($objResult10["mstatus"]=='S')
			{
				echo "<img src='img/icon/block_32.png'>";
			}
            ?>
            </a></td>
            <td class="data1" width="15%"><?=$objResult10["rname"];?></td>
            <td class="data1" width="21%"><?=Datethai($objResult10["strdate"]);?> <?=$objResult10["strtime"];?></td>
            <td class="data1" width="21%"><?=Datethai($objResult10["enddate"]);?> <?=$objResult10["endtime"];?></td>
            <td class="data1" width="34%"><?=$objResult10["name"];?></td>
        </tr>
        <? 
		}
        ?>
	
</table>

<label style="color:#3366FF">สามารถคลิ๊กที่ icon สถานะเพื่อยกเลิกการจองได้นะครับ</label>  

    <div class="clear"></div>
       
        
</div>
	<div class="clear"></div>
<div id="footer">
<? include("footer.php");?>
</div>
</div>
</body>
</html>