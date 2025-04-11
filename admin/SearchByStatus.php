<!DOCTYPE html>
<html>
<head>
	<title>search by status</title>
</head>
<body>
	<?php
 session_start(); 
if(!isset($_SESSION['admin_id']))  // check admin
{
  session_destroy();
  header("location:../Logout.php");    
}
  $select=$_POST['value']; // gettting project status (pending/working/completed)
 
  require '../Classes/init.php';
  $func = new Operation(); //DB connection file

   
    $result = $func->select_with_join_condition('*','task','user','INNER JOIN','task_receiver=user_id',"task_status = '".$select."'");
     // fetching task and user on the basic of project status
    
      ?>
      <!-- All task shown here -->
      <center><div class="field" id="alltasks"> <br><br>    
        <?php
        if($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc()) 
          {   
            ?>   
            <table>
              <col width="60">
              <col width="150">
              <col width="150">
              <col width="150">       
              <tr>
                <td align="center"><img src="<?php echo $row["user_image"];?>" alt="No Profile" width="42" height="42" style=" border-radius: 50%;" ></td>
                <td align="center"><?php echo $row["user_fname"]." ".$row["user_lname"]; ?></td>
                <td align="center"><?php echo $row["task_name"]; ?></td> 
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
       <!-- //All task shown here -->   
 </body>
 </html>
