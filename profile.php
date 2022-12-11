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
	
	$user_id=$_GET['user_id'];
	$get_user=mysqli_query($con,"select * from users where user_id='$user_id'");
	$row_guser=mysqli_fetch_array($get_user);
	$prf_pic=$row_guser['profile_pic'];
	$user_name=$row_guser['user_name'];
	$cover_pic=$row_guser['cover_pic'];
	$tagline=$row_guser['tagline'];
	$user_country=$row_guser['user_country'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ask-Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta http-equiv='refresh' content='; URL=http://localhost/askconectyu/home.php?user_id=<?php echo $user_id; ?>'>
	<link rel="stylesheet" type="text/css" href="includes/stylesfile.css" media="screen"/>
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
#sidehamburder{
	float:right;
	margin-right:5%;
	margin-top:2.5%;
	font-size:1.5em;
	cursor:pointer;
	margin-top:15px;
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
#prf_pic{
	width:30px;
	height:30px;
	border-radius:15px;
	margin-top:-5px;
}
#prfpic{
	width:100px;
	height:100px;
	border:solid 1px black;
	border-radius:50px;
	margin-top:-100px;
}
#coverpic{
	width:100%;
	height:130px; 
	padding:0px;
	margin:0px;
}
#username{
	font-size:1.75em;
	color:#34baeb;
	margin-top:5px;
	margin-left:2%;
	font-family:bold;
}
#tagline{
	margin-left:10%;
	font-size:1em;
	font-family: 'Merienda One', cursive;
}
#designation{
	margin-left:10%;
	font-size:1.2em;
	color:#9e9d9b;
}
#settings a{
	font-family:bold;
	font-size:1.5em;
	display:block;
	width:100%;
	color:black;
	padding:10px;
	cursor:pointer;
}
#settings a:hover{
	text-decoration:none;
	background-color:#e6e6e6;
}

#prfmorebtn{
	font-size:1.5em;
	cursor:pointer;
	padding:10px;
	float:right;
	margin-right:5%;
}
#moredropdown{
	top:40px;
	width:15%;
	margin-left:50%;
}
#moredropdown li a{
	font-size:1.2em;
	width:100%;
	margin-left:0.5%;
}
#moredropdown li a:hover{
	width:100%;
	display:block;
}
#peoplinks li a{
	float:left;
}
#peoplinks li{
	list-style-type:none;
}
#following a,#nafollowing a{
	font-family:bold;
	font-size:1.5em;
	font-weight:1.5px;
	list-style-type:none;
	color:black;
	margin-left:-50%;
}
#following a:hover,#followers a:hover,#nafollowing a:hover,#nafollowers a:hover,{
	text-decoration:none;
	cursor:pointer;
	color:black;
}
#followersnum{
	font-size:1.5em;
	margin-left:12.5%;
}
#followingnum{
	font-size:1.5em;
	margin-left:-10%;
}
#followers a,#nafollowers a{
	font-family:bold;
	font-size:1.5em;
	font-weight:1.5px;
	list-style-type:none;
	color:black;
	/*text-align:center;*/
}
#prf_pic1{
	width:40px;
	height:40px;
	border:#e6e6e6 solid 2px;
	border-radius:20px;
}
#post_labelnamee{
	font-size:1.5em;
	color:black;
	margin-top:10px;
	text-decoration:none;
}
#post_labelnamee:hover{
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
<style>
.dropbtn {
  color: black;
  padding: 0px;
  font-size: px;
  border: none;
  cursor: pointer;
}
.dropdown-content {
  display:none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  max-height:300px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a:hover {
	text-decoration:none;
	color:black;
	background-color:#e6e6e6;
}
.show {
	display:block;
}

.row.no-gutters {
  margin-left: 0;
  margin-right: 0;
}
.row.no-gutters [class*='col-']:not(:first-child),
.row.no-gutters [class*='col-']:not(:last-child) {
  padding-right: 0;
  padding-left: 0;
}
</style>
<body data-spy="scroll" data-target=".navbar" data-offset="50" id="body" bgcolor="#fcfcfc">
	<div class="row">
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
		<div class="col-sm-4 col-lg-4 col-xs-12">
			<div class="row">
				<nav  class="navbar navbar-default navbar-fixed-top" id="col3">
				<?php $userid=$_GET['user_id'];
					if($userid!=$_SESSION['uid']){
					?>
						<h4 id="gobackarrow"><a href="home.php?user_id=<?php echo $u_id; ?>"><i class="fas fa-long-arrow-alt-left"></i></a></h4>
					<?php } ?>
					<h4 id="pagelabel"><b><?php echo $user_name; ?></b></h4>
					<ul>
					<?php 
						if($userid!=$_SESSION['uid']){
					 ?>
						<i class="fa fa-ellipsis-v dropdown-toggle dropbtn" aria-hidden="true" id="prfmorebtn" data-toggle="dropdown" onclick="showmorefunc();"></i>
						<ul class="dropdown-menu moredropdown" id="moredropdown" style="float:right;"> 
							<li><a onclick="reportUser('<?php echo $userid; ?>');" style="cursor:pointer;">Report user...</a></li>  
							<li><a id="shareprofile" style="cursor:pointer;" userid="<?php echo $_GET['user_id']; ?>">Share profile</a></li>  
							<li><a id="copyprfurl" style="cursor:pointer;">Copy URL</a></li>  
						</ul> 
						<script type="text/javascript">
							function showmorefunc() {
								document.getElementById("moredropdown").classList.toggle("show");
							}
						</script>
					<?php }else{ ?>
							<span><i class="fas fa-bars sidehamburder" id="sidehamburder" onclick="openNav();"></i></span>
					<?php } ?>	
					</ul>
					<div id="mySidenav" class="sidenav">
					  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
						<div style="margin-top:-40px;margin-bottom:-20px">
							<a href="profile.php?user_id=<?php echo $_SESSION['uid']; ?>" ><img id="navprfpic" src="<?php echo $prfpic; ?>" ></a>
							<?php $str=$user_name;  if(str_word_count($str)>1){ $string=substr($str, 0, strrpos($str, ' '));}else{ $string=$user_name;} ?>
							<a href="profile.php?user_id=<?php echo $_SESSION['uid']; ?>" id="fname"><p><b><?php echo $string; ?></b></p></a><br>
							<a href="profile.php?user_id=<?php echo $_SESSION['uid']; ?>" id="prflnk"><p id="prflabel">Profile</p></a>
						</div>
						<hr>
						<div id="sidebarlinks">
							<a href="messages.php?type=direct&user_id=<?php echo $_SESSION['uid']; ?>" style="margin-top:5px;"><img src="https://img.icons8.com/color/48/000000/circled-envelope.png" width="30px" height="30px">  &nbsp Ask Question</a><br>
							<a href="exppages.php?user_id=<?php echo $_SESSION['uid']; ?>"><img src="https://img.icons8.com/nolan/64/open-book.png"/ width="30px" height="30px"> &nbsp Spaces</a><br>
							<a href="ownevents.php?user_id=<?php echo $_SESSION['uid']; ?>"><img src="https://img.icons8.com/nolan/64/planner.png" width="30px" height="30px"/> &nbsp Posts</a><br>
							
							<hr><br>
							<a href="settings.php"><img src="https://img.icons8.com/dotty/80/000000/settings.png" width="30px" height="30px"> &nbsp Settings</a><br>
							<a href="help.php"><img src="https://img.icons8.com/carbon-copy/100/000000/ask-question.png" width="30px" height="30px"> &nbsp Help Center</a><br>
							<a href="report.php"><img src="https://img.icons8.com/windows/32/000000/complaint.png" width="30px" height="30px"> &nbsp Report</a><br>
							<a href=""><img src="https://img.icons8.com/dotty/100/000000/high-importance.png" width="30px" height="30px"> &nbsp About</a><br>
							<hr>
							<a  id="signout"><img src="https://img.icons8.com/nolan/64/logout-rounded.png" width="30px" height="30px"> &nbsp <b style="font-size:1.2em;">Sign out</b></a>
							<hr><br><br>
						</div>
					</div>
					<script type="text/javascript">
						$('#signout').click(function(){
							//open bootsrap modal
							$('#signoutModal').modal({
							show: true
							});
						});
					</script>
					<!-- SIGNOUT MODAL -->
					<div class="modal fade" id="signoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  data-backdrop="false">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<div class="panel-title"><p><strong>Confirmation page</strong></p></div>	
								</div>
								<div class="modal-body">
									<p><img src="https://img.icons8.com/carbon-copy/100/000000/question-mark.png" width="30px" height="30px"> &nbsp <b style="font-family:bold;font-size:1em;">Are you sure, Do you want to sign out?</b></p>
									
								</div>
								<div class="modal-footer">
									<button class="btn btn-info" type="button" id="signoutok" style="width:75px;">Confirm</button>
									<button class='btn btn-default' type='button' data-dismiss='modal' id='modalclose'>Cancel</button>
								</div>
							</div>
						</div>
					</div>
					
					 <script type="text/javascript">
						$("#signoutok").click(function(){
							window.open("logout.php","_self");
						});
						
						function openNav() {
						  document.getElementById("mySidenav").style.width = "250px";
						}

						function closeNav() {
						  document.getElementById("mySidenav").style.width = "0";
						}
					</script>
					
					
					
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
								<li id="prfpiclink"><a href="profile.php?user_id=<?php echo $_SESSION['uid']; ?>"><img src="<?php echo $prf_pic; ?>" id="prf_pic"></a></li>
							</div>
						</ul>
					</div>
				</nav>
			</div>
			<div class="row" style="margin-top:14%;">
				<div class="col-xs-12 col-sm-12 col-lg-12">
					<div class="panel panel-default" id='paneltab'>
						<img id="coverpic" src="<?php echo $cover_pic; ?>" class="img img-responsive img-fluid"/>
						<div class="panel-body" id="settings">
							<div class='row'>
								<div class="col-sm-9 col-xs-7">
									<p id="username"><b style="display:inline"><?php echo $user_name; ?>
								</div>
								<div class="col-sm-3 col-xs-5">
									<!-- profile pic  -->
									<img src="<?php echo $prfpic; ?>" id="prfpic" style="cursor:pointer;" /><br>
									
									<script type="text/javascript">
										$('#prfpic').click(function(){
											//open prfpic modal
											$('#prfpicmodal').modal({
											show: true
											});
										});
									</script>
									<div class="modal fade" id="prfpicmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:-20px;font-size:3em;margin-bottom:-15px;"><span aria-hidden="true">&times;</span></button>
												<img class="img-responsive" src="<?php echo $prfpic; ?>" id="modalprfpic" style="width:100%;height:75%;margin-top:-27px;border:solid 1px black;" />
											</div>
										</div>
									</div>
								</div>
								
							<div style="margin-top:5px;" class="row">
								<?php
									$uid=$_GET['user_id'];
									//getting followers
									$select_followers="select * from following where followed_user='$uid' AND status='accepted'";
									$run_followers=mysqli_query($con,$select_followers);
									$num_followers=mysqli_num_rows($run_followers);
									
									//getting following
									$select_following="select * from following where following_user='$uid' AND status='accepted' AND user_type='user'";
									$run_following=mysqli_query($con,$select_following);
									$num_followings=mysqli_num_rows($run_following);
									
									$sessionuid=$_SESSION['uid'];
									$check_accepted=mysqli_query($con,"select status from following where following_user='$sessionuid' AND followed_user='$uid' AND status='accepted'");
									$num_acceptance=mysqli_num_rows($check_accepted);
									
									
								?>
								<ul id="peoplinks">
								<?php
									if($num_acceptance!=0  or $_GET['user_id'] == $_SESSION['uid']){
								?>
									<div class="row">
										<div class="col-sm-3 col-xs-6">
											<li id="followers"><a>followers</a></li>
										</div>
										<div class="col-sm-3 col-xs-4">
											<li id="following"><a>following</a></li>
										</div>
										<div class="col-sm-3 col-xs-2">
										</div>
										<div class="col-sm-3 col-xs-0"></div>
									</div>
									<div class="row">
										<div class="col-sm-1 col-xs-0"></div>
										<div class="col-sm-3 col-xs-6">
											<span id="followersnum"><?php echo $num_followers; ?></span>
										</div>
										<div class="col-sm-3 col-xs-4">
											<span id="followingnum"><?php echo $num_followings; ?></span>
										</div>
										<div class="col-sm-3 col-xs-2">
										</div>
										<div class="col-sm-2 col-xs-0"></div>
									</div>
									<?php }else{?>
										<div class="row">
										<div class="col-sm-3 col-xs-6">
											<li id="nafollowers"><a>followers</a></li>
										</div>
										<div class="col-sm-3 col-xs-4">
											<li id="nafollowing"><a>following</a></li>
										</div>
										<div class="col-sm-3 col-xs-2">
										</div>
										<div class="col-sm-3 col-xs-0"></div>
									</div>
									<div class="row">
										<div class="col-sm-1 col-xs-0"></div>
										<div class="col-sm-3 col-xs-6">
											<span id="followersnum"><?php echo $num_followers; ?></span>
										</div>
										<div class="col-sm-3 col-xs-4">
											<span id="followingnum"><?php echo $num_followings; ?></span>
										</div>
										<div class="col-sm-3 col-xs-2">
										</div>
										<div class="col-sm-2 col-xs-0"></div>
									</div>
									<?php }
									?>
								</ul>
								<script type="text/javascript">
									$('#followers').click(function(){
										//open followers modal
										$('#showFollowersModal').modal({
											show: true
										});
										
										var user_id=<?php echo json_encode($_GET['user_id']); ?>;
										var uid=<?php echo json_encode($_SESSION['uid']); ?>;
										$.ajax({
											url:'functions/functions.php',
											data:'showfollowers=1'+'&user_id='+user_id+'&uid='+uid,
											type:'post',
											success:function(rest){
												//alert(rest);
												$('.showfollowers').html(rest);
											}
										});
									});
										$('#following').click(function(){
										//open following modal
										$('#showFollowingModal').modal({
											show: true
										});
										
										var user_id=<?php echo json_encode($_GET['user_id']); ?>;
										var uid=<?php echo json_encode($_SESSION['uid']); ?>;
										$.ajax({
											url:'functions/functions.php',
											data:'showfollowing=1'+'&user_id='+user_id+'&uid='+uid,
											type:'post',
											success:function(rest){
												//alert(rest);
												$('.showfollowing').html(rest);
											}
										});
									});
								</script>
								
								<!-- SHOWING FOLLOWERS MODAL -->
								<div class="modal fade" id="showFollowersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<div class="panel-title"><p><strong>followers</strong></p></div>	
											</div>
											<div class="modal-body">
												<div class="panel panel-deafult">
													<div class="panel-body showfollowers"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<!-- SHOWING FOLLOWING MODAL -->
								<div class="modal fade" id="showFollowingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<div class="panel-title"><p><strong>following</strong></p></div>	
											</div>
											<div class="modal-body">
												<div class="panel panel-deafult">
													<div class="panel-body showfollowing"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
							
							<!--  Tagline -->
							<div class="row">
								<p id="tagline"><?php echo $tagline; ?></p>
							</div>
							<div class="row">
								<p id="designation"><?php echo $user_country; 
									/*if($user_designation=="student" or $user_designation=="indv" ){echo "$user_desg at $org_name, $org_add";}else{
											echo "$user_desg, $org_add";}*/ ?></p>
							</div>
							
							<!-- Follwing, followers and edit profile buttons -->
							<div class="row">	
								<div class="col-sm-4 col-xs-4"></div>
								<div class="col-sm-4 col-xs-3"></div>
								<div class="col-sm-4 col-xs-5">
									<button id="editprof" name="editprof" class="btn btn-default btn-md" style="display:none;">Edit profile &nbsp
									<i class="fa fa-outdent" aria-hidden="true"></i></button>
								</div>
									<script>
										$('#editprof').click(function(){
											window.open('edit_profile.php','_self');
										});
									</script>
								<?php
									if($_GET['user_id'] != $_SESSION['uid']){ ?>
								<div class="row no-gutters">
									<div class="col-sm-4 col-xs-4"></div>
									<div class="col-sm-4 col-xs-3">
									</div>
									<div class="col-sm-4 col-xs-5">
									<form action="" method="post">
										<button id="followbtn" name="followbtn" class="btn btn-info btn-md" style="display:;"><span id="follow">follow</span> &nbsp <i class="fa fa-plus" aria-hidden="true">
										</i></button>
										<button id="followingbtn" name="followingbtn" class="btn btn-default btn-md" style="display:none;"><span id="follow">following</span> &nbsp <i style="color:green;" class="fa fa-check" aria-hidden="true"></i></button>
										<button id="requestedbtn" name="requestedbtn" class="btn btn-default btn-md" style="display:none;"><span id="follow">Requested</span></button>
									</form>
									</div>
								</div>
								
								<?php } 
								
										$uid=$_SESSION['uid'];
										$user_id=$_GET['user_id'];
										$sel_from_following="select * from following where following_user='$uid' AND followed_user='$user_id'";
										$run_from_following=mysqli_query($con,$sel_from_following);
										$row_following=mysqli_fetch_array($run_from_following);
										$follow_status=$row_following['status'];
										$num_following=mysqli_num_rows($run_from_following);
									
										if($u_id == $user_id){
											echo '<script type="text/javascript">
												var show1=document.getElementById("editprof");
												show1.setAttribute("style", "display:display;");
												var Nshow2=document.getElementById("followbtn");
												Nshow2.setAttribute("style", "display:none;");
											</script>';
										}else{ 
											echo '<script>
												var Nshow1=document.getElementById("editprof");
												Nshow1.setAttribute("style","display:none;");
												</script>
											';
											if($num_following==0){
												echo '
													<script>
														var show2=document.getElementById("followbtn");
														show2.setAttribute("style","display:display;");
														var following=document.getElementById("followingbtn");
														following.setAttribute("style","display:none;");
														var requested=document.getElementById("requestedbtn");
														requested.setAttribute("style","display:none;");
													</script>
												';	
											}elseif($num_following!=0 and $follow_status=="accepted"){
												echo '
													<script>
														var show2=document.getElementById("followbtn");
														show2.setAttribute("style","display:none;");
														var following=document.getElementById("followingbtn");
														following.setAttribute("style","display:display;");
														var requested=document.getElementById("requestedbtn");
														requested.setAttribute("style","display:none;");
													</script>
												';	
											}elseif($num_following!=0 and $follow_status=="requested"){
												echo '
													<script>
														var show2=document.getElementById("followbtn");
														show2.setAttribute("style","display:none;");
														var following=document.getElementById("followingbtn");
														following.setAttribute("style","display:none;");
														var requested=document.getElementById("requestedbtn");
														requested.setAttribute("style","display:display;");
													</script>
												';	
											}
										} 
									?>
							</div>
								
							</div>
						</div>
					</div>
					
					<!-- Code for posts,questions and answers tab -->
					<div class="row no-gutters" style="margin-top:-20px;">
						<div class="col-xs-4 col-sm-4 col-lg-4">
							<input type="button" class="btn btn-default" value="Posts" name="showposts" style="width:100%;"/>
						</div>
						<div class="col-xs-4 col-sm-4 col-lg-4">
							<input type="button" class="btn btn-default" value="Questions" name="showques" style="width:100%;"/>
						</div>
						<div class="col-xs-4 col-sm-4 col-lg-4">
							<input type="button" class="btn btn-default" value="Answers" name="showans" style="width:100%;"/>
						</div>
					</div>
					
					<div class="row ownposts"></div>
					
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		ownPosts();
	});
	//ownPosts
	function ownPosts(){
		$.ajax({
			url:'functions/functions.php',
			data:'ownposts=1',
			type:'post',
			success:function(res){
				$('.ownposts').html(res);
			}
		});
		return;
	}

	//showing followers
	function showFollowers(){
		var user_id=<?php echo json_encode($_GET['user_id']); ?>;
		var uid=<?php echo json_encode($_SESSION['uid']); ?>;
		$.ajax({
			url:'functions/functions.php',
			data:'showfollowers=1'+'&user_id='+user_id+'&uid='+uid,
			type:'post',
			success:function(rest){
				//alert(rest);
				$('.showfollowers').html(rest);
			}
		});
	}
	
	//showing following
	function showFollowing(){
		var user_id=<?php echo json_encode($_GET['user_id']); ?>;
		var uid=<?php echo json_encode($_SESSION['uid']); ?>;
		$.ajax({
			url:'functions/functions.php',
			data:'showfollowing=1'+'&user_id='+user_id+'&uid='+uid,
			type:'post',
			success:function(rest){
				//alert(rest);
				$('.showfollowing').html(rest);
			}
		});
	}
</script>