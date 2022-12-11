<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ConectYu-Otp Verification</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>	
	<link href="https://fonts.googleapis.com/css?family=Shrikhand&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">	<!-- Tagline -->
	<link href="https://fonts.googleapis.com/css?family=Francois+One&display=swap" rel="stylesheet"> <!-- h2 -->
</head>
<style>
body{
	overflow-x:hidden;
}
#logo{
	font-family:'Shrikhand', cursive;
	font-size: 1.75em; 
	letter-spacing: 0px;  
	text-shadow: 1px 1px 2px #c4c4c4;
	text-align:center;
}
#heading{
	font-family: 'Roboto Slab', serif;
}
#col3{
	background-color:#fffc00;
	padding-top:8px;
	padding-bottom:3px;
}
.main-content{
	width:90%;
	height:100%;
	margin:1px auto;
	border-color:#fff;
	padding:5px 5px;	
}
.input-group{
	width:100%;
}
#head{
	font-size:2em;
	text-align:center;
	font-family: 'Francois One', sans-serif;

}
#continue{
	width:90%;	
	background-color:#fffc00;
	font-family: 'Roboto Slab', serif;
}
#otpresendlink{
	font-size:1.2em;
	text-align:center;
}
#error{
	width:100%;
}
</style>
<body>
	<div class="row">
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
		<div class="col-sm-4 col-lg-4 col-xs-12">
			<div class="row">
				<div class="col-sm-12" id="col3">
					<h1 href="" id="logo">Ask ConectYu</h1>
				</div>
			</div>
			<div class="row">
				<div class="main-content">
					<div class="l-part">
							<center><h3 id="head">Verify that`s you</h3></center>
							<h4 id="heading">Enter the One Time Password which has been sent to your email here.</h4><br>
							<div class='alert alert-danger' id="invalidotp" style="display:none;">
								<strong>Invalid OTP.Please enter a valid OTP!</strong>
							</div>
							<div class='alert alert-success' id="otpsentagain" style="display:none;">
								<strong>OTP sent successfully!</strong>
							</div>
						<div id="otpcode">
							<form action="" method="post">
								<div class="input-group">
									<input type="number" name="otp" class="form-control" id="otp" placeholder="Enter the OTP here" style="border-radius:5px;" required="required" />
								</div><br><br>
								<center><button id="continue" class="btn btn-lg" name="continue" data-toggle="tooltip" title="Continue to the next step.">
								Continue</button></center><br>
								<p id="otpresendlink">Didn`t got a code? 
								<a style="text-decoration:none; color:#187AB;cursor:pointer" data-toggle="tooltip" title="Resend OTP" onclick="resendotp();">Click here</a>
								</p><br><br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
	</div>
</body>
</html>
<script type="text/javascript">
	//Resend OTP
	function resendotp(){
		$.ajax({
			url:'otp.php',
			data:'resendotp=1',
			type:'post',
			async:true,
			success:function(res){
				var pinError=document.getElementById('invalidotp');
				pinError.setAttribute('style', 'display:none;');
				var otpsent=document.getElementById('otpsentagain');
				otpsent.setAttribute('style', 'display:display;');
			}
		});
	}
</script>
<?php
include("includes/connection.php");
if(isset($_POST['continue'])){
	global $con;
	$otp=htmlentities(mysqli_real_escape_string($con,$_POST['otp']));
	/*$sentotp=$_SESSION['otpcode'];
	if($otp == $sentotp){
		unset($_SESSION['otpcode']);
		if(isset($_GET['user'])){	
			$user=$_GET['user'];
		}*/
			$user_name=$_SESSION['user_name'];
			$user_email=$_SESSION['user_email'];
			$user_pass=$_SESSION['user_pass'];
			$user_dob=$_SESSION['user_dob'];
			$user_gender=$_SESSION['user_gender'];
			$user_country=$_SESSION['user_country'];
			$default_prfpic=$_SESSION['default_prfpic'];
			$default_coverpic="images/prfpics/coverpic.jpg";
			$tagline="I`m new to Ask ConectYu!";
			
			while(1){
				$user_id=rand(111111111111111,999999999999999);
				$check_userid=mysqli_query($con,"select user_id from users where user_id='$user_id'");
				$num_rows=mysqli_num_rows($check_userid);
				if($num_rows==0){
					break;
				}
			}
			$_SESSION['uid']=$user_id;
			$insert_user=mysqli_query($con,"insert into users(user_id,user_name,user_email,user_pass,user_dob,user_gender,user_country,tagline,profile_pic,cover_pic,reg_date) values('$user_id','$user_name','$user_email','$user_pass','$user_dob','$user_gender','$user_country','$tagline','$default_prfpic','$default_coverpic',NOW())");
			if($insert_user){
				echo "<script>window.open('home.php?user_id=$user_id','_self');</script>";
			}
				
			/*	//setting up general settings
				$insert_gnrsetgs=mysqli_query($con,"insert into general_settings(user_id,data_usage,contacts_sync,language,updated_date) values('$user_id','Off','Off','english',NOW())");
				
				//setting up privacy settings
				$insert_prvsetgs=mysqli_query($con,"insert into privacy_settings(user_id,account_privacy,comment_selection,activity_status,updated_date) values('$user_id','public','everyone','everyone',NOW())");
				
				//setting up security settings
				$insert_securitysetgs=mysqli_query($con,"insert into security_settings(user_id,mobile_privacy,twostep_verf,verify_with,updated_date) values('$user_id','Yes','Off','none',NOW())");
				
				//setting up notification settings
				$insert_notifysetgs=mysqli_query($con,"insert into pushnotifys(user_id,pauseall,likes,comments,messages,followers,following,jobs,internships,events,updated_date) values('$user_id','off','on','on','on','on','off','on','on','on',NOW())");
				
				if(!isset($_SESSION['opennewtab'])){
					echo "<script>window.open('home.php?user_id=$user_id','_self');</script>";
				}else{
					$get_userdetails=mysqli_query($con,"select * from users where user_id='$user_id'");
					$row_userdetails=mysqli_fetch_array($get_userdetails);
					$user_desg=$row_userdetails['user_designation'];
					
					if($_SESSION['opennewtab']=="openjobs"){
						echo "<script>window.open('jobs.php?user_desg=$user_desg&user_id=$uid','_self');</script>";
						unset($_SESSION['opennewtab']);
					}elseif($_SESSION['opennewtab']=="openinterns"){
						echo "<script>window.open('internships.php?user_desg=$user_desg&user_id=$uid','_self');</script>";
						unset($_SESSION['opennewtab']);
					}elseif($_SESSION['opennewtab']=="openpatents"){
						echo "<script>window.open('applypatents.php?user_id=$uid','_self');</script>";
						unset($_SESSION['opennewtab']);
					}elseif($_SESSION['opennewtab']=="openreports"){
						echo "<script>window.open('report.php','_self');</script>";
						unset($_SESSION['opennewtab']);
					}
				}
			}else{
				echo "<script>alert('An error occurred.Try again!');</script>";
				
			}*/
	/*}else{
		echo "
			<script type='text/javascript'>
				var pinError=document.getElementById('invalidotp');
				pinError.setAttribute('style', 'display:display;');
			</script>
		";
		exit();
	}*/
}

//resending Otp
if(isset($_POST['resendotp'])){
	//sending OTP (One Time Password!)
		$to=$_SESSION['user_email'];
		$sub="Welcome ".$_SESSION['first_name']."!";
		$otp=rand(100000,999999);
		$_SESSION['otpcode']=$otp;
		$body="Your OTP (One Time Password) for verifying your ConectYu account is $otp.";
		$headers="From: ConectYu noreply@conectyu.com";
		if(mail($to,$sub,$body,$headers)){
			echo "<script>window.open('otp.php?user=$indv','_self');</script>";
		}else{
			echo "<script>window.open('signup.php','_self');</script>";
		}
}
?>