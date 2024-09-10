
/** Show & Hide Modal **/
function showmodal(name)
{	
	var modal = document.getElementById(name);
	modal.style.display = "block";
}
function closemodal(name)
{	
	var modal = document.getElementById(name);
	modal.style.display = "none";
}

/** Insert Student Details **/
function insertDetails()
{
	let studname=$(".studentname").val();
	let subject=$(".subject").val();
	let marks=$(".marks").val();

	if(studname=="")
	{
		$(".nameerror").text("Name field required");
		$(".studentnam").focus();
	}
	if(subject=="")
	{
		$(".subjecterror").text("Subject field required");
		$(".subject").focus();
	}
	if(marks=="")
	{
		$(".markserror").text("Marks field required");
		$(".marks").focus();
	}

	if(studname!="" && subject!="" && marks!="")
	{
		$.ajax({
			url:'db_manipulate.php',
			type:"POST",
			data: {action:'insertform',data:$("#insertform").serialize()},
			dataType:"json",
			success:function(response)
			{
				if(response[0].status=="Success")
	       		{
	       			Swal.fire({
					  title: response[0].status,
					  text: response[0].msg,
					  icon: "success",
					  timer: 1000
					});

					setTimeout(()=>{
						location.reload();
					},1000);
	       		}
	       		else if(response[0].status=="Error")
	       		{
	       			Swal.fire({
					  title: response[0].status,
					  text: response[0].msg,
					  icon: "error",
					});
	       		}
			}
		});
	}
	
}

/** Get Student Details **/
function getDetails(id)
{
	$("#updatestudent").show();
	$.ajax({
		url:'db_manipulate.php',
		type:"POST",
		data: {action:'getdetails',id:id},
		dataType:"json",
		success:function(response)
		{
			if(response[0].status=="Success")
       		{
       			$(".updateid").val(response[0].id);
       			$(".updstudentname").val(response[0].name);
       			$(".updsubject").val(response[0].subject);
       			$(".updmarks").val(response[0].marks);
       		}
       		else if(response[0].status=="Error")
       		{
       			Swal.fire({
				  title: response[0].status,
				  text: response[0].msg,
				  icon: "error"
				});
       		}
		}
	});	
}

/** Update Student Details **/
function updateDetails()
{
	let studname=$(".updstudentname").val();
	let subject=$(".updsubject").val();
	let marks=$(".updmarks").val();

	if(studname=="")
	{
		$(".nameerror").text("Name field required");
		$(".updstudentname").focus();
	}
	if(subject=="")
	{
		$(".subjecterror").text("Subject field required");
		$(".updsubject").focus();
	}
	if(marks=="")
	{
		$(".markserror").text("Marks field required");
		$(".updmarks").focus();
	}

	if(studname!="" && subject!="" && marks!="")
	{
		$.ajax({
			url:'db_manipulate.php',
			type:"POST",
			data: {action:'updateform',data:$("#updateform").serialize()},
			dataType:"json",
			success:function(response)
			{
				if(response[0].status=="Success")
	       		{
	       			Swal.fire({
					  title: response[0].status,
					  text: response[0].msg,
					  icon: "success",
					  timer: 1000
					});
					setTimeout(()=>{
						location.reload();
					},1000);
	       		}
	       		else if(response[0].status=="Error")
	       		{
	       			Swal.fire({
					  title: response[0].status,
					  text: response[0].msg,
					  icon: "error",
					  timer: 1000
					});
	       		}
			}
		});
	}
	
}

/** Delete Student **/
function deleteStudent(id)
{
	Swal.fire({
	  title: "Are you sure?",
	  text: "You won't be able to revert this!",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  confirmButtonText: "Yes, delete it!"
	}).then((result) => {
	  if (result.isConfirmed) {
	  	$.ajax({
			url:'db_manipulate.php',
			type:"POST",
			data: {action:'deleteform',id:id},
			dataType:"json",
			success:function(response)
			{
				if(response[0].status=="Success")
	       		{
	       			Swal.fire({
				      title: "Deleted!",
				      text: response[0].msg,
				      icon: "success",
				      timer: 1000
				    });
				    setTimeout(()=>{
						location.reload();
					},1000);

	       		}
	       		else if(response[0].status=="Error")
	       		{
	       			alert(response[0].msg);
	       		}
			}
		});
	  }
	});
}

$(".studentname,.subject,.marks").on("keyup",function(){
	$(this).siblings(".errors").text("");
});