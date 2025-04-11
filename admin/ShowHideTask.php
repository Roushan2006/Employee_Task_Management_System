<?php
session_start(); 
if(!isset($_SESSION['admin_id'])) // check admin
{
  session_destroy();
  header("location:../Logout.php");    
}
require '../Classes/init.php';
 $func = new Operation(); // DB Connection file


  $task_id=$_POST['task_id']; //getting task_id
  $status=$_POST['val'];   // getting task_status(0/1)

 

  $result = $func->update('task',array("task_display ='".$status."'"),"task_id ='" . $task_id . "'"); // query will update task_display to 0 or 1 

  if ($result === TRUE) 
  { 
    
  } 

?>