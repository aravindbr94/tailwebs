
<?php 
	session_start();
	include_once "conn.php";
	if(isset($_POST['submit']))
	{
		print_r($_POST);
		// $username=$_POST['username'];
		// $password=$_POST['password'];

		// $query="SELECT * FROM teachers where username='$username'";
		// if(mysqli_num_rows($query)>0)
		// {
		// 	$row = mysqli_fetch_row($query);
		// 	echo $row['password'];
		// }
		// else 
		// {
		// 	$error=array("error"=>"Email id does not exists.");
		// 	echo json_encode($error);
		// }
	}
	else 
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Teachers Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="fonts/linearicons/style.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
		<style type="text/css">
			.form-holder
			{
				margin-block: 2px;
			}
			.mt-2 
			{
				margin-top: 30px;
			}
			h3
			{
				margin-bottom: 0;
			}
			span.errors {
		    	text-align: center;
		    	display: block;
		   		padding: 16px 0;
		    	font-size: 16px;
		    	color: #ff0000;
		    	font-weight: bold;
			}
		</style>
		
	</head>

	<body>
		<div class="wrapper">
			<div class="inner">
				<img src="images/image-1.png" alt="" class="image-1">
				<form name="loginform" class="loginform" action="index.php" method="post">
					<h3>Login</h3>
					<span class="errors"></span>
					<div class="form-holder">
						<input type="text" id="username" name="username" class="form-control" placeholder="Username">
						<span class="lnr lnr-user"></span>
					</div>
					<span class="usernameerror"></span>
					</span>
					<div class="form-holder mt-2">
						<input type="password" id="password" name="password" class="form-control" placeholder="Password">
						<span class="lnr lnr-eye password-toggle-icon"></span>
					</div>
					<span class="passworderror"></span>
					<button type="button" name="submit" onclick="checkauthentication()">
						<span>Login</span>
					</button>

				</form>
				<img src="images/image-2.png" alt="" class="image-2">
			</div>
			
		</div>
		<script src="js/main.js"></script>
		<script src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript">
			function checkauthentication()
			{	
		       let username=$("#username").val();
		       let password=$("#password").val();
		       $.ajax({
		       	url:'logincheck.php',
		       	type:"POST",
		       	data:{submit:"submit",username:username,password:password},
		       	dataType:"json",
		       	success:function(response)
		       	{
		       		console.log(response);
		       		if(response[0].result=="error")
		       		{
		       			$(".errors").html(response[0].msg);
		       		}
		       		else if(response[0].result=="success")
		       		{
		       			window.location.href="dashboard";
		       		}
		       		
		       	}
		       });
			}
				
		</script>
	</body>
</html>
<?php
	}
?>
