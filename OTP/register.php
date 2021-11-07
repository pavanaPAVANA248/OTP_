<?php
   include_once('cofig.php');
	session_start();
	  $message = '';
	   $datetime = new DateTime( "now", new DateTimeZone( "Asia/Kolkata" )); //giving current time
	  $current_time =  $datetime->format( 'Y-m-d h:i:s' );
	  //echo $current_time;
	  //die();
	if(isset($_POST['submit']))
	{
		//echo '<pre>';
		
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['RePassword'];
		$otp = rand(1000,9999);
		
		//$_SESSION['email'] = $email;
		
		$otpmsg = 'Your One Time Verification Code is :'.$otp;
		//echo "INSERT INTO `user`(`username`, `email`, `password`) VALUES ('".$username."','".$email."','".$password."')";
		//die();
		$query  =$conn->query("INSERT INTO `user`(`username`, `email`, `password`) VALUES ('".$username."','".$email."','".$password."')");
		if($query)
		{
			$inserted_id = $conn->lastInsertId();
			$_SESSION['id'] = $inserted_id;
			$to = $email;
			$message = $otpmsg;
			$subject = "OTP Verification Mail";

			// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <webmaster@example.com>' . "\r\n";
				$headers .= 'Cc: myboss@example.com' . "\r\n";


//if using line server you should uncomment line
				//if(mail($to,$subject,$message,$headers)){
					$update = $conn->query("UPDATE user SET otp='".$otp."',is_expire='0',otp_time='".$current_time."' WHERE id='".$inserted_id."' ");
					header("location:verify-otp.php");
					
		//	}
			
			$message = '<div class="alert alert-success">Registrred Successfully</div>';
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
	<!-- adding bootstrap -->
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
<?php echo $message;?>
	<form class="form-register"
		action="register.php" method="POST">
		<div class="form-group">
			<label>username</label>
			<input type="text" class="form-control"
				name="username" id="username"
				aria-describedby="emailHelp"
				placeholder="username" required>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control"
				name="email" id="Email"
				placeholder="Email" required>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control"
				name="password" id="Password"
				placeholder="Password" required>
		</div>
		<div class="form-group">
			<label>Confirm Password</label>
			<input type="password"
				class="form-control" name="RePassword"
				id="RePassword" placeholder="RePassword"
				required>
		</div>

		<button type="submit" name="submit"
			class="btn btn-primary btn-lg">
			Register
		</button>

		
	</form>
</div>
	

</body>

</html>
