<?php
 session_start(); 
if(!isset($_SESSION['user_id']))
{
  session_destroy();
  header("location:../Logout.php");    
}
  require '../Classes/init.php';
  $func = new Operation();
  $task_id=$_POST['task_id'];
  $status=$_POST['val'];

 // $sql="UPDATE task set task_status ='".$status."' WHERE task_id ='" . $task_id . "'"; 
  $result =  $func->update('task',array("task_status ='".$status."'"),"task_id ='".$task_id."'"); 

  if ($result === TRUE) 
  {   
   echo "updated";       
  }
 else
 {
   echo "Cannot update";
 }

?>