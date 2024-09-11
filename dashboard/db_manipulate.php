<?php 
	include_once "../conn.php";

	/** Trim & sanitize data **/
	function clean($value)
	{
		$value=trim($value);
		$value=stripslashes($value);
		$value=strip_tags($value);
		return $value;
	}


	/** Insert form data **/
	if($_POST['action']=="insertform")
	{
		parse_str($_POST['data'], $data);

		$studentname=clean($data['studentname']);
		$subject=clean($data['subject']);
		$marks=clean($data['marks']);

		$sql="INSERT INTO students (name, subject, marks) VALUES('$studentname', '$subject', '$marks') ON DUPLICATE KEY UPDATE marks = VALUES(marks)";

		$query=mysqli_query($conn,$sql);

		$data=array();
		if($query)
		{
			$data[]=array("status"=>"Success","msg"=>"Student details inserted Successfully");
		}
		else 
		{
			$data[]=array("status"=>"Error","msg"=>"Insertion Failed");
		}
		echo json_encode($data);
	}

	/** Get form data by Id**/
	if($_POST['action']=="getdetails")
	{
		$id=$_POST['id'];
		$sql="SELECT * FROM students WHERE id='$id'";

		$query=mysqli_query($conn,$sql);

		$data=array();
		if($query)
		{
			$student=mysqli_fetch_assoc($query);
			$data[]=array("status"=>"Success","id"=>$student['id'],"name"=>$student['name'],"subject"=>$student['subject'],"marks"=>$student['marks']);
		}
		else 
		{
			$data[]=array("status"=>"Error","msg"=>"Invalid ID.");
		}
		echo json_encode($data);
	}

	/** Update form data **/
	if($_POST['action']=="updateform")
	{
		parse_str($_POST['data'], $data);

		$id=clean($data['updateid']);
		$studentname=clean($data['updstudentname']);
		$subject=clean($data['updsubject']);
		$marks=clean($data['updmarks']);

		$sql="UPDATE students SET name='$studentname',subject='$subject',marks='$marks' WHERE id='$id'";

		$query=mysqli_query($conn,$sql);

		$data=array();
		if($query)
		{
			$data[]=array("status"=>"Success","msg"=>"Student details Updated Successfully");
		}
		else 
		{
			$data[]=array("status"=>"Error","msg"=>"Insertion Failed");
		}
		echo json_encode($data);
	}

	/** Delete form data **/
	if($_POST['action']=="deleteform")
	{
		$id=$_POST['id'];

		$sql="DELETE FROM students WHERE ID='$id'";

		$query=mysqli_query($conn,$sql);

		$data=array();
		if($query)
		{
			$data[]=array("status"=>"Success","msg"=>"Student details deleted Successfully");
		}
		else 
		{
			$data[]=array("status"=>"Error","msg"=>"Insertion Failed");
		}
		echo json_encode($data);
	}
?>