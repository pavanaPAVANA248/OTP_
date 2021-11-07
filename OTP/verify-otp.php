<?php

 include_once('cofig.php');
	session_start();
	  $message = '';
	  if(isset($_POST['verify_otp']))
	{
		$otp_val = $_POST['otp'];
		//echo "SELECT * FROM user WHERE otp='".$otp_val."' AND id = '".$_SESSION['id']."' AND is_expire!='1' AND  NOW() <= DATE_ADD(otp_time, INTERVAL 2 MINUTE)"; die();
		$check_sql = $conn->query("SELECT * FROM user WHERE otp='".$otp_val."' AND id = '".$_SESSION['id']."' AND is_expire!='1' AND  NOW() <= DATE_ADD(otp_time, INTERVAL 2 MINUTE)");
		$row_count = $check_sql->rowCount();
		//echo $row_count;SELECT NOW();
		//die();
		if($row_count > 0){
			
			$update_otp = $conn->query("UPDATE user SET is_expire='1' WHERE id ='".$_SESSION['id']."'");
			$message = '<div class="alert alert-success">OTP Verification Successfully.</div>';
		}else{
			//die("hii");
			//$update_otp = $conn->query("UPDATE user SET is_expire='1' WHERE id ='".$_SESSION['id']."'");
			$message = '<div class="alert alert-danger">OTP Verification failed.</div>';
			
		}
		
	}


?>
<!DOCTYPE html>
<html lang="en">
	
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css"
		href="css/style.css" media="screen" />

	<!-- Adding bootstrap -->
	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity=
"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity=
"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous">
	</script>
	
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity=
"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous">
	</script>
	
	<script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity=
"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous">
	</script>
	
	<div class="nav-bar">
		<div class="title">
			<h3>welcome to my website</h3>
		</div>
	</div>
</head>

<body>
<div class="container">
<?php echo $message; ?>
	<form class="form-login" method="POST">
		<div class="form-group">
			<input type="text" class="form-control"
				name="otp" id="OTP"
				aria-describedby="emailHelp"
				placeholder="Enter OTP" required>
		</div>

		<button type="submit" name="verify_otp"
			class="btn btn-primary btn-lg"
			id="verify-otp">
			verify otp
		</button>
	</form>
</div>

</body>

</html>
