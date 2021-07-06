<? session_start();
	if($_SESSION['member_id'] == "")
	{
		header("Location: ../index.php");
				
	}
	if($_SESSION['member_status'] > "1")
	{ 	$chks1 = "<!--";
		$chks2 = "-->";
		$access = "user1";
	}
	else
	{ 	$chks1="";
		$chks2="";
		$access = "admin";
	}
	$dd1 = $_GET["date1"];
            $dd2 = $_GET["date2"];
            $dd3 = $_GET["txtMstatus"];
?>
<? include("f_thaidate.php");?>
<? include("datepick/datepick.php"); ?>
<html>
<head>
<title>Uthong Management</title>
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
</head>

<body>
<div id="header">
	<div class="inHeader2">
    <? if($_SESSION["member_sex"]=='F')
		{ $icon="moswomen";
		}
		else
		{ $icon="mosman";
		}
    ?>
		<div class="<?=$icon;?>">
		ยินดีต้อนรับ<br>
		<a href="">คุณ <?=$_SESSION["member_fname"];?> <?=$_SESSION["member_lname"];?> </a>
		</div>
	<div class="clear"></div>
	</div>
</div>

<div id="wrapper2">
	<div id="leftBar">
	<ul>
    	<li><a href="maintenance.php?date1=<?=$dd1;?>&date2=<?=$dd2;?>&txtMstatus=<?=$dd3;?>">ย้อนกลับ</a></li>
		<li><a href="../home.php">กลับหน้าหลัก</a></li>
		
		<li><a href="../logout.php">ออกจากระบบ</a></li>
	</ul>
	</div>
	<div id="rightContent2">

        
        <!-- per page -->
      <? include("../connectdb.php");
	  		$strSQL = "select md.id,md.date as m_date,d.name as m_dep,md.status as m_status,md.group_dep as m_gdep,md.department as m_dep, 
						concat(m1.member_fname,' ',m1.member_lname)as fullname1,g.name as g_name,d.name as d_name,md.member_id as m_member_id,
						concat(m2.member_fname,' ',m2.member_lname)as fullname2,md.repairman as m_repairman_id,md.ploblem,s.name as s_name   
						from maintenance_detail md
						left outer join group_dep g on g.id = md.group_dep
						left outer join department d on d.id = md.department
						left outer join member m1 on m1.member_id = md.member_id
						left outer join member m2 on m2.member_id = md.repairman 
						left outer join maintenance_status s on s.id = md.status ";
			$strSQL .= " where md.id = '".$_GET["id"]."' ";
			$objQuery = mysql_query($strSQL);
			$objResult = mysql_fetch_array($objQuery)
			
			
	  	
	  ?>
      
      <div id="bigRight">
        <h3> <img src="img/icon/config_32.png"> แก้ไขรายการส่งซ่อมที่ <?=$_GET["id"];?> </h3>
       
	  <table style="border: none;font-size: 14px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<form action="edit_maintenance_save.php" method="post" name="edit_maintenance">
            	<input type="hidden" name="txtId" value="<?=$_GET["id"];?>">
            	
            <tr>
            	<td style="border: none;padding: 5px; font-size: 14px;" width="20%" align="center">วันที่ </td>
                <td style="border: none;padding: 5px; font-size: 14px;" width="80%"> 
                <input type="text" id="datepicker-th-3" name="date3" value="<?=$objResult["m_date"];?>"> 
                </td>
            </tr>
            <tr>
            	<td style="border: none;padding: 5px; font-size: 14px;" width="8%" align="center">ฝ่าย </td>
                <td style="border: none;padding: 5px; font-size: 14px;" width="92%">
				<? 
					$strSQL1 = "select * from group_dep where status = 'y' ";
					$objQuery1 = mysql_query($strSQL1) or die ("Error Query [".$strSQL1."]");
				 ?>
                 		<select name="txtGdep" >
						<option value='<?=$objResult["m_gdep"];?>'><?=$objResult["g_name"];?></option>
                    <?
						while($objResult1 = mysql_fetch_array($objQuery1))
						{	
					?>
						<option value='<?=$objResult1["id"];?>'><?=$objResult1["name"];?></option>
				  <? }
                  ?>
						</select> 
                  </td>
            </tr>
            <tr>
                <td style="border: none;padding: 5px; font-size: 14px;" width="8%" align="center">หน่วยงาน </td>
                <td style="border: none;padding: 5px; font-size: 14px;" width="92%">
                <? 
					$strSQL2 = "select * from department where status = 'y' ";
					$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
					?>
                    <select name="txtDep" >
					<option value='<?=$objResult["m_dep"];?>'><?=$objResult["d_name"];?></option>
                    <?
					while($objResult2 = mysql_fetch_array($objQuery2))
					{	
					?>
					<option value='<?=$objResult2["id"];?>'><?=$objResult2["name"];?></option>
					<? }
                    ?>
					</select>
                </td>
              	
            </tr>
            
            <tr>
                <td style="border: none;padding: 5px; font-size: 14px;" width="8%" align="center">ผู้แจ้ง </td>
                <td style="border: none;padding: 5px; font-size: 14px;" width="92%">
                <? 
				$strSQL3 = "select *,concat(member_fname,' ',member_lname)as fullname from member ";
				$objQuery3 = mysql_query($strSQL3) or die ("Error Query [".$strSQL3."]");
				?>
                 <select name="txtMember1" >
				 <option value='<?=$objResult["m_member_id"];?>'><?=$objResult["fullname1"];?></option>
                 <?
				while($objResult3 = mysql_fetch_array($objQuery3))
				{	
				?>
				<option value='<?=$objResult3["member_id"];?>'><?=$objResult3["fullname"];?></option>
				<? }
                 ?>
				</select>
                </td>
             </tr>
             
             <tr>
                <td style="border: none;padding: 5px; font-size: 14px;" width="8%" align="center">ปัญหา </td>
                <td style="border: none;padding: 5px; font-size: 14px;" width="92%">
                <textarea name="txtPloblem" rows="2"><?=$objResult["ploblem"];?></textarea>
                </td>
             </tr>
             
             <tr>
                <td style="border: none;padding: 5px; font-size: 14px;" width="8%" align="center">ผู้รับซ่อม </td>
                <td style="border: none;padding: 5px; font-size: 14px;" width="92%">
                <? 
				$strSQL4 = "select * from member where department='11' ";
				$objQuery4 = mysql_query($strSQL4) or die ("Error Query [".$strSQL4."]");
				?>
                <select name="txtRepairman" >
				<option value='<?=$objResult["m_repairman_id"];?>'><?=$objResult["fullname2"];?></option>
                <?
				while($objResult4 = mysql_fetch_array($objQuery4))
				{	
				?>
				<option value='<?=$objResult4["member_id"];?>'><?=$objResult4["member_fname"];?> <?=$objResult4["member_lname"];?></option>
				<? }
                ?>
				</select>
                </td>
             </tr>
             
             <tr>
                <td style="border: none;padding: 5px; font-size: 14px;" width="8%" align="center">สถานะ </td>
                <td style="border: none;padding: 5px; font-size: 14px;" width="92%">
                <? 
				$strSQL5 = "select * from maintenance_status ";
				$objQuery5 = mysql_query($strSQL5) or die ("Error Query [".$strSQL5."]");
				?>
                <select name="txtStatus" >
				<option value='<?=$objResult["m_status"];?>'><?=$objResult["s_name"];?></option>
                <?
				while($objResult5 = mysql_fetch_array($objQuery5))
				{	
				?>
				<option value='<?=$objResult5["id"];?>'><?=$objResult5["name"];?></option>
				<? }
                ?>
				</select>
                </td>
             </tr>
             
             <tr>
                <td style="border: none;padding: 5px; font-size: 14px;" width="8%" align="center"></td>
                <td style="border: none;padding: 5px; font-size: 14px;" width="92%">
                <input type="submit" class="button" value="ตกลง">
                </td>
             </tr>
           </form>
           
		</table>
		</div>
      

        <div class="clear"></div>
       
<?
mysql_close($objConnect);
?>
        
		</div>
	<div class="clear"></div>
<div id="footer2">
	&copy; 2012 MOS css template | <a href="">Chronic disease</a> | พัฒนา Code PHP & MySQL โดย <a href="">นายณัฐวุฒิ วงษ์แพทย์</a><br>
	ฝ่าย <a href="">ยุทธศาสตร์และสารสนเทศ</a> | โรงพยาบาล <a href="">อู่ทอง จ.สุพรรณบุรี</a>
</div>
</div>
</body>
</html>