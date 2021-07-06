<?
ob_start();
session_start();
?>
<html>
<head>
<title>Reservations Meeting</title>
<!-- <meta HTTP-EQUIV="Refresh" CONTENT="1;URL=index.php" charset="utf-8"> -->
<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
	<div class="inHeaderLogin"></div>
</div>
<div id="errorForm">
		<div class="informasi" align="center">
			
<?
	include("connectdb.php");

	$m_username = mysqli_real_escape_string($condb,$_POST['txtUsername']);
    $m_password = mysqli_real_escape_string($condb,$_POST['txtPassword']);
	$strSQL = "SELECT * FROM member WHERE username = '".trim($m_username)."' 
	and password = '".trim($m_password)."'";
	$objQuery = mysqli_query($condb,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
			echo "Username หรือ Password ไม่ถูกต้อง!";

			
	}
	else
	{

			$_SESSION["member_id"] = $objResult["id"];
			$_SESSION["member_user"] = $objResult["username"];
			$_SESSION["member_pass"] = $objResult["password"];
			$_SESSION["member_name"] = $objResult["name"];
			$_SESSION["member_status"] = $objResult["status"];		
			$_SESSION["member_active"] = $objResult["active"];

			session_write_close();

			header("location:home.php");

	}
	mysqli_close();
?>
		</div>
</div>
</body>
</html>