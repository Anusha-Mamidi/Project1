<?php
session_start();
include("includes/connection.php");
?>
<?php
	$u_id=$_SESSION['uid'];
	$get_user=mysqli_query($con,"select * from users where user_id='$u_id'");
	$row_user=mysqli_fetch_array($get_user);
	$prfpic=$row_user['profile_pic'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ask-Post</title>
	<meta charset="utf-8">
	<meta name="viewport" content="user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta http-equiv='refresh' content='; URL=http://localhost/askconectyu/home.php?user_id=<?php echo $user_id; ?>'>
	<script src="https://kit.fontawesome.com/6d15a9d73e.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
	<link href="https://fonts.googleapis.com/css?family=Shrikhand&display=swap" rel="stylesheet">
</head>
<style>
body{
	overflow-x:hidden;
}
#logo{
	font-family:'Shrikhand', cursive;
	font-size: 1.25em; 
	letter-spacing: 0px;  
	text-shadow: 1px 1px 2px #c4c4c4;
	margin-left:10%;
	float:left;
}
#heading{
	font-family: 'Roboto Slab', serif;
}
#col3{
	background-color:#fffc00;
}
#navlist{
	list-style-type:none;
}
#navlist li a{
	float:left;
	color:#626663;
	display:block;
	width:50px;
	margin-top:10px;
	margin-right:5%;
	margin-left:-5%;
	font-size:22px;
}
#navlist li a:hover{
	color:black;
}
#pagelabel{
	font-family:bold;
	font-size: 1.5em; 
	letter-spacing: 0px;  
	color:black;
	float:left;
	margin-top:4%;
	margin-left:10%;
}
#pagelabel:hover{
	text-decoration:none;
}
#gobackarrow{
	font-family:bold;
	font-size: 2em; 
	float:left;
	margin-left:5%;
}
#gobackarrow a{
	color:black;
}
#gobackarrow:hover{
	text-decoration:none;
}
#category{
	width:75%;
	height:30px;
	border-radius:5px;
	margin-left:5%;
}
#post_btn{
	width:80%;
	align:center;
	margin-left:30px;
	background-color:#fffc00;
}
#prf_pic{
	width:30px;
	height:30px;
	border-radius:15px;
	margin-top:-5px;
}
</style>
<body data-spy="scroll" data-target=".navbar" data-offset="50" id="body" bgcolor="#fcfcfc">
	<div class="row">
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
		<div class="col-sm-4 col-lg-4 col-xs-12">
			<div class="row">
				<nav  class="navbar navbar-default navbar-fixed-top" id="col3">
					<h4 id="gobackarrow"><a href="home.php?user_id=<?php echo $u_id; ?>"><i class="fas fa-long-arrow-alt-left"></i></a></h4>
					<h4 id="pagelabel"><b>Ask a Question!</b></h4>
				</nav>
				<nav  class="navbar navbar-default navbar-fixed-bottom" id="col3">
					<div class="row">
						<ul id="navlist">
							<div class="col-xs-3">
								<li><a href="home.php?user_id=<?php echo $_SESSION['uid']; ?>"><i class="glyphicon glyphicon-home"></i></a></li>
							</div>
							<div class="col-xs-3">
								<li><a href="spaces.php?user_id=<?php echo $_SESSION['uid']; ?>"><i class="glyphicon glyphicon-book"></i></a></li>
							</div>
							<div class="col-xs-3">
								<li><a href="notifications.php"><i class="glyphicon glyphicon-bell" style="margin-left:5px;"></i><span class="numnotifys" id="numnotifys"></span></a></li>
							</div>
							<div class="col-xs-3">
								<li id="prfpiclink"><a href="profile.php?user_id=<?php echo $_SESSION['uid']; ?>"><img src="<?php echo $prfpic; ?>" id="prf_pic"></a></li>
							</div>
						</ul>
					</div>
				</nav>
			</div>
			<div class="row" style="margin-top:14%;">
				<div class="col-xs-12 col-sm-12 col-lg-12">
					<form name="post_form" method="post" action="" enctype="multipart/form-data">
						<textarea placeholder="write..." rows="5" cols="50" class="form-control" name="post_content" id="postarea" style="resize:none;"></textarea><br>
						<strong  style="font-size:1.2em;margin-left:5%;">Select Category</strong><br>
						<select name="category" id="category" class="form-control">
							<option>Entrepreneurship</option>
							<option>Education</option>
							<option>Business</option>
							<option>Politics</option>
							<option>Real Esate</option>
							<option>Investing</option>
							<option>Photography</option>
							<option>Music</option>
							<option>Artistic Works</option>
							<option>Advertising</option>
							<option>Others</option>
						</select><hr>
						<input type="submit" class="btn btn-lg" value="post" name="post_btn" id="post_btn" />
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
	</div>
</body>
</html>
<?php
//insering a post
if(isset($_POST['post_btn'])){
	$insertP = new insertQue();
	$insertP->insertQst();
}
class insertQue{
	function insertQst(){
		global $con;
		$user_id = $_SESSION['uid'];
		$post_content=htmlentities(mysqli_real_escape_string($con,$_POST['post_content']));
		$category=htmlentities(mysqli_real_escape_string($con,$_POST['category']));
		if(strlen($post_content)>=1){
			while(1){
				$question_id=rand(100000000000000,999999999999999);
				$check_queid=mysqli_query($con,"select question_id from questions where question_id='$question_id'");
				$num_queid=mysqli_num_rows($check_queid);
				if($num_queid==0){
					break;
				}
			}
			$insert_content="insert into questions(question_id,asked_by,question_cnt,category,asked_on) values('$question_id','$user_id','$post_content','$category',NOW())";
			$run_content=mysqli_query($con,$insert_content);
			if($run_content){
				echo"<script>window.open('home.php?user_id=$user_id','_self');</script>";
			}else{
				echo"<script>window.open('writepost.php?user_id=$user_id','_self');</script>";
			}
		}else{
			echo "<script>alert('Write something to post!');</script>";
		}
	}
}
?>