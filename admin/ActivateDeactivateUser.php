<?php session_start(); 
if(!isset($_SESSION['admin_id'])) // to check user is admin or not  
{                                 //if not admin then destroy the session 
  session_destroy();              // and redirect to index page and 
  header("location:../Logout.php");    
}
  require '../Classes/init.php'; // including function file init contains all DB function
  $func = new Operation();  // object of class Operation inside init
	$user_id=$_POST['user_id'];
	$status=$_POST['val'];
  $result = $func->update('user',array("user_status ='".$status."'"),"user_id ='".$user_id."'");// query will update the user status (active / blocked)  if ($result === TRUE) // on true it will return new updated user list
 if ($result === TRUE) // on true it will return new updated user list
  {  
    $result1 = $func->selectAll('user'); //  for selecting all users from DB
   
    while($row = $result1->fetch_assoc()) 
      { ?>
         <table>
          <col width="60">
          <col width="150">
          <col width="150">
          <tr>
           <td><img src="<?php echo $row["user_image"];?> " alt="No Profile" width="42" height="42" style=" border-radius: 50%;"></td>
           <td align="center"><?php echo $row["user_fname"]." ".$row["user_lname"]; ?></td>
           <td><a href="TaskAssign.php?user_id=<?php echo $row["user_id"]; ?>" class="button">ASSIGN TASK</a></td>
           <?php if($row["user_status"]==1)
           { ?>
             <td style="color: green;"><?php echo "✔" ;?></td>
           <?php }  else
           {
            ?>
            <td style="color: red;"><?php echo "✘" ;?></td>
          <?php } ?>          
          <td>
            <label class="switch">
              <input type="checkbox" name="enabledisable" value="1" <?php echo ($row['user_status']=='1' ? 'checked' : ''); ?> onclick="activate_deactivate_user(this.checked ? 1 : 0,<?php echo $row['user_id'];?>)" >
              <span class="slider round"></span></label></td>
              <br>
            </tr><br> </table>          
        <?php 
         } 
      }
      else
      {
        echo "Cannot update";
      }
    ?>