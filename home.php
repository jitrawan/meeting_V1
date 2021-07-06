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
    <div class="quoteOfDay">
	<b>ยินดีต้อนรับเข้าสู่</b><br>
	<marquee><i style="color: #5b5b5b;">" ระบบจองห้องประชุมออนไลน์ "</i></marquee>
	</div>
    	
        		
	  <div class="clear"></div>
        
        <!-- per page -->
    <? include("connectdb.php");
		include("menu_center.php");
		$dd = date("Y-m-d");
		$tt = date("H:i:s");
				
	?>
    
    <div id="box500"><h3> <img src="img/icon/16/star.png"> สวัดดีครับ คุณ <a href="#"><?=$_SESSION["member_name"];?></a></h3>
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr>
                <td style="border: none;padding: 4px;" width="7%"><img src="img/icon/calendar_empty_32.png"></td>
                <td style="border: none;padding: 4px;" width="93%"><b>วันนี้วันที่ <?=DateThai($dd);?></b></td>
            </tr>
			<tr>
                <td style="border: none;padding: 4px;" width="7%"><img src="img/icon/clock_32.png"></td>
                <td style="border: none;padding: 4px;" width="93%"><b>เวลา <?=$tt;?></b></td>
            </tr>
		</table>
		</div>



    <div class="clear"></div>
       
        
</div>
	<div class="clear"></div>
<div id="footer">
<? include("footer.php");?>
</div>
</div>
</body>
</html>