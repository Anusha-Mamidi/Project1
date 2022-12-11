<?php
session_start();
include("includes/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ask-Signin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Shrikhand&display=swap" rel="stylesheet">
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
.main-content{
		width:90%;
		height:100%;
		margin:1px auto;
		border-color:#fff;
		padding:5px 5px;
	/*	border:5px solid #e6e6e6; */
		margin-top:0px;
}

#signin{
	width:90%;	
	background-color:#fffc00;
	font-family: 'Roboto Slab', serif;
}
#signinlink{
	font-size:1.2em;
	text-align:center;
}
.overlap-text{
		position:relative;
	}
.overlap-text a{
	position:absolute;
	top:7px;
	right:10px;
	font-size:14px;
	text-decoration:none;
	font-family:'Overpass Mono',monospace;
	letter-spacing:-1;
	z-index:3;
}
#fpass{
	font-size:1em;
}
#col3{
	background-color:#fffc00;
	padding-top:8px;
	padding-bottom:3px;
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
				<div class="main-content col-xs-12">
					<div class="l-part">
						<form method="post" action="">
							<h4 id="heading">Signin to explore!</h4><br>
							<div class='alert alert-danger' id="NotValid" style="display:none;">
								<strong>Invalid email or Password!</strong>
							</div>
							<div class="input-group">
								<input type="email" name="u_email" id="u_email" class="form-control" style="border-radius:5px;" placeholder="Enter your email" required="required"
								value="<?php echo isset($_POST["u_email"]) ? htmlentities($_POST["u_email"]) : ''; ?>" />
							</div><br>
							<div class="input-group overlap-text">
								<input type="password" name="u_pass" id="u_pass" placeholder="Enter your Password" required="required" class="form-control input-md" style="border-radius:5px;" />
								<a style="text-decoration:none;float:right;color:#187FAB;cursor:pointer;" id="showpass" data-toggle="tooltip"title="Show Password">show</a>
								<a style="text-decoration:none;float:right;color:#187FAB;display:none;cursor:pointer;" id="hidepass" data-toggle="tooltip"title="hide Password">hide</a>
							</div><br>
							<!-- Forgot password --><a href="forgot_password.php" style="text-decoration:none;float:right;color:#187FAB;" 							id="fpass" data-toggle="tooltip"title="Reset Password">Forgot pasword?</a><br><br>
							<center><button id="signin" class="btn btn-lg" name="sign_in" data-toggle="tooltip" title="Signin">Signin</button></center><br>
							<p id="signinlink">Didn`t have an account? 
							<a href="signup.php" style="text-decoration:none; color:#187AB;" data-toggle="tooltip" title="Signup">Signup</a></p><br><br>
						</form>						
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
	</div>
</body>
</html>
<script type="text/javascript">
$("#showpass").click(function(){
	var pswrd=document.getElementById("u_pass");
	pswrd.setAttribute('type','text');
	var spass=document.getElementById("showpass");
	spass.setAttribute('style','display:none');
	var hpass=document.getElementById("hidepass");
	hpass.setAttribute('style','display:display');
	hpass.setAttribute('style','cursor:pointer;');
});
$("#hidepass").click(function(){
	var pswrd=document.getElementById("u_pass");
	pswrd.setAttribute('type','password');
	var spass=document.getElementById("showpass");
	spass.setAttribute('style','display:display');
	spass.setAttribute('style','cursor:pointer');
	var hpass=document.getElementById("hidepass");
	hpass.setAttribute('style','display:none');
});
</script>
<?php
//signing into the account
if(isset($_POST['sign_in'])){
	global $con;
	$u_email=htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
	$u_pass=htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
	$u_pass=md5($u_pass);
	$select_user = "select * from users where user_email='$u_email' AND user_pass='$u_pass'";
	$run_user = mysqli_query($con,$select_user);
	$row_user=mysqli_fetch_array($run_user);
	$check_user=mysqli_num_rows($run_user);
	if($check_user==1 and $row_user['user_pass']==$u_pass){
		$_SESSION['user_email']=$u_email;
		$select_uid = "select user_id from users where user_email='$u_email'";
		$run_uid=mysqli_query($con,$select_uid);
		$row_uid=mysqli_fetch_array($run_uid);
		$uid=$row_uid['user_id'];
		$_SESSION['uid']=$uid;
		setcookie("sessionuid",$uid,time() +3600*24*30);
		//$changestatus=mysqli_query($con,"update users set status='active' where user_id='$uid'");
		while(true){
			$sessionid=rand(111111111111111,999999999999999);
			$checksid=mysqli_query($con,"select * from user_sessions where sessionid='$sessionid'");
			$numsid=mysqli_num_rows($checksid);
			if($numsid==0){
				$_SESSION['sid']=$sessionid;
				$startsession=mysqli_query($con,"insert into user_sessions(sessionid,user_id,start_time,end_time) values('$sessionid','$uid',NOW(),'')");
				break;
			}
		}
		echo "<script>window.open('home.php?user_id=$uid','_self');</script>";	
		//check two-step verification
		/*$check_tverf=mysqli_query($con,"select * from security_settings where user_id='$uid'");
		$row_verf=mysqli_fetch_array($check_tverf);
		$tverf=$row_verf['twostep_verf'];
		if($tverf!="On"){
			if(!isset($_SESSION['opennewtab'])){
				echo "<script>window.open('home.php?user_id=$uid','_self');</script>";	
			}elseif(isset($_SESSION['opennewtab'])){
				$get_userdetails=mysqli_query($con,"select * from users where user_id='$uid'");
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
			echo "<script>window.open('twostepverification.php','_self');</script>";
		}*/
	}else{
		echo "
			<script type='text/javascript'>
				document.getElementById('u_email').value='$u_email';
				var Error=document.getElementById('NotValid');
				Error.setAttribute('style','display:display;');
			</script>
		";
		exit();
	}
}
?>