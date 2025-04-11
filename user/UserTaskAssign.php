<?php session_start(); 
if(!isset($_SESSION['user_id']))
{
  session_destroy();
  header("location:../Logout.php");    
}?>
<!DOCTYPE html>
<html>
<head>
	<title>User To User Task Assign</title>

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
		tinymce.init({
			selector: '#mytextarea'
		});
	</script>


</head>
<body>
	<?php 
	
	include("html/Header.php");
	

	$userId=$_REQUEST['user_id'];
	$myId=$_SESSION['user_id'];

	//$sql = "SELECT * FROM user WHERE user_id = '".$userId."'";

	$result = $func->select_with_condition(array('*'),'user',"user_id = '".$userId."'");
	while($row = $result->fetch_assoc())
	{       
		$image=$row["user_image"];
		$userFname=$row["user_fname"];
		$userLname=$row["user_lname"];

	}

	//$sql1="SELECT * FROM user WHERE user_id = '".$myId."'";
	$result1 = $func->select_with_condition(array('*'),'user',"user_id = '".$myId."'");
	while($row = $result1->fetch_assoc())
	{       
		$myName=$row["user_fname"];
		$myProfile=$row["user_image"];
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
							 Task Deadline :<input type="datetime-local" placeholder="Dead Line" name="deadline" required=""/>
						</div>
                        
                        <div class="icon1">
							<span class="fa fa-user"></span>
							 Task Project :<select name="projects" >
                                    <?php 
                                       $status=1;
                                         //$sql = "SELECT * FROM project WHERE project_status = '1' ";
	                                     $result = $func->select_with_condition(array('*'),'project',"project_status = '".$status."'");
                                        while($row = $result->fetch_assoc())
	                             {       
                                     echo "<option value=".$row['project_id'].">".$row['project_name']."</option>";
                                  }
                                ?>
                 
                          </select>
						</div>	


						<div class="bottom">
							<button class="btn" type="submit" name="assign" >Assign</button>
						</div><br>

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
	<?php

	if(isset($_POST['assign']))
	{

		$taskName=$_POST['task_name'];
		$taskDetail=$_POST['task_details'];
		$taskDate =date('Y-m-d H:i:s');
		$taskDeadLine=$_POST['deadline'] ; 
		$taskProject=$_POST['projects'];
		//echo "$taskName,$taskDetail,$taskDeadLine,$myId,$userId";     

		// $sql = "INSERT INTO task (task_name,task_issuedate,task_details,task_project,dead_line,task_receiver,task_sender,task_sender_name,task_sender_image)
		// VALUES ('$taskName','$taskDate', '$taskDetail','$taskProject','$taskDeadLine', '$userId','$myId','$myName','$myProfile')"; 

		 $result = $func->insert('task',array('task_name','task_issuedate','task_details','task_project','dead_line','task_receiver','task_sender','task_sender_name','task_sender_image'),array("'$taskName'","'$taskDate'", "'$taskDetail'","'$taskProject'","'$taskDeadLine'","'$userId'","'$myId'","'$myName'","'$myProfile'"));

		if ($result=== TRUE) 
		{          
			echo '<meta http-equiv=Refresh content="0;url=AllMates.php?reload=1">';       
		}
		else
		{
			echo "Cannot update";
		}

	}    

	?>

</body>
</html>