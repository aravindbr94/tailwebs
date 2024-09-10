<?php 
	session_start();
	include_once "../conn.php";

	if(!isset($_SESSION["username"])){
        header("location: ../index.php");
        exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" href="../css/custom.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
	<style type="text/css">
		.logout
		{
			text-align: right;
		}
		.logout .btn 
		{
			font-size: 16px;
			text-decoration: underline;
		}
	</style>
</head>
<body class="cont">
	<div class="logout">
		<a href="logout.php"><button class="btn">Logout</button></a>
	</div>
	<div class="d-flex space-between align-center p-relative">
		<h3 class="topheading">Students List</h3>
		<button class="btn btn-primary p-absolute" onclick="showmodal('addstudent')">Add Student</button>
	</div>
	
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Subject</th>
				<th>Mark</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$sql="SELECT * FROM students";
				$query=mysqli_query($conn,$sql);
				if(mysqli_num_rows($query)>0)
				{
					while($result=mysqli_fetch_assoc($query))
					{
						echo "<tr><td>".$result['id']."</td>
						<td>".$result['name']."</td>
						<td>".$result['subject']."</td>
						<td>".$result['marks']."</td>
						<td><div class='d-flex g-10'><button class='btn btn-warning' onclick='getDetails($result[id])'>Update</button><button class='btn btn-danger' onclick='deleteStudent($result[id])'>Delete</button></div></td>
						</tr>";
					}
				}
			?>
		</tbody>
	</table>
	<!-- Add Student Modal -->
	<div id="addstudent" class="modal addstudent">
		<form id="insertform">
		  <!-- Modal content -->
		  <div class="modal-content">
		    <div class="modal-header">
		      <span class="close" onclick="closemodal('addstudent')">&times;</span>
		      <h2 class="black text-center">Add Student</h2>
		    </div>
		    <div class="modal-body">
		      <div class="d-flex flex-column">
		      	<label>Name</label>
		      	<input type="text" class="studentname" name="studentname">
		      	<span class="nameerror errors"></span>
		      </div>

		      <div class="d-flex flex-column">
		      	<label>Subject</label>
		      	<input type="text" class="subject" name="subject">
		      	<span class="subjecterror errors"></span>
		      </div>
		      <div class="d-flex flex-column">
		      	<label>Marks</label>
		      	<input type="number" class="marks" name="marks">
		      	<span class="markserror errors"></span>
		      </div>
		    </div>
		    <div class="modal-footer">
		      <button type="button" name="insertdata" class="btn btn-primary btn-large" onclick="insertDetails()">Add</button>
		    </div>
		  </div>
		</form>
	</div>

	<!-- Update Student Modal -->
	<div id="updatestudent" class="modal updatestudent">
		<form id="updateform">
		  <!-- Modal content -->
		  <div class="modal-content">
		    <div class="modal-header">
		      <span class="close" onclick="closemodal('updatestudent')">&times;</span>
		      <h2 class="black text-center">Update Student</h2>
		    </div>
		    <div class="modal-body">
		      <div class="d-flex flex-column">
		      	<label>Name</label>
		      	<input type="hidden" class="updateid" name="updateid">
		      	<input type="text" name="updstudentname" class="updstudentname">
		      	<span class="nameerror errors"></span>
		      </div>
		      
		      <div class="d-flex flex-column mt-10">
		      	<label>Subject</label>
		      	<input type="text" name="updsubject" class="updsubject">
		      	<span class="subjecterror errors"></span>
		      </div>
		      <div class="d-flex flex-column mt-10">
		      	<label>Marks</label>
		      	<input type="text" name="updmarks" class="updmarks">
		      	<span class="markserror errors"></span>
		      </div>
		    </div>
		    <div class="modal-footer">
		      <button type="button" class="btn btn-primary btn-large" onclick="updateDetails()">Update</button>
		    </div>
		  </div>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="../js/custom.js"></script>

</body>
</html>