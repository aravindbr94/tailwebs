<?php 
	session_start();
	include_once "conn.php";

	if(isset($_POST['submit']))
	{
		$username=$_POST['username'];

		$sql="SELECT * FROM teachers where username='$username'";
		$query=mysqli_query($conn,$sql);
		$data=array();
		if(mysqli_num_rows($query)>0)
		{
			$password=$_POST['password'];
			$row=mysqli_fetch_assoc($query);
			
			if(password_verify($password,$row['password']))
			{
				$_SESSION['username'] = $row['name'];
				$data[]=array("result"=>"success","msg"=>"Login Successfully.");
			}
			else 
			{
				$data[]=array("result"=>"error","msg"=>"Invalid Password");
			}
		}
		else 
		{
			$data[]=array("result"=>"error","msg"=>"Username doesn't Exists.");
		}
		echo json_encode($data);
	}
?>