<?php
session_start();
$con=mysqli_connect("localhost","root","","askconectyu");
?>
<html>
<head>
<script src="https://kit.fontawesome.com/6d15a9d73e.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Noto+Serif+JP&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="includes/stylesfile.css" media="screen"/>
<link href="https://fonts.googleapis.com/css?family=Merienda+One&display=swap" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>	
	
	<script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <script type='text/javascript' src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
	<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=IntersectionObserver%2CIntersectionObserverEntry"></script> 

</head>
<style>
#verticalopt{
	float:right;
	margin-right:1%;
	list-style-type:none;
	font-size:1.5em;
	margin-top:10px;
}
#verticalopt:hover{
	background-color:#e6e6e6;
	border-radius:50px;
}
.ansquebtn{
	font-size:1.5em;
	margin-left:7.5%;
	background-color:#fffc00;
	border-radius:5px;
	color:black;
}
.ansquebtn:hover,.like:hover{
	cursor:pointer;
}
.like{
	font-size:2em;
	float:right;
	margin-right:7.5%;
	margin-top:5px;
}
</style>
<?php
	global $con;
	$sessionuserid = $_SESSION['uid'];
	$select_user="select * from users where user_id='$sessionuserid'";
	$run_user=mysqli_query($con,$select_user);
	$row_user=mysqli_fetch_array($run_user);
	$prf_picc=$row_user['profile_pic'];
	$user_name=$row_user['user_name'];
	$user_email=$row_user['user_email'];
	$user_id=$row_user['user_id'];
	
	
//search a user
if(isset($_POST['searcuser'])){
	$fp = new findPeople();
	$fp->displayPeople();
}

//showing home updates
if(isset($_POST['showhomeupdates'])){
	$fp = new homeUpdates();
	$fp->showUpdates();
}

//showing own posts
if(isset($_POST['ownposts'])){
	$fp = new OwnPosts();
	$fp->showPosts();
}

//finding people by searching.

class findPeople{
	function displayPeople(){
		global $con;
		$sessionuser=htmlentities(mysqli_real_escape_string($con,$_POST['user_id']));
		$search_input=htmlentities(mysqli_real_escape_string($con,$_POST['searchinput']));
		//$filter=htmlentities(mysqli_real_escape_string($con,$_POST['filter']));
		
		
		if($search_input==null){
			echo "
				<script type='text/javascript'> 
					var notFound=document.getElementById('intimateLabel');
					notFound.setAttribute('style', 'display:display;');
				</script>
			";
		}else{
			$select_search="select * from users where (user_id='$search_input' or user_name='$search_input' or user_name like '$search_input%' or user_name like '%$search_input')";
		
			$run_search=mysqli_query($con,$select_search);
			$num_rows=mysqli_num_rows($run_search);
			if($num_rows>=1){
				while($row_search=mysqli_fetch_array($run_search)){
					$prfpic=$row_search['profile_pic'];
					$user_name=$row_search['user_name'];
					$user_id=$row_search['user_id'];
					
					echo "
						<div class='panel panel-default' id='paneltab'>
							<div class='panel-body'>
								<div class='row'>
									<div class='col-sm-2 col-xs-2'>
										<a href='profile.php?user_id=$user_id'><img src='$prfpic' id='prf_pic1' style='margin-top:18%;' ></a>
									</div>
									<div class='col-sm-8 col-xs-8' id='postid'>
					";
					echo "
										<a href='profile.php?user_id=$user_id' id='post_labelname'><p>$user_name</p></a>
									</div>
									<div class='col-sm-2 col-xs-2'>
										<div class='dropdown'>
											<li id='verticalopt' class='dropdown-toggle' data-toggle='dropdown'><i class='glyphicon 
											glyphicon-option-vertical'></i></li>
											<ul class='dropdown-menu' id='dropmenu' style='margin-left:-200%;'>
												<li><a href='profile.php?user_id=$user_id''>view profile</a></li>  
												<li><a class='shsearcheduserprf' style='cursor:pointer;' userid='$user_id'>Share</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					";
				}
			}else{
				echo "
					<script type='text/javascript'> 
						var notFound=document.getElementById('userNotFound');
						notFound.setAttribute('style', 'display:display;');
					</script>
				";
			}
		}
	}
} //find people class end

//inserting into "following" table
if(isset($_POST['followbtn'])){
	global $con;
	$followed_user=$_GET['user_id'];
	$following_user=$_SESSION['uid'];
	
	$select_follow="select * from following where following_user='$following_user' AND followed_user='$followed_user'";
	$run_follow=mysqli_query($con,$select_follow);
	$num=mysqli_num_rows($run_follow);
	
	if($num==0){
		while(true){
			$notify_id=rand(1111111111,9999999999);
			$insert_following = "insert into following (following_user,followed_user,user_type,status,notify_id,date) values('$following_user','$followed_user','user','accepted','$notify_id',NOW())";
			$run_following = mysqli_query($con,$insert_following);
			 break;
			/*$checkid=mysqli_query($con,"select notify_id from notifications where notify_id='$notify_id'");
			$num=mysqli_num_rows($checkid);
			if($num==0){
				$check_privacy=mysqli_query($con,"select account_type from users where user_id='$followed_user'");
				$row_privacy=mysqli_fetch_array($check_privacy);
				$privacy=$row_privacy['account_type'];
				if($privacy=="public"){
					$insert_following = "insert into following (following_user,followed_user,user_type,status,notify_id,date) values('$following_user','$followed_user','user','accepted','$notify_id',NOW())";
					$run_following = mysqli_query($con,$insert_following);
				}elseif($privacy=="private"){
					$insert_following = "insert into following (following_user,followed_user,user_type,status,notify_id,date) values('$following_user','$followed_user','user','requested','$notify_id',NOW())";
					$run_following = mysqli_query($con,$insert_following);
				}
				if($run_following){
					$insert_notify="insert into notifications(notify_id,notified_to,notification_type,notification_status,user_type,notification_date) values('$notify_id','$followed_user','follow','unread','user',NOW())";
					$run_insert_notify=mysqli_query($con,$insert_notify);
				}
				break;
			}*/
		}
	}else{
		//echo "<script>alert('An error occurred.Try again!');</script>";
	}
}

//deleting from following
if(isset($_POST['followingbtn']) or isset($_POST['requestedbtn'])){
	global $con;
	$followed_user=$_GET['user_id'];
	$following_user=$_SESSION['uid'];
	
	$select_notify_id=mysqli_query($con,"select notify_id from following where following_user='$following_user' AND followed_user='$followed_user'");
	$delete_follow="delete from following where following_user='$following_user' AND followed_user='$followed_user'";
	$run_delete=mysqli_query($con,$delete_follow);
	/*if($run_delete){
		$row_notify_id=mysqli_fetch_array($select_notify_id);
		$notify_id=$row_notify_id['notify_id'];
		mysqli_query($con,"delete from notifications where notify_id='$notify_id'");
	}else{
		echo "<script>alert('An error occurred.Try again!');</script>";
	}*/
}

//showing home updates
class homeUpdates{
	function showUpdates(){
		global $con;
		$sessionuserid=$_SESSION['uid'];
		global $prf_picc;
		$select_post="select * from questions where asked_by='$sessionuserid' OR asked_by in (select followed_user from following where following_user='$sessionuserid') ORDER BY asked_on DESC";
		$run_post=mysqli_query($con,$select_post);
		$num_post=mysqli_num_rows($run_post);
		if($num_post!=0){
			while($row_post=mysqli_fetch_array($run_post)){
				//getting question data
				$question_id=$row_post['question_id'];
				$user_id=$row_post['asked_by'];
				$question_cnt=$row_post['question_cnt'];
				$category=$row_post['category'];
				$asked_on=$row_post['asked_on'];
				
				//getting the posted user data
				$select_user="select * from users where user_id='$user_id'";
				$run_user=mysqli_query($con,$select_user);
				$row_user=mysqli_fetch_array($run_user);
				$prfpic=$row_user['profile_pic'];
				$user_name=$row_user['user_name'];
				
				echo "
					<div class='panel panel-default'>
						<div class='panel-heading' style='background-color:white;'>
							<div class='row'>
								<div class='col-sm-2 col-xs-2'>
									<a href='profile.php?user_id=$user_id'><img src='$prfpic' id='prf_pic1' ></a>
								</div>
								<div class='col-sm-8 col-xs-8' id='postid'>
									<a href='profile.php?user_id=$user_id' id='post_labelname' style='margin-top:-20px;margin-bottom:10px;'><p>$user_name</p></a>
								</div>
								<div class='col-sm-2 col-xs-2'>
									<div class='dropdown'>
										<li id='verticalopt' class='dropdown-toggle' data-toggle='dropdown'><i class='glyphicon 
										glyphicon-option-vertical'></i></li>
										<ul class='dropdown-menu pull-left'  aria-labelledby='verticalopt' style='margin-left:-180%;margin-top:100%:'>
											<li><a style='cursor:pointer;' >Report</a></li>  
											<li><a class='sharepost' style='cursor:pointer;' postid=''>Share</a></li>
										";
										if($sessionuserid == $user_id){
											echo "
												<li><a id='delpost' name='delpost' style='cursor:pointer;' onclick=''>Delete the post</a></li>	
											";
										}
										echo "
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class='panel-body'>
							<div class='row'>
								<div class='col-sm-12'> 
									<pre id='descriptn'><b>$question_cnt</b></pre>
								</div>
							</div>
						</div>
					<div class='panel-footer' style='background-color:white;'>
						<div class='row'>
							";
										$userid=$sessionuserid;
										?>	
											<a href="answerques.php?que_id=<?php echo $question_id; ?>" class="btn btn-info btn-sm ansquebtn" name="answerque" id="ansquebtn">Answer</a>
											<span><i class="far fa-thumbs-up like"></i></span>
										
										<br>
										<span class="timeagocnt">
										<?php
											//showing time i.e 1 min ago,etc...
											//echo time_ago_in_php($asked_on);
										?>
										</span>		
							<?php
							echo "
								</div>
							</div>
						</div>
				";
			}
			echo "
				<br><br>
			";
		}
	}
}

//showing own posts
class OwnPosts{
	function showPosts(){
		global $con;
		$sessionuserid=$_SESSION['uid'];
		global $prf_picc;
		$select_post="select * from questions where asked_by='$sessionuserid' ORDER BY asked_on DESC";
		$run_post=mysqli_query($con,$select_post);
		$num_post=mysqli_num_rows($run_post);
		if($num_post!=0){
			while($row_post=mysqli_fetch_array($run_post)){
				//getting question data
				$question_id=$row_post['question_id'];
				$user_id=$row_post['asked_by'];
				$question_cnt=$row_post['question_cnt'];
				$category=$row_post['category'];
				$asked_on=$row_post['asked_on'];
				
				//getting the posted user data
				$select_user="select * from users where user_id='$user_id'";
				$run_user=mysqli_query($con,$select_user);
				$row_user=mysqli_fetch_array($run_user);
				$prfpic=$row_user['profile_pic'];
				$user_name=$row_user['user_name'];
				
				echo "
					<div class='panel panel-default'>
						<div class='panel-heading' style='background-color:white;'>
							<div class='row'>
								<div class='col-sm-2 col-xs-2'>
									<a href='profile.php?user_id=$user_id'><img src='$prfpic' id='prf_pic1' ></a>
								</div>
								<div class='col-sm-8 col-xs-8' id='postid'>
									<a href='profile.php?user_id=$user_id' id='post_labelnamee' style='margin-top:-20px;margin-bottom:10px;'><p>$user_name</p></a>
								</div>
								<div class='col-sm-2 col-xs-2'>
									<div class='dropdown'>
										<li id='verticalopt' class='dropdown-toggle' data-toggle='dropdown'><i class='glyphicon 
										glyphicon-option-vertical'></i></li>
										<ul class='dropdown-menu pull-left'  aria-labelledby='verticalopt' style='margin-left:-180%;margin-top:100%:'>
											<li><a style='cursor:pointer;' >Report</a></li>  
											<li><a class='sharepost' style='cursor:pointer;' postid=''>Share</a></li>
										";
										if($sessionuserid == $user_id){
											echo "
												<li><a id='delpost' name='delpost' style='cursor:pointer;' onclick=''>Delete the post</a></li>	
											";
										}
										echo "
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class='panel-body'>
							<div class='row'>
								<div class='col-sm-12'> 
									<pre id='descriptn'><b>$question_cnt</b></pre>
								</div>
							</div>
						</div>
					<div class='panel-footer' style='background-color:white;'>
						<div class='row'>
							";
										$userid=$sessionuserid;
										?>	
											<a href="answerques.php?que_id=<?php echo $question_id; ?>" class="btn btn-info btn-sm ansquebtn" name="answerque" id="ansquebtn">Answer</a>
											<span><i class="far fa-thumbs-up like"></i></span>
										
										<br>
										<span class="timeagocnt">
										<?php
											//showing time i.e 1 min ago,etc...
											//echo time_ago_in_php($asked_on);
										?>
										</span>		
							<?php
							echo "
								</div>
							</div>
						</div>
				";
			}
			echo "
				<br><br>
			";
		}
	}
}
?>