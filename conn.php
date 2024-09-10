<?php 
	$server_name="localhost";
	$username="root";
	$password="";
	$database="tailwebs";

	$conn=mysqli_connect($server_name,$username,$password,$database);

	if(!$conn)
	{
		echo "Mysqli connect error:".mysqli_connect_error();
		die();
	}
?>