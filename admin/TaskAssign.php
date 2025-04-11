<?php session_start(); 
if(!isset($_SESSION['admin_id'])) //check admin
{
  session_destroy();
  header("location:../Logout.php");    
}?>
<!DOCTYPE html>
<html>
<head>
	<title>Task Assign</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<!-- Custom Theme files -->
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
	<!-- //Custom Theme files -->

	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
	<!-- //web font -->
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

	<script> 
		//tinymce include for task details
		tinymce.init({
			selector: '#mytextarea'
		});
	</script>

</head>
<body>
	<?php 
	
	include("html/AdminHeader.php"); // include header

	$userId=$_REQUEST['user_id']; // getting user_id
  	$myId=$_SESSION['admin_id'];  // getting admin_id

	
    $result = $func->select_with_condition(array('*'),'user',"user_id = '".$userId."'");//query will fetch user details by user_id
	while($row = $result->fetch_assoc())
	{       
		$image=$row["user_image"];
		$userFname=$row["user_fname"];
		$userLname=$row["user_lname"];
	}


	$result1 = $func->select_with_condition(array('*'),'admin',"admin_id = '".$myId."'"); // query will fetch admin details by admin_id
	while($row = $result1->fetch_assoc())
	{       
		$myName=$row["admin_name"];
		$myProfile=$row["admin_image"];
	}

	?>
	<div class="w5layouts-main"> 
		<div class="updateprofile-layer">
			<h1>Assign Task to <?php  echo $userFname." ".$userLname ;?></h1> 
			<div class="header-main1">
				<div class="main-icon">
					<img src="<?php echo "$image";?>" class="rounded_img" >
				</div>
				<div class="header-left-bottom">
					<form action="#" method="post">	
						<div class="icon1"> 
							<span class="fa fa-user"></span>
							Task Tittle :<input type="text" placeholder="Enter Tittle" name="task_name" required=""/>
						</div>	

						<div class="icon1">
							<span class="fa fa-user"></span>
							Task Details :<textarea id="mytextarea" name ="task_details" ></textarea>
						</div>	

						<div class="icon1">
							<span class="fa fa-user"></span>
							Task DeadLine :<input type="datetime-local" placeholder="Dead Line" name="deadline" required=""/>
						</div>	

						<div class="icon1">
							<span class="fa fa-user"></span>
							Task Project : <select name="projects" > 
								<?php 
								 //will give all projects in select 
								$result = $func->selectAll('project');    //box(drop down)
								while($row = $result->fetch_assoc())
								{       
									echo "<option value=".$row['project_id'].">".$row['project_name']."</option>";
								}
								?>

							</select>
						</div>	

						 <div class="bottom">
                            <input  type="submit" class="btn" name="assign" value="Assign" />
                         </div>

					</form>			

					<form action="#" method="post">	

						<div class="bottom">
							<button class="btn" type="submit" name="home" >HOME</button>
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>	
	<!-- //main -->
	<?php

	if(isset($_POST['assign'])) // onset assign button 
	{
		$taskName=$_POST['task_name'];  // getting following details from the form
		$taskDetail=$_POST['task_details'];
		$taskDeadLine=$_POST['deadline'] ; 
		$taskProject=$_POST['projects'];
		
		// $sql = "INSERT INTO task (task_name,task_details,task_project,dead_line,task_receiver,task_sender,task_sender_name,task_sender_image)
		// VALUES ('$taskName', '$taskDetail','$taskProject','$taskDeadLine','$userId','$myId','$myName','$myProfile')";
       
        $result = $func->insert('task',array('task_name','task_details','task_project','dead_line','task_receiver','task_sender','task_sender_name','task_sender_image'),array("'$taskName'", "'$taskDetail'","'$taskProject'","'$taskDeadLine'","'$userId'","'$myId'","'$myName'","'$myProfile'"));

		  // insert above fetched details into task 
		if ($result === TRUE) 
		{
			echo '<meta http-equiv=Refresh content="0;url=AllUsers.php?reload=1">';       
		}
		else
		{
			echo "Cannot update";
		}
	}
	?>
</body>
</html>