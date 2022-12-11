<?php
//session_start();
include("includes/connection.php");
include("functions/functions.php");
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
	<title>Ask-Home</title>
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
#prf_pic{
	width:30px;
	height:30px;
	border-radius:15px;
	margin-top:-5px;
}
#prf_pic1{
	width:40px;
	height:40px;
	border:#e6e6e6 solid 2px;
	border-radius:20px;
}
#post_labelname{
	font-size:1.5em;
	color:black;
	margin-top:10px;
	text-decoration:none;
}
#post_labelname:hover{
	text-decoration:none;
}
#post_img{
	position:absolute;
	width:95%;
	height:580px;
	align:center;
}
#post_body{
	height:600px;
}
#descriptn{
	max-width:95%;
	overflow:hidden;
	white-space: pre-wrap;
	word-break: keep-all;
	max-height:32%;
	font-size:1.2em;
	font-family: 'Noto Serif JP', serif;
	background-color:white;
	border:none;
	margin-top:-10px;
	margin-left:2%;
}
</style>
<body data-spy="scroll" data-target=".navbar" data-offset="50" id="body" bgcolor="#fcfcfc">
	<div class="row">
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
		<div class="col-sm-4 col-lg-4 col-xs-12">
			<div class="row">
					<nav  class="navbar navbar-default navbar-fixed-top" id="col3">
						<h1 href="" id="logo">Ask ConectYu</h1>
						<ul id="navlist">
							<li><a href="writepost.php?user_id=<?php echo $_SESSION['uid']; ?>" style="float:right;margin-right:0.1%;"><i class="far fa-edit"></i></a></li>
							<li><a href="find_people.php" style="float:right;margin-right:6%;margin-top:3%;"><i class="glyphicon glyphicon-search"></i></a></li>
						</ul>
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
									<li><a href="notifications.php"><i class="glyphicon glyphicon-bell"></i><span class="numnotifys" id="numnotifys"></span></a></li>
								</div>
								<div class="col-xs-3">
									<li id="prfpiclink"><a href="profile.php?user_id=<?php echo $_SESSION['uid']; ?>"><img src="<?php echo $prfpic; ?>" id="prf_pic"></a></li>
								</div>
							</ul>
						</div>
					</nav>
			</div>
			<div class="row homeupdates" style="margin-top:14%;"></div>
		</div>
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		HomeUpdates();
	});
	
	function HomeUpdates(){
		$.ajax({
			url:'functions/functions.php',
			data:'showhomeupdates=1',
			type:'post',
			success:function(res){
				$('.homeupdates').html(res);
			}
		});
		return;
	}
</script>