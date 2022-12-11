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
	<title>Ask-Spaces</title>
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
#prf_pic{
	width:30px;
	height:30px;
	border-radius:15px;
	margin-top:-5px;
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
#prf_pic1{
	width:50px;
	height:50px;
	border-radius:50px;
}
#post_labelname{
	font-size:1.6em;
	color:black;
	text-decoration:none;
}
</style>
<body data-spy="scroll" data-target=".navbar" data-offset="50" id="body" bgcolor="#fcfcfc">
	<div class="row">
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
		<div class="col-sm-4 col-lg-4 col-xs-12">
			<div class="row">
				<nav  class="navbar navbar-default navbar-fixed-top" id="col3">
					<h4 id="gobackarrow"><a href="home.php?user_id=<?php echo $u_id; ?>"><i class="fas fa-long-arrow-alt-left"></i></a></h4>
					<h4 id="pagelabel"><b>Find People</b></h4>
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
			
			<div class="row" style="position:relative;z-index:3;margin-top:14%;">
				<form method="get" action="find_people.php" name="searchform" style="margin:0px 10px 0px 10px;">
					<input type="text" class="form-control" placeholder="search..." name="searchbox" id="searchbox" required
					value="<?php echo isset($_GET["searchbox"]) ? htmlentities($_GET["searchbox"]) : ''; ?>" autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1"/>
				</form>
			</div>
			<script type="text/javascript">
				$("#searchbox").keyup(function(){
					var il = document.getElementById('intimateLabel');
					il.setAttribute('style','display:none;');
					var unf = document.getElementById('userNotFound');
					unf.setAttribute('style','display:none;');
					/*var recent = document.getElementById('recentsearches');
					recent.setAttribute('style','display:none;');*/
					var sessionuser=<?php echo json_encode($_SESSION['uid']); ?>;
					var searchinput=document.getElementById("searchbox").value;
					
					/*if(document.getElementById('topradiobtn').checked){
						var filval=document.getElementById('topradiobtn').value;
					}else if(document.getElementById('allradiobtn').checked){
						var filval=document.getElementById('allradiobtn').value;
					}else if(document.getElementById('sturadiobtn').checked){
						var filval=document.getElementById('sturadiobtn').value;
					}else if(document.getElementById('orgradiobtn').checked){
						var filval=document.getElementById('orgradiobtn').value;
					}else if(document.getElementById('pageradiobtn').checked){
						var filval=document.getElementById('pageradiobtn').value;
					}else if(document.getElementById('othradiobtn').checked){
						var filval=document.getElementById('othradiobtn').value;
					}*/
					$.ajax({
						url:'functions/functions.php',
						data:'searcuser=1&user_id='+sessionuser+'&searchinput='+searchinput,
						type:'post',
						async:true,
						success:function(res){
							//$('.notifymenu').html('');
							$('.showSearchResults').html(res);
							/*$.ajax({
								url:'functions/functions.php',
								data:'showrecentsearches=1',
								type:'post',
								async:true,
								success:function(res){
									//$('.notifymenu').html('');
									$('.recentsearches').html(res);
								}
							});*/
						}
					});
				});
			</script>
			<div class="row" style="padding:20px;">
				<div class='alert alert-warning' id="userNotFound" style="display:none;width:110%;">
					<strong>No results found for the searched user!</strong>
				</div>
				<div class='alert alert-warning' id="intimateLabel" style='text-align:center;font-family:bold;font-size:1.5em;width:110%;'>Search for someone to see the results! <i class="fa fa-lightbulb-o" aria-hidden="true"></i></div>
			</div>
			<div class="showSearchResults" style="margin-top:-25px;width:100%"></div>
			
		</div>
		<div class="col-sm-4 col-lg-4 col-xs-0"></div>
	</div>
</body>
</html>
<script type="text/javascript">
//function for search results
	function searchResults(){
		var il = document.getElementById('intimateLabel');
		il.setAttribute('style','display:none;');
		var unf = document.getElementById('userNotFound');
		unf.setAttribute('style','display:none;');
		var recent = document.getElementById('recentsearches');
		recent.setAttribute('style','display:none;');
		var sessionuser=<?php echo json_encode($_SESSION['uid']); ?>;
		var searchinput=document.getElementById("searchbox").value;
		
		if(document.getElementById('topradiobtn').checked){
			var filval=document.getElementById('topradiobtn').value;
		}else if(document.getElementById('allradiobtn').checked){
			var filval=document.getElementById('allradiobtn').value;
		}else if(document.getElementById('sturadiobtn').checked){
			var filval=document.getElementById('sturadiobtn').value;
		}else if(document.getElementById('orgradiobtn').checked){
			var filval=document.getElementById('orgradiobtn').value;
		}else if(document.getElementById('pageradiobtn').checked){
			var filval=document.getElementById('pageradiobtn').value;
		}else if(document.getElementById('othradiobtn').checked){
			var filval=document.getElementById('othradiobtn').value;
		}
		$.ajax({
			url:'functions/functions.php',
			data:'searcuser=1&user_id='+sessionuser+'&searchinput='+searchinput+'&filter='+filval,
			type:'post',
			async:true,
			success:function(res){
				//$('.notifymenu').html('');
				$('.showSearchResults').html(res);
				showRecentSearches();
			}
		});
	}
</script>
<?php
	if(isset($_GET['search_btn'])){
	?>
		<script type='text/javascript'>
			var il = document.getElementById('intimateLabel');
			il.setAttribute('style','display:none;');
			var recent = document.getElementById('recentsearches');
			recent.setAttribute('style','display:display;');
			var sessionuser=<?php echo json_encode($_SESSION['uid']); ?>;
			var searchinput=<?php echo json_encode($_GET['searchbox']); ?>;
			$.ajax({
				url:'functions/functions.php',
				data:'searcuser=1&user_id='+sessionuser+'&searchinput='+searchinput+'&filter=top',
				type:'post',
				async:true,
				success:function(res){
					//$('.notifymenu').html('');
					$('.showSearchResults').html(res);
					showRecentSearches();
				}
			});
			
		</script>
	<?php
	}else{
		echo "
			<script type='text/javascript'>
				var il = document.getElementById('intimateLabel');
				il.setAttribute('style','display:display;');
				var recent = document.getElementById('recentsearches');
				recent.setAttribute('style','display:display;');
			</script>
		";
	}
?>