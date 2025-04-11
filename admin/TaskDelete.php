	<?php
session_start(); 
if(!isset($_SESSION['admin_id'])) // admin check
{
  session_destroy();
  header("location:../Logout.php");    
}
  require '../Classes/init.php';
  $func = new Operation(); // DB Connection file
  $task_id=$_POST['task_id']; // getting task_id

 // $sql="DELETE from  task  WHERE task_id = '".$task_id."'"; 
  $result = $func->delete('task',"task_id = '".$task_id."'"); // deleting task by task_id

 if( $result === TRUE )
 {
   //$sql1 = "SELECT * FROM task INNER JOIN user ON  task_receiver=user_id";
   $result1 = $func->select_with_join('*','task','user','INNER JOIN','task_receiver=user_id');// query will fetch updated tasks
  ?>
  <center><div class="field" id="alltasks"> 
  <h3 style="color: white;">All Tasks</h3> 
      <?php

      if($result1->num_rows > 0) 
      {
        while($row = $result1->fetch_assoc()) 
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
            <td><button onclick="delete_task(<?php echo $row["task_id"];?>)" class="button" >Delete</button></td>
          </tr>
          </table><br>
           
          <?php 
         
        } 
      }
      else
      {
        echo "<h2>no task so far</h2>";
      }
    }
      ?>
    <br>
  </div></center>

