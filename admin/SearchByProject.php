 <!DOCTYPE html>
<html>
<head>
  <title>serach by project</title>
</head>
<body>
  <?php
 session_start(); 
if(!isset($_SESSION['admin_id'])) // admin check
{
  session_destroy();
  header("location:../Logout.php");    
}
  require '../Classes/init.php';
  $func = new Operation();
  $project_select=$_POST['select']; // getting project id
  

  // database connection file

   // $sql = "SELECT * FROM task INNER JOIN user on task_receiver=user_id WHERE task_project = '".$project_select."'"; 
    $result = $func->select_with_join_condition('*','task','user','INNER JOIN','task_receiver=user_id',"task_project = '".$project_select."'");
    // query to fetch users and tasks on the basic of project
      ?>
      <!-- All tasks shown here -->
      <center><div class="alltasks" id="alltasks"> <br><br>  
          <?php
          if($result->num_rows > 0) 
        {
          	while($row = $result->fetch_assoc()) 
          	{   
          		?>  
          		<table>
          			<col width="60">
          			<col width="100">
          			<col width="150">              
          			<tr>
          				<td align="center"><img src="<?php echo $row["user_image"];?>" alt="No Profile" width="42" height="42" style=" border-radius: 50%;" ></td>
          				<td align="center"><?php echo $row["user_fname"]." ".$row["user_lname"]; ?></td>
          				<td align="center"><?php echo $row["task_name"]; ?></td> 
          				<?php if($row["task_display"]==1)
          				{ ?>
          					<td style="color: green;"><?php echo "✔" ;?></td>
          				<?php }  else
          				{
          					?>
          					<td style="color: red;"><?php echo "✘" ;?></td>
          				<?php } ?>
          				<td><a href="TaskDetails.php?task_id=<?php echo $row["task_id"]; ?>" class="button">SEE DETAILS</a></td>
          				<td><button onclick="delete_task(<?php echo $row["task_id"];?>)" class="button">Delete</button></td>

          			</tr>
          			<br>     
          			<?php  
          		}
           } 
          	
          else
          {
            echo "<h2>no task so far</h2>";
          }
          ?>
        </table><br>
      </div></center> 
       <!-- //All tasks shown here -->   
 </body>
 </html>




     